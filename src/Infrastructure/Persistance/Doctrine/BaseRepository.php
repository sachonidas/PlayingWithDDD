<?php

namespace PlayDDD\Infrastructure\Persistance\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    /**
     * @return string
     */
    abstract public static function getEntity(): string;

    /**
     * BaseRepository constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(static::getEntity()));
    }

}