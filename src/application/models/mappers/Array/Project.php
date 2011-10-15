<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Model
 * @subpackage Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Array Project mapper
 *
 * @package    Model
 * @subpackage Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Array_Project extends BowShock_Mapper_Json_Base
{

    /**
     * @param Model_Project $project
     * @return string
     */
    public function toArray(Model_Project $project)
    {
        $result = array(
            'path' =>   (string)$project->getPath(),
            'team' =>   (string)$project->getTeam(),
            'branch' => (string)$project->getBranch(),
            'name' =>   (string)$project->getName(),
            'group' =>  (string)$project->getGroup(),
            'slug' =>   (string)$project->getSlug()
        );

        return $result;
    }

}