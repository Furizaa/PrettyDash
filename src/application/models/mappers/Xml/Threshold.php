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
 * Threshold Xml Mapper
 *
 * @package    Model
 * @subpackage Mapper_Xml
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_Mapper_Xml_Threshold extends BowShock_Mapper_Xml_Base
{

    /**
     * @param Model_Threshold|null $threshold
     */
    public function load(Model_Threshold $threshold = null)
    {
        if (null === $threshold) {
            $threshold = new Model_Threshold();
        }

        $xml = $this->getSource();

        $threshold->setType((string) $xml->{'hudson.plugins.violations.TypeConfig'}->type);
        $threshold->setMin((int) $xml->{'hudson.plugins.violations.TypeConfig'}->min);
        $threshold->setMax((int) $xml->{'hudson.plugins.violations.TypeConfig'}->max);
        $threshold->setUnstable((int) $xml->{'hudson.plugins.violations.TypeConfig'}->unstable);

        return $threshold;
    }

}