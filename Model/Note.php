<?php

namespace SGM\NoteBundle\Model;

use SGM\NoteBundle\Model\UserInterface;

/**
 * Abstract note model
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
abstract class Note implements NoteInterface
{
    /**
     * Unique id of the note
     *
     * @var mixed
     */
    protected $id;

    /**
     * Text subject of the note
     *
     * @var string
     */
    protected $subject;

    /**
     * Text body of the note
     *
     * @var text
     */
    protected $body;

    /**
     * Date this note was created at
     *
     * @var DateTime
     */
    protected $createTime;

    /**
     * User that created the note
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createTime = new \DateTime();
    }

    /**
     * To string.
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::getCreateTime()
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::setCreateTime()
     */
    public function setCreateTime(\DateTime $createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::getUser()
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::setUser()
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::setSubject()
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::getBody()
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @see SGM\NoteBundle\Model\NoteInterface::setBody()
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}