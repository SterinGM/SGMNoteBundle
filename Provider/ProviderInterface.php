<?php

namespace SGM\NoteBundle\Provider;

/**
 * Provides notes for the current authenticated user
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
interface ProviderInterface
{
    /**
     * Gets the notes of the current user
     *
     * @return array of NoteInterface
     */
    function getNotesByUser();

    /**
     * Gets a note by its ID
     * Performs authorization checks
     *
     * @return NoteInterface
     */
    function getNote($noteId);
}
