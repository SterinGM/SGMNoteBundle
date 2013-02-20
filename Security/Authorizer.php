<?php

namespace SGM\NoteBundle\Security;

use SGM\NoteBundle\Model\NoteInterface;
use SGM\NoteBundle\Model\UserInterface;
use SGM\NoteBundle\Security\UserProviderInterface;

/**
 * Manages permissions to manipulate notes
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class Authorizer implements AuthorizerInterface
{
    /**
     * The user provider
     *
     * @var UserProviderInterface
     */
    protected $userProvider;

    public function __construct(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    /**
     * Tells if the current user is allowed
     * to see this note
     *
     * @param NoteInterface $note
     * @return boolean
     */
    public function canSeeNote(NoteInterface $note)
    {
        return $this->getAuthenticatedUser() && $note->getUser() == $this->getAuthenticatedUser();
    }

    /**
     * Tells if the current user is allowed
     * to delete this note
     *
     * @param NoteInterface $note
     * @return boolean
     */
    public function canDeleteNote(NoteInterface $note)
    {
        return $this->canSeeThread($note);
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
