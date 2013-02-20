<?php

namespace SGM\NoteBundle\Model;

use SGM\NoteBundle\Model\UserInterface;

interface NoteInterface
{
    /**
     * Gets the note unique id
     *
     * @return mixed
     */
    function getId();

    /**
     * @return string
     */
    function getSubject();

    /**
     * @param  string
     * @return null
     */
    function setSubject($subject);

    /**
     * @return text
     */
    function getBody();

    /**
     * @param  text
     * @return null
     */
    function setBody($body);

    /**
     * Gets the user that created the note
     *
     * @return UserInterface
     */
    function getUser();

    /**
     * Sets the user that created the note
     *
     * @param UserInterface
     */
    function setUser(UserInterface $user);

    /**
     * Gets the date this note was created at
     *
     * @return DateTime
     */
    function getCreateTime();

    /**
     * Sets the date this note was created at
     *
     * @param DateTime
     */
    function setCreateTime(\DateTime $createTime);
}
