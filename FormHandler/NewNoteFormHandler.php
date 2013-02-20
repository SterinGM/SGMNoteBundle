<?php

namespace SGM\NoteBundle\FormHandler;

use SGM\NoteBundle\Model\NoteInterface;

class NewNoteFormHandler extends AbstractNoteFormHandler
{
    /**
     * Composes a note from the form data
     *
     * @param NoteInterface $note
     * @return NoteInterface the composed note ready to create
     */
    public function composeNote(NoteInterface $note)
    {
        $note->setUser($this->getAuthenticatedUser());

        return $note;
    }
}
