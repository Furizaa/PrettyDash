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
class Model_Mapper_Array_Build extends BowShock_Mapper_Json_Base
{

    /**
     * @param Model_Build $build
     * @return string
     */
    public function toArray(Model_Build $build)
    {
        $result = array(
            'path' =>   (string)$build->getPath(),
            'buildNumber' =>   (int)$build->getBuildNumber()
        );

        return $result;
    }

}