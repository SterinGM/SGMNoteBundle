<?php

namespace SGM\NoteBundle\Security;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use SGM\NoteBundle\Model\UserInterface;

/**
 * Provides the authenticated user
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class UserProvider implements UserProviderInterface
{
    /**
     * The security context
     *
     * @var SecurityContextInterface
     */
    protected $securityContext;

    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * Gets the current authenticated user
     *
     * @return UserInterface
     */
    public function getAuthenticatedUser()
    {
        $user = $this->securityContext->getToken()->getUser();

        if (!$user instanceof UserInterface) {
            throw new AccessDeniedException('Must be logged in with a UserInterface instance');
        }

        return $user;
    }
}
