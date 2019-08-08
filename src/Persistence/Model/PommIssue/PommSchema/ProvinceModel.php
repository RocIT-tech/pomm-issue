<?php

namespace App\Persistence\Model\PommIssue\PommSchema;

use App\Persistence\Model\PommIssue\PommSchema\AutoStructure\Province as ProvinceStructure;
use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

/**
 * ProvinceModel
 *
 * Model class for table province.
 *
 * @see Model
 */
class ProvinceModel extends Model
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
        $this->structure             = new ProvinceStructure;
        $this->flexible_entity_class = Province::class;
    }
}
