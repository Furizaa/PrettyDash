<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Build Resolver
 *
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class PDash_BuildResultResolver extends PDash_BuildSpecificResolver
{

    /**
     * @return Model_BuildResult
     */
    public function getBuildResult()
    {
        $resultMapper = new Model_Mapper_Xml_BuildResult($this->buildXml);
        $buildResult = $resultMapper->load();
        return $buildResult;
    }

}