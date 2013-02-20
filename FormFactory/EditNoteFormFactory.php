<?php

namespace SGM\NoteBundle\FormFactory;

use SGM\NoteBundle\Model\NoteInterface;

/**
 * Instanciates note forms
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class EditNoteFormFactory extends AbstractNoteFormFactory
{
    /**
     * Edits the note
     *
     * @return Form
     */
    public function create(NoteInterface $note)
    {
        return $this->formFactory->createNamed($this->formName, $this->formType, $note);
    }
}
