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
class Test_PDash_ProjectResolver_TeamProjectResolverTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PDash_ProjectResolver_TeamProjectResolver
     */
    private $sut;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->sut = new PDash_ProjectResolver_TeamProjectResolver();
    }

    public function testDontMatchBoogus()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops');
        $this->assertNull($project);
    }

    public function testMatchGroup()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertInstanceOf('Model_Project', $project);
        $this->assertSame('tests', $project->getGroup());
    }

    /**
     * @depends testMatchGroup
     */
    public function testMatchBranch()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertSame('sprint', $project->getBranch());
    }

	/**
     * @depends testMatchBranch
     */
    public function testMatchTeam()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertSame('devops', $project->getTeam());
    }

	/**
     * @depends testMatchTeam
     */
    public function testMatchName()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertSame('library', $project->getName());
    }

    /**
     * @depends testMatchName
     */
    public function testMatchSlug()
    {
        $project = $this->sut->matchDirectory('tests.sprint.devops.library');
        $this->assertSame('tests.sprint.devops.library', $project->getSlug());
    }

}