<?php

namespace App\Persistence\Model\PommIssue\PommSchema;

use App\Persistence\Model\PommIssue\PommSchema\AutoStructure\Country as CountryStructure;
use App\Session;
use PommProject\ModelManager\Model\CollectionIterator;
use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;
use function sprintf;

/**
 * CountryModel
 *
 * Model class for table country.
 *
 * @see Model
 */
class CountryModel extends Model
{
    use WriteQueries;

    /**
     * __construct()
     *
     * Model constructor
     *
     * @access public
     */
    public function __construct()
    {
        $this->structure             = new CountryStructure;
        $this->flexible_entity_class = Country::class;
    }

    public function findAllWithCities(): CollectionIterator
    {
        $sql = <<<EOF
SELECT
    :projection
FROM :country country
LEFT JOIN :province province USING (country_id)
GROUP BY country_id
EOF;

        $provinceSql = <<<EOF
SELECT
    ARRAY_AGG(province)
FROM 
    (
        SELECT :projection
        FROM :province province
        INNER JOIN :city city USING (province_id)
        GROUP BY province_id
    ) AS province
EOF;

        /** @var Session $session */
        $session = $this->getSession();

        /** @var ProvinceModel $provinceModel */
        $provinceModel = $session->getModel(ProvinceModel::class);

        /** @var CityModel $cityModel */
        $cityModel = $session->getModel(CityModel::class);

        $provinceProjection = $provinceModel->createProjection();
        $provinceProjection->setField('city', 'ARRAY_AGG(city)', sprintf('%s[]', City::class));

        $provinceSql = strtr(
            $provinceSql,
            [
                ':projection' => $provinceProjection->formatFieldsWithFieldAlias('province'),
                ':province'   => $provinceModel->getStructure()->getRelation(),
                ':city'       => $cityModel->getStructure()->getRelation(),
            ]
        );

        $projection = $this->createProjection();
        $projection->setField('province', "({$provinceSql})", sprintf('%s[]', Province::class));

        $sql = strtr(
            $sql,
            [
                ':projection' => $projection->formatFieldsWithFieldAlias('country'),
                ':country'    => $this->getStructure()->getRelation(),
                ':province'   => $provinceModel->getStructure()->getRelation(),
            ]
        );

        return $this->query($sql, [], $projection);
    }
}
