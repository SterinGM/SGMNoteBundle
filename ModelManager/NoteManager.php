<?php

namespace SGM\NoteBundle\ModelManager;

/**
 * Abstract Note Manager implementation which can be used as base class by your
 * concrete manager.
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
abstract class NoteManager implements NoteManagerInterface
{
    /**
     * Creates an empty note instance
     *
     * @return NoteInterface
     */
    public function createNote()
    {
        $class = $this->getClass();

        $note = new $class;

        return $note;
    }
}
