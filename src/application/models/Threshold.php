<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Build result threshold
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Threshold extends BowShock_Model_Base
{

    const TYPE_CHECKSTYLE = 'checkstyle';
    const TYPE_CODENARC = 'codenarc';
    const TYPE_CPD = 'cpd';
    const TYPE_FINDBUGS = 'findbugs';
    const TYPE_FXCOP = 'fxcop';
    const TYPE_GENDARME = 'gendarme';
    const TYPE_JCREPORT = 'jcreport';
    const TYPE_JSLINT = 'jslint';
    const TYPE_PMD = 'pmd';
    const TYPE_PYLINT = 'pylint';
    const TYPE_SIMIAN = 'simian';
    const TYPE_STYLECOP = 'stylecop';

    /**
     * @var integer
     */
    private $min;

    /**
     * @var integer
     */
    private $max;

    /**
     * @var integer
     */
    private $unstable;

    /**
     * @var string
     */
    private $type;

	/**
     * @return the $min
     */
    public function getMin()
    {
        return $this->min;
    }

	/**
     * @return the $max
     */
    public function getMax()
    {
        return $this->max;
    }

	/**
     * @return the $unstable
     */
    public function getUnstable()
    {
        return $this->unstable;
    }

	/**
     * @param integer $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

	/**
     * @param integer $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

	/**
     * @param integer $unstable
     */
    public function setUnstable($unstable)
    {
        $this->unstable = $unstable;
    }

	/**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * @param string $type
     */
    public function setType($type)
    {
        switch ($type) {
            case self::TYPE_CHECKSTYLE:
            case self::TYPE_CODENARC:
            case self::TYPE_CPD:
            case self::TYPE_FINDBUGS:
            case self::TYPE_FXCOP:
            case self::TYPE_GENDARME:
            case self::TYPE_JCREPORT:
            case self::TYPE_JSLINT:
            case self::TYPE_PMD:
            case self::TYPE_PYLINT:
            case self::TYPE_SIMIAN:
            case self::TYPE_STYLECOP:
                $this->type = $type;
                break;
            default:
                throw new InvalidArgumentException(
                	'Invalid thresold type '. $type . ' given!'
                );
                break;
        }
    }

}