<?php

namespace SGM\NoteBundle\FormFactory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactoryInterface;

use SGM\NoteBundle\FormModel\AbstractNote;

/**
 * Instanciates note forms
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
abstract class AbstractNoteFormFactory
{
    /**
     * The Symfony form factory
     *
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * The note form type
     *
     * @var AbstractType
     */
    protected $formType;

    /**
     * The name of the form
     *
     * @var string
     */
    protected $formName;

    public function __construct(FormFactoryInterface $formFactory, AbstractType $formType, $formName)
    {
        $this->formFactory = $formFactory;
        $this->formType    = $formType;
        $this->formName    = $formName;
    }
}
