<?php

namespace SGM\NoteBundle\EntityManager;

use SGM\NoteBundle\ModelManager\NoteManager as BaseNoteManager;

use Doctrine\ORM\EntityManager;

use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfProviderInterface;

use SGM\NoteBundle\Model\NoteInterface;
use SGM\NoteBundle\Model\UserInterface;

/**
 * Default ORM NoteManager.
 *
 * @author Grigoriy Sterin <muxajibi41981@gmail.com>
 */
class NoteManager extends BaseNoteManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var DocumentRepository
     */
    protected $repository;

    /**
     * The model class
     *
     * @var string
     */
    protected $class;

    /**
     * The csrf note provider instance
     *
     * @var CsrfProviderInterface
     */
    protected $csrfNoteProvider;

    /**
     * Constructor.
     *
     * @param EntityManager     $em
     * @param string            $class
     */
    public function __construct(EntityManager $em, $class, CsrfProviderInterface $csrfNoteProvider)
    {
        $this->em               = $em;
        $this->repository       = $em->getRepository($class);
        $this->class            = $em->getClassMetadata($class)->name;
        $this->csrfNoteProvider = $csrfNoteProvider;
    }

    /**
     * Finds a note by its ID
     *
     * @return NoteInterface or null
     */
    public function findNoteById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Gets notes created by a user
     *
     * @param UserInterface $user
     * @return array of NoteInterface
     */
    public function findNotesByUser(UserInterface $user)
    {
        return $this->repository->createQueryBuilder('n')
            ->where('n.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }

    /**
     * Saves a note
     *
     * @param NoteInterface $note
     * @param Boolean $andFlush Whether to flush the changes (default true)
     */
    public function saveNote(NoteInterface $note, $andFlush = true)
    {
        $this->em->persist($note);

        if ($andFlush)
        {
            $this->em->flush();
        }
    }

    /**
     * Deletes a note
     *
     * @param NoteInterface $note the note to delete
     */
    public function deleteNote(NoteInterface $note)
    {
        $this->em->remove($note);
        $this->em->flush();
    }

    /**
     * Returns the fully qualified comment thread class name
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get token for deliting a note
     *
     * @param NoteInterface $note
     * @return string
     */
    public function getToken(NoteInterface $note)
    {
        return $this->csrfNoteProvider->generateCsrfToken($note);
    }
}
