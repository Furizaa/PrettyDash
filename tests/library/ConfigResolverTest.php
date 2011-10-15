<?php
/**
 * PDash_Test
 *
 * @category   PDash_Test
 * @package	   Library
 * @subpackage ConfigResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Library
 * @subpackage ConfigResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Test_PDash_ConfigResolverTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PDash_ConfigResolver
     */
    private $sut;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $project = new Model_Project();
        $project->setPath(TEST_FIXTURE_PATH . '/testjobs.sprint.devops.library/');
        $this->sut = new PDash_ConfigResolver($project);
    }

    public function testGetTresholdList()
    {
        $list = $this->sut->getThresholdList();
        $this->assertInstanceOf('Model_List_Threshold', $list);
        $this->assertSame(12, count($list));
    }


}