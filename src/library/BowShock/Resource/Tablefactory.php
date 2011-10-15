<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Resource
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

require_once 'Zend/Application/Resource/ResourceAbstract.php';

/**
 * Resource loader for the db table dependency injection
 *
 * @package    Resource
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Resource_Tablefactory extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * (non-PHPdoc)
     * @see Zend_Application_Resource_Resource::init()
     */
    public function init()
    {
        require_once 'BowShock/Model/DbTable/Factory.php';
        BowShock_Model_DbTable_Factory::factory($this->getOptions());
    }

}