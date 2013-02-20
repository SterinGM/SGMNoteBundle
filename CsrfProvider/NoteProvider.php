<?php

namespace SGM\NoteBundle\CsrfProvider;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider;

class NoteProvider extends DefaultCsrfProvider
{
    public function __construct($secret)
    {
        parent::__construct($secret);
    }

    /**
     * {@inheritDoc}
     */
    public function generateCsrfToken($intention)
    {
        return parent::generateCsrfToken($intention . 'sgm_note_delete');
    }
}
