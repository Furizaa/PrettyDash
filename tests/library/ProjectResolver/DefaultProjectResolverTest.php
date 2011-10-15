<?php
/**
 * PDash_Test
 *
 * @category   PDash_Test
 * @package	   Library
 * @subpackage ProjectResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Library
 * @subpackage ProjectResolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Test_PDash_ProjectResolver_DefaultProjectResolverTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PDash_ProjectResolver_DefaultProjectResolver
     */
    private $sut;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->sut = new PDash_ProjectResolver_DefaultProjectResolver();
    }

    public function testDontMatchBoogus()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertNull($project);
    }

    public function testMatchGroup()
    {
        $project = $this->sut->matchDirectory('ecomm.default.library');
        $this->assertInstanceOf('Model_Project', $project);
        $this->assertSame('ecomm', $project->getGroup());
    }

    /**
     * @depends testMatchGroup
     */
    public function testMatchBranch()
    {
        $project = $this->sut->matchDirectory('ecomm.default.library');
        $this->assertSame('default', $project->getBranch());
    }

	/**
     * @depends testMatchBranch
     */
    public function testMatchName()
    {
        $project = $this->sut->matchDirectory('ecomm.default.library');
        $this->assertSame('library', $project->getName());
    }

    /**
     * @depends testMatchName
     */
    public function testMatchSlug()
    {
        $project = $this->sut->matchDirectory('ecomm.default.library');
        $this->assertSame('ecomm.default.library', $project->getSlug());
    }

}