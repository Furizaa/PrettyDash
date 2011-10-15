<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    Model
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Base Model
 *
 * @package    Model
 * @subpackage subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_Model_Base
{

    /**
     * @var Integer
     */
    private $index = null;

    /**
     * @var String
     */
    private $createdAt = null;

    /**
     * @var String
     */
    private $updatedAt = null;

    /**
     * Populate model with values from an associative array.
     * Trys to convert the arrays keys into setter calls. If a setter
     * for a key did not exists the key value pair will be ignored.
     *
     * @param array $options
     */
    public function setOptions($options)
    {
        $filterUnderscoreToCamel = new Zend_Filter_Word_UnderscoreToCamelCase();
        foreach ((array) $options as $key => $value) {
            $transformedKey = $filterUnderscoreToCamel->filter($key);
            $transformedKey = ucfirst($transformedKey);
            $setterMethodName = 'set' . $transformedKey;
            if (method_exists($this, $setterMethodName)) {
                $this->$setterMethodName($value);
            }
        }
    }

    /**
     * Property setter
     *
     * @param Integer $value
     * @return BowShock_Model_Base $this
     */
    protected function setId($value)
    {
        if (null === $value) {
            $this->index = null;
        } else {
            $this->index = (int)$value;
        }
        return $this;
    }

    /**
     * Property getter
     *
     * @return Integer
     */
    public function getId()
    {
        return $this->index;
    }

    /**
     * Property setter
     *
     * @param String $value
     * @return BowShock_Model_Base $this
     */
    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
        return $this;
    }

    /**
     * Property getter
     *
     * @return String
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Property setter
     *
     * @param String $value
     * @return BowShock_Model_Base $this
     */
    public function setUpdatedAt($value)
    {
        $this->updatedAt = $value;
        return $this;
    }

    /**
     * Property getter
     *
     * @return String
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}