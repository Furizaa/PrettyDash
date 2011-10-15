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
 * Abstract base project resolver connects to the jenkins projects file
 * system.
 *
 * @package    Library
 * @subpackage Resolver
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
abstract class PDash_ProjectResolver
{

    /**
     * @var string
     */
    private static $projectPath = '/home/furizaa/';

    /**
     * @param string $jenkinsProjectPath
     * 				 Path to jenkins project folder
     */
    public static function factory($jenkinsProjectPath)
    {
        self::$projectPath = $jenkinsProjectPath;
    }

    /**
     * @param string $dirName
     * @return Model_Project | null
     */
    public abstract function matchDirectory($dirName);

    /**
     * @return Model_List_Project
     * @param Model_List_Project | null $projectList
     * 	      If provided, projects will be appended to the list
     */
    public function getProjectList(Model_List_Project $projectList = null)
    {
        if (null === $projectList) {
            $projectList = new Model_List_Project();
        }

        try {
            $fileIterator = new FilesystemIterator(
                self::$projectPath,
                FilesystemIterator::CURRENT_AS_FILEINFO
            );
        } catch (UnexpectedValueException $e) {
            throw new InvalidArgumentException(
            	'Job directory ' . self::$projectPath . ' not found! '
            	. $e->getMessage()
            );
        }

        while ($fileIterator->valid()) {

            /*@var $directory SplFileInfo */
            $directory = $fileIterator->current();
            if ($directory->isDir()) {
                $project = $this->matchDirectory($directory->getFilename());
                if (null !== $project) {
                    $project->setPath(self::$projectPath . $directory->getFilename());
                    $projectList->add($project);
                }
            }
            $fileIterator->next();
        }
        return $projectList;
    }

}