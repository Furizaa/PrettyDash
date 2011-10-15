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
 * Threshold List Array Mapper
 *
 * @package    Model
 * @subpackage Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Array_ThresholdList extends BowShock_Mapper_Json_Base
{

	/**
     * @param Model_List_Threshold $thresholdList
     * @return string
     */
    public function toArray(Model_List_Threshold $thresholdList)
    {
        $thresholdMapper = new Model_Mapper_Array_Threshold();
        $result = array();

        $iterator = $thresholdList->getIterator();
        while ($iterator->valid()) {

            /*@var $threshold Model_Threshold */
            $threshold = $iterator->current();
            $result[$threshold->getType()] = $thresholdMapper->toArray($threshold);
            $iterator->next();
        }
        return $result;
    }

}
