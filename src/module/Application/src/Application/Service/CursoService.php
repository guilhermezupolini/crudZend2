<?php

/**
 * Created by PhpStorm.
 * User: guilherme.zupolini
 * Date: 22/06/2017
 * Time: 16:36
 */

namespace Application\Service;

use Application\Entity\Curso;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\ArraySerializable;
use Zend\Stdlib\Hydrator\ClassMethods;

class CursoService
{
    protected static $entity = "Application\Entity\Curso";

    protected $entityManager;

    protected $em;
    protected $sm;

    function __construct(ServiceManager $sm, EntityManager $em)
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

    public function buscarCurso($id){
        return $this->getRepository()->findOneBy(array('idCurso' => $id));
    }

    public function buscarCursos($criterios){
        return $this->getRepository()->findBy($criterios);
//        return $this->getRepository()->findByBuscarCursos();
    }

    public function removerCurso($id){
        $entity = $this->getRepository()->findOneBy(array('idCurso' => $id));
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function salvarCurso($data, $id = null){
        $object = new Curso();
        if($id){
            $entity = $this->getRepository()->findOneBy(array('idCurso' => $id));
            $hydrator = new ClassMethods();
            $updateEntity = $hydrator->hydrate($data, $entity);
            $this->getEntityManager()->persist($updateEntity);
            $this->getEntityManager()->flush();
        }else{
            $hydrator = new ClassMethods();
            $entity = $hydrator->hydrate($data, $object);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }
    }
}