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

/**
 * Base Database Mapper
 *
 * @package    Mapper
 * @subpackage Db
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Mapper_Db_Base
{

    /**
     * @var Zend_Db_Table_Abstract
     */
    private $registeredDbTable;

    /**
     * Convert model to data array
     *
     * @param  Gnome_Model_Base $model
     * @return Array
     */
    public function toArray(BowShock_Model_Base $model)
    {
        $mappedData = array('created_at' => $model->getCreatedAt(),
                            'updated_at' => $model->getUpdatedAt(),
                            'id' => $model->getId());

        return $mappedData;
    }

    /**
     * Register Db Table Instance this mapper will use.
     *
     * @param Zend_Db_Table_Abstract $dbTable
     */
    public function registerDbTable(Zend_Db_Table_Abstract $dbTable)
    {
        $this->registeredDbTable = $dbTable;
    }

    /**
     * Retrieve registered Db Table Instance
     *
     * @return Zend_Db_Table_Abstract
     */
    public function getDbTable()
    {
        if (is_null($this->registeredDbTable)) {
            $tableFactory = BowShock_Model_DbTable_Factory::getInstance();
            $tableToRegister = $tableFactory->createMappedTable(get_class($this));
            $this->registerDbTable($tableToRegister);
        }
        return $this->registeredDbTable;
    }

    /**
     * Save Model
     *
     * Save provided model to database. If the tables primary key is set
     * in the model, the database will be updated instead.
     *
     * @param  BowShock_Model_Base $model
     * @param  array		       $data
     * @return void
     */
    public function save(BowShock_Model_Base $model, array $data)
    {
        if (NULL === ($primaryVal = $model->getId())) {
            $data['created_at'] = date('Y-m-d H:i:s');
            unset($data['id']);
            $this->getDbTable()->insert($data);
            $primaryVal = $this->getDbTable()
                ->getAdapter()
                ->lastInsertId();

            $model->setOptions(array('id' => $primaryVal));
        } else {
            unset($data['created_at']);
            $this->getDbTable()->update($data, array('id = ?' => $primaryVal));
        }
    }

    /**
     * Find table row by primary key
     *
     * Find a table row by its unique primary key
     * and populate a model with its data.
     *
     * @param  Integer | String $primaryIndex
     * @param  BowShock_Model_Base $model
     * @return BowShock_Model_Base Return populated model or NULL if no row could be
     * found.
     */
    public function find($primaryIndex, BowShock_Model_Base $model)
    {
        $tableRows = $this->getDbTable()->find($primaryIndex);
        if (0 == count($tableRows)) {
            return null;
        }
        $model->setOptions($tableRows->current()->toArray());
        return $model;
    }

    /**
     * Build model from db table row data
     *
     * @param BowShock_Model_Base $model
     * @param Zend_Db_Table_Row $row
     * @return BowShock_Model_Base
     */
    public function buildModelFromRow(BowShock_Model_Base $model, Zend_Db_Table_Row $row)
    {
        $model->setOptions($row->toArray());
        return $model;
    }

    /**
     * Build list of models from rowset
     *
     * @param BowShock_List $list
     * @param string $className
     * @param Zend_Db_Table_Rowset $rowset
     * @throws BowShock_Mapper_Exception
     * @return BowShock_List
     */
    public function buildListFromRowset(BowShock_List $list, $className, Zend_Db_Table_Rowset $rowset)
    {
        if (!class_exists($className, false)) {
            require_once 'BowShock/Mapper/Exception.php';
            throw new BowShock_Mapper_Exception("Model Class $className not found!");
        }
        while ($rowset->valid()) {
            $model = new $className();
            $this->buildModelFromRow($model, $rowset->current());
            $list->add($model);
            $rowset->next();
        }
        return $list;
    }

    /**
     * Start Database Transaction
     *
     * @throws BowShock_Mapper_Exception
     */
    public function startTransaction()
    {
        try {
            $this->getDbTable()->getAdapter()->beginTransaction();
        } catch (PDOException $e) {
            require_once 'BowShock/Mapper/Exception.php';
            throw new BowShock_Mapper_Exception('Cannot start transaction.', 0, $e);
        }
    }

    /**
     * Rollback Database Transaction
     *
     * @throws BowShock_Mapper_Exception
     */
    public function rollbackTransaction()
    {
        try {
            $this->getDbTable()->getAdapter()->rollBack();
        } catch (PDOException $e) {
            require_once 'BowShock/Mapper/Exception.php';
            throw new BowShock_Mapper_Exception('Cannot rollback transaction.', 0, $e);
        }
    }

    /**
     * Commit Database Transaction
     *
     * @throws BowShock_Mapper_Exception
     */
    public function commitTransaction()
    {
        try {
            $this->getDbTable()->getAdapter()->commit();
        } catch (PDOException $e) {
            require_once 'BowShock/Mapper/Exception.php';
            throw new BowShock_Mapper_Exception('Cannot commit transaction.', 0, $e);
        }
    }

}