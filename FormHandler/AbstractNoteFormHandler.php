<?php

namespace SGM\NoteBundle\FormHandler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

use SGM\NoteBundle\Security\UserProviderInterface;
use SGM\NoteBundle\Model\UserInterface;
use SGM\NoteBundle\Model\NoteInterface;
use SGM\NoteBundle\ModelManager\NoteManagerInterface;

/**
 * Handles notes forms, from binding request to creating the note
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
abstract class AbstractNoteFormHandler
{
    /**
     * Request
     *
     * @var Request
     */
    protected $request;

    /**
     * Note manager
     *
     * @var NoteManagerInterface
     */
    protected $noteManager;

    /**
     * User provider
     *
     * @var UserProviderInterface
     */
    protected $userProvider;

    public function __construct(Request $request, NoteManagerInterface $noteManager, UserProviderInterface $userProvider)
    {
        $this->request      = $request;
        $this->noteManager  = $noteManager;
        $this->userProvider = $userProvider;
    }

    /**
     * Processes the form with the request
     *
     * @param Form $form
     * @return Note|false create note if the form is bound and valid, false otherwise
     */
    public function process(Form $form)
    {
        if ('POST' !== $this->request->getMethod()) {
            return false;
        }

        $form->bindRequest($this->request);

        if ($form->isValid()) {
            return $this->processValidForm($form);
        }

        return false;
    }

    /**
     * Processes the valid form, create the note
     *
     * @param Form
     * @return NoteInterface create note
     */
    public function processValidForm(Form $form)
    {
        $data = $form->getData();

        if (!$data instanceof NoteInterface) {
            throw new \InvalidArgumentException(sprintf('Note must be a NoteInterface instance, "%s" given', get_class($data)));
        }

        $note = $this->composeNote($data);

        $this->noteManager->saveNote($note);

        return $note;
    }

    /**
     * Composes a note from the form data
     *
     * @param NoteInterface $note
     * @return NoteInterface the composed note ready to create
     */
    abstract protected function composeNote(NoteInterface $note);

    /**
     * Gets the current authenticated user
     *
     * @return UserInterface
     */
    protected function getAuthenticatedUser()
    {
        return $this->userProvider->getAuthenticatedUser();
    }
}
