<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Library
 * @subpackage ProjectResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Project resolver for projects with the pattern <group>.<branch>.<team>.<name>
 * Like "ecomm.sprint.devops.library"
 *
 * @package    Library
 * @subpackage ProjectResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class PDash_ProjectResolver_TeamProjectResolver
    extends PDash_ProjectResolver
{

    /**
     * @var string
     */
    const PATTERN = '/^(?P<group>[a-z]+)\.(?P<branch>[a-z]+)\.(?P<team>[a-z]+)\.(?P<name>[a-z]+)$/i';

	/**
	 * @see PDash_Library_ProjectResolver::matchDirectory()
	 */
    public function matchDirectory($dirName)
    {
        $matches = array();
        preg_match(self::PATTERN, $dirName, $matches);
        if (isset($matches['group']) &&
            isset($matches['branch']) &&
            isset($matches['team']) &&
            isset($matches['name'])
        ) {
            $project = new Model_Project();
            $project->setGroup($matches['group']);
            $project->setBranch($matches['branch']);
            $project->setTeam($matches['team']);
            $project->setName($matches['name']);
            $project->setSlug($dirName);
            return $project;
        }

        return null;
    }

}