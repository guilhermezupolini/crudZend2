<?php

/**
 * Created by PhpStorm.
 * User: guilherme.zupolini
 * Date: 22/06/2017
 * Time: 16:35
 */

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CursoRepository extends EntityRepository
{
    public static $entity = "Application\Entity\Curso";

    public function getRepository(){
        return $this->getEntityManager()->getRepository(self::$entity);
    }

    public function buscarCursos(){
        $qb = $this->createNamedQuery("SELECT * FROM tb_curso");
        return $qb->getResult();
    }
}