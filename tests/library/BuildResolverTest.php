<?php
/**
 * PDash_Test
 *
 * @category   PDash_Test
 * @package	   Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Test_PDash_BuildResolverTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PDash_BuildResolver
     */
    private $sut;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $project = new Model_Project();
        $project->setPath(TEST_FIXTURE_PATH . '/testjobs.sprint.devops.library/');
        $this->sut = new PDash_BuildResolver($project);
    }

    public function testGetBuildList()
    {
        $list = $this->sut->getBuildList();
        $this->assertInstanceOf('Model_List_Build', $list);
        $this->assertSame(2, count($list));
    }

    /**
     * @expectedException InvalidArgumentException
     * @depends testGetBuildList
     */
    public function testInvalidDirectoryHandling()
    {
        $project = new Model_Project();
        $project->setPath('BoogusDirectory');
        $this->sut = new PDash_BuildResolver($project);
    }

}