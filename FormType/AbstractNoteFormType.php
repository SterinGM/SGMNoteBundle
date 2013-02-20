<?php

namespace SGM\NoteBundle\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Abstract Note form type
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
abstract class AbstractNoteFormType extends AbstractType
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', null, array(
                'label' => 'subject',
                'translation_domain' => 'SGMNoteBundle'
            ))
            ->add('body', null, array(
                'label' => 'body',
                'translation_domain' => 'SGMNoteBundle'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    abstract public function getName();
}
