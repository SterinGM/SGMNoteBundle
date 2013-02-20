<?php

namespace SGM\NoteBundle\Provider;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;

use SGM\NoteBundle\ModelManager\NoteManagerInterface;
use SGM\NoteBundle\Security\AuthorizerInterface;
use SGM\NoteBundle\Security\UserProviderInterface;

/**
 * Provides notes for the current authenticated user
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class Provider implements ProviderInterface
{
    /**
     * The note manager
     *
     * @var NoteManagerInterface
     */
    protected $noteManager;

    /**
     * The authorizer manager
     *
     * @var authorizerInterface
     */
    protected $authorizer;

    /**
     * The user provider instance
     *
     * @var UserProviderInterface
     */
    protected $userProvider;

    /**
     * The csrf note provider instance
     *
     * @var CsrfProviderInterface
     */
    protected $csrfNoteProvider;

    public function __construct(NoteManagerInterface $noteManager, AuthorizerInterface $authorizer, UserProviderInterface $userProvider, CsrfProviderInterface $csrfNoteProvider)
    {
        $this->noteManager      = $noteManager;
        $this->authorizer       = $authorizer;
        $this->userProvider     = $userProvider;
        $this->csrfNoteProvider = $csrfNoteProvider;
    }

    /**
     * Gets the notes of the current user
     *
     * @return array of NoteInterface
     */
    public function getNotesByUser()
    {
        $user = $this->getAuthenticatedUser();

        return $this->noteManager->findNotesByUser($user);
    }

    /**
     * Gets a note by its ID
     * Performs authorization checks
     *
     * @return NoteInterface
     */
    public function getNote($noteId, $token = false)
    {
        $note = $this->noteManager->findNoteById($noteId);

        if (!$note) {
            throw new NotFoundHttpException('There is no such note');
        }

        if (!$this->authorizer->canSeeNote($note)) {
            throw new AccessDeniedException('You are not allowed to see this note');
        }

        if ($token && !$this->csrfNoteProvider->isCsrfTokenValid($note, $token)) {
            throw new AccessDeniedException('Token is invalid.');
        }

        return $note;
    }

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
