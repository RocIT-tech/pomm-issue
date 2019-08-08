<?php

namespace App\Persistence\Model\PommIssue\PommSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use App\Persistence\Model\PommIssue\PommSchema\AutoStructure\City as CityStructure;
use App\Persistence\Model\PommIssue\PommSchema\City;

/**
 * CityModel
 *
 * Model class for table city.
 *
 * @see Model
 */
class CityModel extends Model
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
        $this->structure = new CityStructure;
        $this->flexible_entity_class = '\App\Persistence\Model\PommIssue\PommSchema\City';
    }
}
