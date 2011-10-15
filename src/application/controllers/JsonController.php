<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Controller
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * Json Api Controller
 *
 * @package    Controller
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class JsonController extends Zend_Controller_Action
{

    /**
     * Enable Ajax
     *
     * @see Zend_Controller_Action::init()
     */
    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        if (null !== $layout) {
            $layout->disableLayout();
        }
    }

    public function getProjectsAction()
    {
        $projectList = $this->loadProjectsList();
        $projectListMapper = new Model_Mapper_Array_ProjectList();
        $projectArray = $projectListMapper->toArray($projectList);

        return $this->_helper->json($projectArray);
    }

    public function getProjectConfigAction()
    {
        $project = $this->loadProject($this->_getParam('slug'));

        $configResolver = new PDash_ConfigResolver($project);
        $thresholdList = $configResolver->getThresholdList();

        $thresholdListMapper = new Model_Mapper_Array_ThresholdList();
        $thresholdArray = $thresholdListMapper->toArray($thresholdList);

        return $this->_helper->json($thresholdArray);
    }

    public function getBuildListAction()
    {
        $buildList = $this->loadBuildList($this->_getParam('slug'));
        $buildMapper = new Model_Mapper_Array_BuildList();
        $buildArray = $buildMapper->toArray($buildList);

        return $this->_helper->json($buildArray);
    }

    public function getRecentBuildResultAction()
    {
        $buildList = $this->loadBuildList($this->_getParam('slug'));
        $recentBuild = $buildList->findMostRecentBuild();

        $buildResultResolver = new PDash_BuildResultResolver($recentBuild);
        $buildResult = $buildResultResolver->getBuildResult();

        $buildMapper = new Model_Mapper_Array_BuildResult();
        $buildResultArray = $buildMapper->toArray($buildResult);
        $this->_helper->json($buildResultArray);
    }

    /**
     * @return Model_List_Project
     */
    private function loadProjectsList()
    {
        $defaultResolver = new PDash_ProjectResolver_DefaultProjectResolver();
        $teamResolver = new PDash_ProjectResolver_TeamProjectResolver();

        $projectList = $defaultResolver->getProjectList();
        $projectList = $teamResolver->getProjectList($projectList);
        return $projectList;
    }

    /**
     * @param string $slug
     * @return Model_Project
     */
    private function loadProject($slug)
    {
        $projectList = $this->loadProjectsList();
        $project = $projectList->getProject($slug);
        return $project;
    }

    /**
     * @param string $slug
     * @return Model_List_Build
     */
    private function loadBuildList($slug)
    {
        $project = $this->loadProject($slug);
        $buildResolver = new PDash_BuildResolver($project);
        $buildList = $buildResolver->getBuildList();
        return $buildList;
    }

}