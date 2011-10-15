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
class PDash_BuildResolver extends PDash_ProjectSpecificResolver
{

	/**
	 * @param Model_List_Build|null $buildList
     * @return Model_List_Build
     */
    public function getBuildList(Model_List_Build $buildList = null)
    {
        if (null === $buildList) {
            $buildList = new Model_List_Build();
        }

        $projectPath = $this->project->getPath() . '/builds';

        try {
            $fileIterator = new FilesystemIterator(
                $projectPath,
                FilesystemIterator::CURRENT_AS_FILEINFO
            );
        } catch (UnexpectedValueException $e) {
            throw new InvalidArgumentException(
            	'Job directory ' . $projectPath . ' not found! '
            	. $e->getMessage()
            );
        }

        while ($fileIterator->valid()) {

            /*@var $directory SplFileInfo */
            $directory = $fileIterator->current();
            if ($directory->isDir()) {
                $build = $this->matchBuild($directory->getFilename());
                if (null !== $build) {
                    $buildList->add($build);
                }
            }
            $fileIterator->next();
        }
        return $buildList;
    }

    /**
     * @return Model_Build
     */
    private function matchBuild($directory)
    {
        if (preg_match('/^[0-9]+$/', $directory)) {
            $build = new Model_Build();
            $build->setBuildNumber((int) $directory);
            $build->setPath($this->project->getPath() . '/builds/' . $directory);
            return $build;
        }
        return null;
    }

}