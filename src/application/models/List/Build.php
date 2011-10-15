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
 * List of builds
 *
 * @package    Model
 * @subpackage List
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class Model_List_Build extends BowShock_List
{

    /**
     * @return Model_Build
     */
    public function findMostRecentBuild()
    {
        $mostRecent = null;
        $iterator = $this->getIterator();
        while ($iterator->valid()) {
            $current = $iterator->current();
            if (null === $mostRecent || $mostRecent->getBuildNumber() < $current->getBuildNumber() ) {
                $mostRecent = $current;
            }
            $iterator->next();
        }
        return $mostRecent;
    }

}