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
 * Project Model
 *
 * @package    Model
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Project extends BowShock_Model_Base
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $team;

    /**
     * @var string
     */
    private $branch;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $slug;

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @return the $path
     */
    public function getPath()
    {
        return $this->path;
    }

	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

	/**
     * @return the $group
     */
    public function getGroup()
    {
        return $this->group;
    }

	/**
     * @return the $team
     */
    public function getTeam()
    {
        return $this->team;
    }

	/**
     * @return the $branch
     */
    public function getBranch()
    {
        return $this->branch;
    }

	/**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

	/**
     * @param string $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

	/**
     * @param string $branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

	/**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

	/**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}