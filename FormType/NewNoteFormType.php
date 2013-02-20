<?php

namespace SGM\NoteBundle\FormType;

use SGM\NoteBundle\FormType\AbstractNoteFormType;

/**
 * Note form type for creating
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class NewNoteFormType extends AbstractNoteFormType
{
    public function getName()
    {
        return 'sgm_note_new_note';
    }
}
