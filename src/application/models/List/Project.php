<?php
/**
 * PrettyDash
 *
 * @category   PrettyDash
 * @package    Model
 * @subpackage List
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * List of Projects
 *
 * @package    Model
 * @subpackage List
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_List_Project extends BowShock_List
{

    /**
     * Get project with slug
     *
     * @param string $projectSlug
     * @return Model_Project | null
     */
    public function getProject($projectSlug)
    {
        return $this->find('slug', $projectSlug);
    }

}