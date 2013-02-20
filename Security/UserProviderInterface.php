<?php

namespace SGM\NoteBundle\Security;

use SGM\NoteBundle\Model\UserInterface;

/**
 * Provides the authenticated user
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
interface UserProviderInterface
{
    /**
     * Gets the current authenticated user
     *
     * @return UserInterface
     */
    function getAuthenticatedUser();
}
