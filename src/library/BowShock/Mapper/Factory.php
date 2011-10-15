<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Mapper Factory
 *
 * @package    Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Mapper_Factory
{

    /**
     * @var string
     */
    const DEFAULT_MAPPER_NAMESPACE = 'BowShock_Mapper_Db_';

    /**
     * @var BowShock_Mapper_Factory
     */
    private static $instance;

    /**
     * Registered model mapper instances
     *
     * @var BowShock_Mapper_Db_Base[]
     */
    private $registeredMappers = array();

    /**
     * @var string
     */
    private $mapperNamespace = 'BowShock_Mapper_Db_';

    /**
     * Singelton constructor
     */
    private function __construct()
    {
    }

    /**
     * Get Singleton Instance of Class
     *
     * @return BowShock_Mapper_Factory
     */
    public static function getInstance()
    {
        if (NULL === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return the $mapperNamespace
     */
    public function getMapperNamespace()
    {
        return trim($this->mapperNamespace, '_') . '_';
    }

    /**
     * @param string $mapperNamespace
     */
    public function setMapperNamespace($mapperNamespace)
    {
        $this->mapperNamespace = $mapperNamespace;
    }

    /**
     * Reset Singleton Instance
     */
    public static function resetInstance()
    {
        self::$instance = NULL;
    }

    /**
     * Register mapper with factory. Previously registered mappers with
     * the same class will be overwritten.
     *
     * @param BowShock_Mapper_Db_Base $mapper
     * @param String $registeredKey
     */
    public function registerMapper(BowShock_Mapper_Db_Base $mapper, $registeredKey = NULL)
    {
        if (NULL === $registeredKey) {
            $registeredKey = get_class($mapper);
        }
        $this->registeredMappers[$registeredKey] = $mapper;
    }

    /**
     * Checks if mapper is registered
     *
     * @param BowShock_Mapper_Db_Base | String $mapper
     */
    public function isMapperRegistered($mapper)
    {
        if (is_object($mapper) && $mapper instanceof BowShock_Mapper_Db_Base) {
            $mapper = get_class($mapper);
        }
        return array_key_exists($mapper, $this->registeredMappers);
    }

    /**
     * Fetch registered mapper from fully qualified class name.
     * If no mapper of this type has been registered before, a new one
     * will be registered and retrieved.
     *
     * @param String $mapperClassName
     * @return BowShock_Mapper_Db_Base
     * @throws BowShock_Mapper_FactoryException
     */
    public function getMapper($mapperClassName)
    {
        if (!array_key_exists($mapperClassName, $this->registeredMappers)) {
            if (!class_exists($mapperClassName, false)) {
                require_once 'BowShock/Mapper/FactoryException.php';
                throw new BowShock_Mapper_FactoryException(sprintf('Mapper %s not found!', $mapperClassName));
            }
            $mapperToRegister = new $mapperClassName();
            $this->registerMapper($mapperToRegister);
            return $this->getMapper($mapperClassName);
        }
        return $this->registeredMappers[$mapperClassName];
    }

    /**
     * Overload method access
     *
     * Creates the following virtual methods:
     * - getAccountMapper()
     *
     * @param  String $method
     * @param  Array  $args
     * @throws BowShock_Mapper_FactoryException
     */
    public function __call($method, $args)
    {
        if (preg_match('/^get(?P<mapper>[a-zA-Z]+)Mapper$/', $method, $matches)) {
            $mapper = $this->getMapperNamespace() . $matches['mapper'];
            return $this->getMapper($mapper);
        } else {
            require_once 'BowShock/Mapper/FactoryException.php';
            throw new BowShock_Mapper_FactoryException(sprintf('Method %s does not exist!', $method));
        }
    }

}