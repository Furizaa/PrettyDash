<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Model
 * @subpackage Mapper_Xml
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Jenkins Build Xml Result Mapper
 *
 * @package    Model
 * @subpackage Mapper_Xml
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Xml_BuildResult extends BowShock_Mapper_Xml_Base
{

    public function load(Model_BuildResult $model = null)
    {
        if (null === $model) {
            $model = new Model_BuildResult();
        }

        $xml = $this->getSource();

        $csDelta = $xml->xpath('//hudson.plugins.checkstyle.CheckStyleResultAction/result/delta');
        $model->setCsDelta((int) $csDelta[0]);
        $csCount = $xml->xpath('//hudson.plugins.checkstyle.CheckStyleResultAction/result/numberOfWarnings');
        $model->setCsCount((int) $csCount[0]);

        $pmdDelta = $xml->xpath('//hudson.plugins.pmd.PmdResultAction/result/delta');
        $model->setPmdDelta((int) $pmdDelta[0]);
        $pmdCount = $xml->xpath('//hudson.plugins.pmd.PmdResultAction/result/numberOfWarnings');
        $model->setPmdCount((int) $pmdCount[0]);

        $dryDelta = $xml->xpath('//hudson.plugins.dry.DryResultAction/result/delta');
        $model->setDryDelta((int) $dryDelta[0]);
        $dryCount = $xml->xpath('//hudson.plugins.dry.DryResultAction/result/numberOfWarnings');
        $model->setDryCount((int) $dryCount[0]);

        $testsTotal = $xml->xpath('//hudson.tasks.junit.TestResultAction/totalCount');
        $testsTotal = (int)$testsTotal[0];
        $testsFailed = $xml->xpath('//hudson.tasks.junit.TestResultAction/failCount');
        $testsFailed = (int)$testsFailed[0];
        $testsSkipped = $xml->xpath('//hudson.tasks.junit.TestResultAction/skipCount');
        $testsSkipped = (int)$testsSkipped[0];

        $model->setTestsFailed($testsFailed);
        $model->setTestsSkipped($testsSkipped);
        $model->setTestsPassed($testsTotal - ($testsFailed + $testsSkipped));

        $status = $xml->xpath('/build/result');
        switch ((string)$status[0]) {
            case 'SUCCESS':
                $model->setStatus(Model_BuildResult::BUILD_STATUS_SUCCESS);
                break;
            case 'FAILED':
                $model->setStatus(Model_BuildResult::BUILD_STATUS_FAILED);
                break;
            case 'UNSTABLE':
                $model->setStatus(Model_BuildResult::BUILD_STATUS_UNSTABLE);
                break;
        }

        return $model;
    }

}