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
 * Project List Array Mapper
 *
 * @package    Model
 * @subpackage Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Array_ProjectList extends BowShock_Mapper_Json_Base
{

	/**
     * @param Model_List_Project $project
     * @return string
     */
    public function toArray(Model_List_Project $projectList)
    {
        $projectMapper = new Model_Mapper_Array_Project();
        $result = array();

        $iterator = $projectList->getIterator();
        while ($iterator->valid()) {

            /*@var $project Model_Project */
            $project = $iterator->current();
            $result[$project->getSlug()] = $projectMapper->toArray($project);
            $iterator->next();
        }
        return $result;
    }

}
