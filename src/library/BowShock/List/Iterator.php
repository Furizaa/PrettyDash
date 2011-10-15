<?php
/**
 * BowShock
 *
 * @category   BowShock
 * @package    List
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @since      File available since Release 1.0.0
 */

/**
 * List Iterator
 *
 * @package    List
 * @subpackage
 * @author     Andreas Hoffmann <furizaa@gmail.com>
 * @copyright  2010-2011 Andreas Hoffmann <furizaa@gmail.com>
 * @version    Release: $Id:$
 * @since      Class available since Release 1.0.0
 */
class BowShock_List_Iterator implements Iterator
{

    /**
     * @var array
     */
    private $data;

    /**
     * @var int
     */
    private $pointer = 0;

    /**
     * Constructor
     */
    public function __construct($data)
    {
        $this->data = (array)$data;
    }

    /* (non-PHPdoc)
     * @see Iterator::current()
     */
    public function current()
    {
        return $this->data[$this->pointer];
    }

    /* (non-PHPdoc)
     * @see Iterator::next()
     */
    public function next()
    {
        $this->pointer++;
    }

    /* (non-PHPdoc)
     * @see Iterator::key()
     */
    public function key()
    {
        return $this->pointer;
    }

    /* (non-PHPdoc)
     * @see Iterator::valid()
     */
    public function valid()
    {
        return (count($this->data) > $this->pointer);
    }

    /* (non-PHPdoc)
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

}