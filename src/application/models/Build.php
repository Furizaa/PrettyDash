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
 * Build Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Build extends BowShock_Model_Base
{

    /**
     * @var integer
     */
    private $buildNumber;

    /**
     * @var string
     */
    private $path;

	/**
     * @return the $buildNumber
     */
    public function getBuildNumber()
    {
        return $this->buildNumber;
    }

	/**
     * @return the $path
     */
    public function getPath()
    {
        return $this->path;
    }

	/**
     * @param integer $buildNumber
     */
    public function setBuildNumber($buildNumber)
    {
        $this->buildNumber = $buildNumber;
    }

	/**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

}