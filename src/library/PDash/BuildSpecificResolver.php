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
 * Resolver for all project specific data
 *
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
abstract class PDash_BuildSpecificResolver
{

    /**
     * @var Model_Build
     */
    protected $build;

    /**
     * @var SimpleXMLElement
     */
    protected $buildXml;

    /**
     * @param Model_Project $project
     */
    public function __construct(Model_Build $build)
    {
        $this->build = $build;
        $buildFile = $this->build->getPath() . '/build.xml';
        if (!file_exists($buildFile)) {
            throw new InvalidArgumentException('Build file at "' . $buildFile . '" not found!');
        }
        $this->buildXml = simplexml_load_file($buildFile);
    }

}