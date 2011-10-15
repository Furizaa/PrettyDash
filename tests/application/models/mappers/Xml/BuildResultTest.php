<?php
/**
 * PrettyDash_Test
 *
 * @category   PrettyDash_Test
 * @package
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Test_Model_Mapper_BuildResultTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Model_Mapper_Xml_BuildResult
     */
    private $sut;

    /**
     * @var Model_BuildResult
     */
    private $model;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->sut = new Model_Mapper_Xml_BuildResult(
            TEST_FIXTURE_PATH . '/testjobs.sprint.devops.library/builds/57/build.xml'
        );
        $this->model = $this->sut->load();
    }

    public function testCheckStyleDelta()
    {
        $this->assertSame(5, $this->model->getCsDelta());
    }

    /**
     * @depends testCheckStyleDelta
     */
    public function testCheckstyleCount()
    {
        $this->assertSame(50, $this->model->getCsCount());
    }

    /**
     * @depends testCheckstyleCount
     */
    public function testPmdDelta()
    {
        $this->assertSame(-7, $this->model->getPmdDelta());
    }

    /**
     * @depends testPmdDelta
     */
    public function testPmdCount()
    {
        $this->assertSame(100, $this->model->getPmdCount());
    }

    /**
     * @depends testPmdCount
     */
    public function testDryDelta()
    {
        $this->assertSame(1, $this->model->getDryDelta());
    }

    /**
     * @depends testDryDelta
     */
    public function testDryCount()
    {
        $this->assertSame(150, $this->model->getDryCount());
    }

    /**
     * @depends testDryCount
     */
    public function testTestsPassed()
    {
        $this->assertSame(5, $this->model->getTestsPassed());
    }

    /**
     * @depends testTestsPassed
     */
    public function testTestsSkipped()
    {
        $this->assertSame(2, $this->model->getTestsSkipped());
    }

    /**
     * @depends testTestsSkipped
     */
    public function testTestsFailed()
    {
        $this->assertSame(3, $this->model->getTestsFailed());
    }

    /**
     * @depends testTestsFailed
     */
    public function testBuildStatus()
    {
        $this->assertSame(Model_BuildResult::BUILD_STATUS_SUCCESS, $this->model->getStatus());
    }

}