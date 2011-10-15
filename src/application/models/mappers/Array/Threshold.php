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
 * Array Threshold mapper
 *
 * @package    Model
 * @subpackage Mapper
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Array_Threshold extends BowShock_Mapper_Json_Base
{

    /**
     * @param Model_Threshold $threshold
     * @return string
     */
    public function toArray(Model_Threshold $threshold)
    {
        $result = array(
            'min' =>   (string)$threshold->getMin(),
            'max' =>   (string)$threshold->getMax(),
            'unstable' => (string)$threshold->getUnstable(),
            'type' =>   (string)$threshold->getType()
        );

        return $result;
    }

}