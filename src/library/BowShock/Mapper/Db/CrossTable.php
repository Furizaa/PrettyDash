<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Mapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

require_once 'BowShock/Mapper/Db/Base.php';

/**
 * Cross Table Base Mapper
 *
 * @package    Mapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Mapper_Db_CrossTable extends BowShock_Mapper_Db_Base
{

    /**
     * Convert model to data array
     *
     * @throws BowShock_Exception
     */
    public function toArray()
    {
        throw new BowShock_Exception('toArray method not implemented in Cross Tables!');
    }

    /**
     * Save Model
     *
     * Save provided model to database. If the tables primary key is set
     * in the model, the database will be updated instead.
     *
     * @throws BowShock_Exception
     */
    public function save()
    {
        throw new BowShock_Exception('Save method not implemented in Cross Tables!');
    }

    /**
     * Find table row by primary key
     *
     * Find a table row by its unique primary key
     * and populate a model with its data.
     *
     * @throws BowShock_Exception
     */
    public function find()
    {
        throw new BowShock_Exception('Find method not implemented in Cross Tables!');
    }

    /**
     * Build model from db table row data
     *
     * @param BowShock_Model_Base $model
     * @param Zend_Db_Table_Row $row
     * @throws BowShock_Exception
     */
    public function buildModelFromRow()
    {
        throw new BowShock_Exception('buildModelFromRow method not implemented in Cross Tables!');
    }

    /**
     * Build list of models from rowset
     *
     * @param BowShock_List $list
     * @param string $className
     * @param Zend_Db_Table_Rowset $rowset
     * @throws BowShock_Exception
     */
    public function buildListFromRowset()
    {
        throw new BowShock_Exception('buildListFromRowset method not implemented in Cross Tables!');
    }

}