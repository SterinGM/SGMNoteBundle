<?php

namespace SGM\NoteBundle\Security;

use SGM\NoteBundle\Model\NoteInterface;
use SGM\NoteBundle\Model\UserInterface;

/**
 * Manages permissions to manipulate notes
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
interface AuthorizerInterface
{
    /**
     * Tells if the current user is allowed
     * to see this note
     *
     * @param NoteInterface $note
     * @return boolean
     */
    function canSeeNote(NoteInterface $note);

    /**
     * Tells if the current participant is allowed
     * to delete this note
     *
     * @param NoteInterface $note
     * @return boolean
     */
    function canDeleteNote(NoteInterface $note);
}
