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

/**
 * Mapper resource config loader
 *
 * @package    Resource
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Resource_Mapperfactory extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * (non-PHPdoc)
     * @see Zend_Application_Resource_Resource::init()
     */
    public function init()
    {
        require_once 'BowShock/Mapper/Factory.php';
        $options = $this->getOptions();

        if (!array_key_exists('namespace', $options)) {
            BowShock_Mapper_Factory::getInstance()->setMapperNamespace($options['namespace']);
        }
    }

}