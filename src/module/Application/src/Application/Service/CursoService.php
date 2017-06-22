<?php

/**
 * Created by PhpStorm.
 * User: guilherme.zupolini
 * Date: 22/06/2017
 * Time: 16:36
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;

class CursoService
{
    protected static $entity = "Application\Entity\Curso";

    protected $entityManager;

    protected $em;
    protected $sm;

    function __construct(EntityManager $em, ServiceManager $sm)
    {
        $this->em = $em;
        $this->sm = $sm;
    }

    public function getServiceManager(){
        return $this->sm;
    }

    public function getEntityManager(){
        return $this->em;
    }

    public function getRepository(){
        return $this->getEntityManager()->getRepository(self::$entity);
    }

    public function listarCursos(){
        return $this->getRepository()->findAll();
    }

    public function salvarCurso($entity, $id = null){
        if($id){
            $entity = $this->getRepository()->findOneBy(array('idCurso' => $id));
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }else{
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }
    }
}