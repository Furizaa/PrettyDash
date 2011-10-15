<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Db
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * BowShock Table Object
 *
 * @package    Db
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
abstract class BowShock_Db_Table extends Zend_Db_Table_Abstract
{

    /**
     * Public Table name for BowShock
     *
     * @var unknown_type
     */
    public static $tableName = null;

    /**
     * Table name for Zend
     *
     * @var string
     */
    protected $_name = null;

    /**
     * @param mixed $config
     * @throws BowShock_Exception
     */
    public function __construct($config = array())
    {
        if (is_null(static::$tableName)) {
            throw new BowShock_Exception('BowShock Db Table needs a static table name!');
        }
        $this->_name = static::$tableName;
        parent::__construct($config);
    }

}
