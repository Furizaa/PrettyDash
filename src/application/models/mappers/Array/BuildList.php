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
class Model_Mapper_Array_BuildList extends BowShock_Mapper_Json_Base
{

	/**
     * @param Model_List_Build $buildList
     * @return string
     */
    public function toArray(Model_List_Build $buildList)
    {
        $buildMapper = new Model_Mapper_Array_Build();
        $result = array();

        $iterator = $buildList->getIterator();
        while ($iterator->valid()) {

            /*@var $build Model_Build */
            $build = $iterator->current();
            $result[$build->getBuildNumber()] = $buildMapper->toArray($build);
            $iterator->next();
        }
        return $result;
    }

}
