<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Test
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Database Test Case Helper
 *
 * @package    Test
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
abstract class BowShock_Test_DatabaseTestCase extends Zend_Test_PHPUnit_DatabaseTestCase
{

    /**
     * @var Zend_Test_PHPUnit_Db_Connection
     */
    private $connectionMock;

    /**
     * (non-PHPdoc)
     * @see PHPUnit_Extensions_Database_TestCase::getConnection()
     */
    protected function getConnection()
    {
        if (NULL !== $this->connectionMock) {
            return $this->connectionMock;
        }

        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'testing');
        $connection = Zend_Db::factory($config->resources->db->adapter, $config->resources->db->params);
        $this->connectionMock = $this->createZendDbConnection($connection, 'BS-unittest');
        Zend_Db_Table_Abstract::setDefaultAdapter($connection);

        return $this->connectionMock;
    }

    /**
     * Assert equality for a Db Table with a fixture XML
     *
     * @param Zend_Db_Table_Abstract $dbTable
     * @param String                 $xmlFileName
     * @param Array | NULL			 $filter
     */
    protected function assertDbEqualsXml(Zend_Db_Table_Abstract $dbTable,
                                         $xmlFileName,
                                         $columnFilter = array(),
                                         $tableFilter = array())
    {
        $dataSetFilter = array_merge(array('updated_at', 'created_at'), $columnFilter);

        $dbDataSet = $this->createDbTableDataSet();
        $dbDataSet->addTable($dbTable);
        $dbDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($dbDataSet);
        $dbDataSet->addExcludeTables($tableFilter);
        $dbDataSet->setExcludeColumnsForTable($dbTable->info('name'), $dataSetFilter);

        $fileDataSet = $this->createFlatXMLDataSet($xmlFileName);
        $fileDataSet = new PHPUnit_Extensions_Database_DataSet_DataSetFilter($fileDataSet);
        $fileDataSet->setExcludeColumnsForTable($dbTable->info('name'), $dataSetFilter);
        $fileDataSet->addExcludeTables($tableFilter);

        $this->assertDataSetsEqual($fileDataSet, $dbDataSet);
    }

}