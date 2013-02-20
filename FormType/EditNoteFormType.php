<?php

namespace SGM\NoteBundle\FormType;

use SGM\NoteBundle\FormType\AbstractNoteFormType;

/**
 * Note form type for editing
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class EditNoteFormType extends AbstractNoteFormType
{
    public function getName()
    {
        return 'sgm_note_edit_note';
    }
}
