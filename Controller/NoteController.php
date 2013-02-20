<?php

namespace SGM\NoteBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;

use SGM\NoteBundle\Provider\ProviderInterface;

/**
 * Note controller.
 */
class NoteController extends ContainerAware
{
    /**
     * List all notes.
     */
    public function listAction()
    {
        $notes = $this->getProvider()->getNotesByUser();

        return $this->container->get('templating')->renderResponse('SGMNoteBundle:Note:list.html.twig', array(
            'notes'   => $notes,
            'manager' => $this->container->get('sgm_note.note_manager'),
        ));
    }

    /**
     * Displays a form and creates a new note.
     */
    public function newAction()
    {
        $form = $this->container->get('sgm_note.new_note_form.factory')->create();
        $formHandler = $this->container->get('sgm_note.new_note_form.handler');

        if ($formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('sgm_note_list'));
        }

        return $this->container->get('templating')->renderResponse('SGMNoteBundle:Note:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form and edits an existing note.
     */
    public function editAction($noteId)
    {
        $note = $this->getProvider()->getNote($noteId);

        $form = $this->container->get('sgm_note.edit_note_form.factory')->create($note);
        $formHandler = $this->container->get('sgm_note.edit_note_form.handler');

        if ($formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('sgm_note_list'));
        }

        return $this->container->get('templating')->renderResponse('SGMNoteBundle:Note:edit.html.twig', array(
            'note'      => $note,
            'edit_form' => $form->createView(),
        ));
    }

    /**
     * Deletes a note.
     */
    public function deleteAction($noteId, $token)
    {
        $note = $this->getProvider()->getNote($noteId, $token);

        $this->container->get('sgm_note.note_manager')->deleteNote($note);

        return new RedirectResponse($this->container->get('router')->generate('sgm_note_list'));
    }

    /**
     * Gets the provider service
     *
     * @return ProviderInterface
     */
    protected function getProvider()
    {
        return $this->container->get('sgm_note.provider');
    }
}
