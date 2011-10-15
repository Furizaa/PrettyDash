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
class Test_PDash_ProjectResolverTest extends PHPUnit_Framework_TestCase
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
        PDash_ProjectResolver::factory(TEST_FIXTURE_PATH);
        $this->sut = new PDash_ProjectResolver_TeamProjectResolver();
    }

    public function testGetProjectList()
    {
        $list = $this->sut->getProjectList();
        $this->assertSame(1, count($list));
    }

    /**
     * @expectedException InvalidArgumentException
     * @depends testGetProjectList
     */
    public function testInvalidDirectoryHandling()
    {
        PDash_ProjectResolver::factory('boogus_dir');
        $this->sut->getProjectList();
    }

}