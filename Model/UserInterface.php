<?php

namespace SGM\NoteBundle\Model;

/**
 * A user created a note.
 * May be implemented by a FOS\UserBundle user document or entity.
 * Or anything you use to represent users in the application.
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
interface UserInterface
{
    /**
     * Gets the unique identifier of the user
     *
     * @return string
     */
    function getId();
}
