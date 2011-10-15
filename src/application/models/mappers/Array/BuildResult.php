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
class Model_Mapper_Array_BuildResult extends BowShock_Mapper_Json_Base
{

    /**
     * @param Model_BuildResult $build
     * @return string
     */
    public function toArray(Model_BuildResult $build)
    {
        $result = array(
            'csDelta' => $build->getCsDelta(),
            'csCount' => $build->getCsCount(),
            'dryDelta' => $build->getDryDelta(),
            'dryCount' => $build->getDryCount(),
            'pmdDelta' => $build->getPmdDelta(),
            'pmdCount' => $build->getPmdCount(),
            'testsPassed' => $build->getTestsPassed(),
            'testsSkipped' => $build->getTestsSkipped(),
            'testsFailed' => $build->getTestsFailed(),
            'status' => $build->getStatus()
        );

        return $result;
    }

}