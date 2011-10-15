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
class Test_Model_Mapper_ThresholdTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Model_Mapper_Xml_Threshold
     */
    private $sut;

    /**
     * @var Model_Threshold
     */
    private $model;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $sxml = simplexml_load_file(TEST_FIXTURE_PATH . '/testjobs.sprint.devops.library/config.xml');
        $sxml = $sxml->xpath('//publishers/hudson.plugins.violations.ViolationsPublisher/config/typeConfigs/entry');
        $this->sut = new Model_Mapper_Xml_Threshold($sxml[0]);
        $this->model = $this->sut->load();
    }

    public function testType()
    {
        $this->assertSame(Model_Threshold::TYPE_CHECKSTYLE, $this->model->getType());
    }

    public function testMin()
    {
        $this->assertSame(100, $this->model->getMin());
    }

    public function testMax()
    {
        $this->assertSame(300, $this->model->getMax());
    }

    public function testUnstable()
    {
        $this->assertSame(999, $this->model->getUnstable());
    }

}