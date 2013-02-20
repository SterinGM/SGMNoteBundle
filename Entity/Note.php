<?php

namespace SGM\NoteBundle\Entity;

use SGM\NoteBundle\Model\Note as BaseNote;
use SGM\NoteBundle\Model\UserInterface;

abstract class Note extends BaseNote
{
    /**
     * User that created the note
     *
     * @var UserInterface
     */
    protected $user;
}