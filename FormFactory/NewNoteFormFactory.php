<?php

namespace SGM\NoteBundle\FormFactory;

/**
 * Instanciates note forms
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class NewNoteFormFactory extends AbstractNoteFormFactory
{
    /**
     * Creates a new note
     *
     * @return Form
     */
    public function create()
    {
        return $this->formFactory->createNamed($this->formName, $this->formType);
    }
}
