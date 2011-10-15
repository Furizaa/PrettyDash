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
 * Jenkins Build Result Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_BuildResult extends BowShock_Model_Base
{

    /**
     * @var integer
     */
    const BUILD_STATUS_SUCCESS  = 1;
    const BUILD_STATUS_FAILED   = 2;
    const BUILD_STATUS_UNSTABLE = 4;

    /**
     * @var integer
     */
    private $csDelta;

    /**
     * @var integer
     */
    private $csCount;

    /**
     * @var integer
     */
    private $dryDelta;

    /**
     * @var integer
     */
    private $dryCount;

    /**
     * @var integer
     */
    private $pmdDelta;

    /**
     * @var integer
     */
    private $pmdCount;

    /**
     * @var integer
     */
    private $testsPassed;

    /**
     * @var integer
     */
    private $testsSkipped;

    /**
     * @var integer
     */
    private $testsFailed;

    /**
     * @var integer
     */
    private $status;

	/**
     * @return the $csDelta
     */
    public function getCsDelta()
    {
        return $this->csDelta;
    }

	/**
     * @return the $dryDelty
     */
    public function getDryDelta()
    {
        return $this->dryDelta;
    }

	/**
     * @return the $pmdDelta
     */
    public function getPmdDelta()
    {
        return $this->pmdDelta;
    }

	/**
     * @return the $testsPassed
     */
    public function getTestsPassed()
    {
        return $this->testsPassed;
    }

	/**
     * @return the $testsSkipped
     */
    public function getTestsSkipped()
    {
        return $this->testsSkipped;
    }

	/**
     * @return the $testsFailed
     */
    public function getTestsFailed()
    {
        return $this->testsFailed;
    }

	/**
     * @param integer $csDelta
     */
    public function setCsDelta($csDelta)
    {
        $this->csDelta = $csDelta;
    }

	/**
     * @param integer $dryDelty
     */
    public function setDryDelta($dryDelty)
    {
        $this->dryDelta = $dryDelty;
    }

	/**
     * @param integer $pmdDelta
     */
    public function setPmdDelta($pmdDelta)
    {
        $this->pmdDelta = $pmdDelta;
    }

	/**
     * @param integer $testsPassed
     */
    public function setTestsPassed($testsPassed)
    {
        $this->testsPassed = $testsPassed;
    }

	/**
     * @param integer $testsSkipped
     */
    public function setTestsSkipped($testsSkipped)
    {
        $this->testsSkipped = $testsSkipped;
    }

	/**
     * @param integer $testsFailed
     */
    public function setTestsFailed($testsFailed)
    {
        $this->testsFailed = $testsFailed;
    }

	/**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

	/**
     * @param integer $status
     */
    public function setStatus($status)
    {
        switch ($status) {
            case self::BUILD_STATUS_FAILED:
            	/* break intentionally omitted */
            case self::BUILD_STATUS_SUCCESS:
                /* break intentionally omitted */
            case self::BUILD_STATUS_UNSTABLE:
                $this->status = $status;
                break;
            default:
                throw new InvalidArgumentException('Invalid build result given!');
        }
    }

	/**
     * @return the $csCount
     */
    public function getCsCount()
    {
        return $this->csCount;
    }

	/**
     * @return the $dryCount
     */
    public function getDryCount()
    {
        return $this->dryCount;
    }

	/**
     * @return the $pmdCount
     */
    public function getPmdCount()
    {
        return $this->pmdCount;
    }

	/**
     * @param integer $csCount
     */
    public function setCsCount($csCount)
    {
        $this->csCount = $csCount;
    }

	/**
     * @param integer $dryCount
     */
    public function setDryCount($dryCount)
    {
        $this->dryCount = $dryCount;
    }

	/**
     * @param integer $pmdCount
     */
    public function setPmdCount($pmdCount)
    {
        $this->pmdCount = $pmdCount;
    }



}
