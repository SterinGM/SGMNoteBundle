<?php

namespace SGM\NoteBundle\ModelManager;

use SGM\NoteBundle\Model\UserInterface;
use SGM\NoteBundle\Model\NoteInterface;

/**
 * Interface to be implemented by note managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to notes should happen through this interface.
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
interface NoteManagerInterface
{
    /**
     * Finds a note by its ID
     *
     * @return NoteInterface or null
     */
    function findNoteById($id);

    /**
     * Gets notes created by a user
     *
     * @param UserInterface $user
     * @return array of NoteInterface
     */
    function findNotesByUser(UserInterface $user);

    /**
     * Creates an empty note instance
     *
     * @return NoteInterface
     */
    function createNote();

    /**
     * Saves a note
     *
     * @param NoteInterface $note
     * @param Boolean $andFlush Whether to flush the changes (default true)
     */
    function saveNote(NoteInterface $note, $andFlush = true);

    /**
     * Deletes a note
     * This is not user deletion but real deletion
     *
     * @param NoteInterface $note the note to delete
     */
    function deleteNote(NoteInterface $note);
}
