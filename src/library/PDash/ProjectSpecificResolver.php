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
abstract class PDash_ProjectSpecificResolver
{

    /**
     * @var Model_Project
     */
    protected $project;

    /**
     * @var SimpleXMLElement
     */
    protected $config;

    /**
     * @param Model_Project $project
     */
    public function __construct(Model_Project $project)
    {
        $this->project = $project;
        $configFile = $this->project->getPath() . '/config.xml';
        if (!file_exists($configFile)) {
            throw new InvalidArgumentException('Config file at "' . $configFile . '" not found!');
        }
        $this->config = simplexml_load_file($configFile);
    }

}