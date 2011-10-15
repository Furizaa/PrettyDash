<?php
/**
 * PrettyDash_Test
 *
 * @category   PrettyDash_Test
 * @package	   Model
 * @subpackage List
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Test Case
 *
 * @package    Model
 * @subpackage List
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Test_Model_List_BuildTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Model_List_Build
     */
    private $sut;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->sut = new Model_List_Build();

        $buildLow = new Model_Build();
        $buildLow->setBuildNumber(50);
        $this->sut->add($buildLow);

        $buildRecent = new Model_Build();
        $buildRecent->setBuildNumber(3123);
        $this->sut->add($buildRecent);

        $buildHigh = new Model_Build();
        $buildHigh->setBuildNumber(3122);
        $this->sut->add($buildHigh);
    }

    public function testFindMostRecentBuild()
    {
        $recent = $this->sut->findMostRecentBuild();
        $this->assertSame(3123, $recent->getBuildNumber());
    }

}