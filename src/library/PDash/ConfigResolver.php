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
 * Resolver for job configruration
 *
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class PDash_ConfigResolver extends PDash_ProjectSpecificResolver
{

    /**
     * @param Model_List_Threshold|null $list
     * @return Model_List_Threshold
     */
    public function getThresholdList(Model_List_Threshold $list = null)
    {
        if (null === $list) {
            $list = new Model_List_Threshold();
        }

        $xmlEntries = $this->config->xpath('//hudson.plugins.violations.ViolationsPublisher/config/typeConfigs/entry');
        foreach ($xmlEntries as $xmlEntry) {
            $mapper = new Model_Mapper_Xml_Threshold($xmlEntry);
            $list->add($mapper->load());
            unset($mapper);
        }
        return $list;
    }


}