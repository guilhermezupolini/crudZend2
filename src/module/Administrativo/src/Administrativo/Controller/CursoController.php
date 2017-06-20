<?php

namespace Administrativo\Controller;

use Administrativo\Model\Curso;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CursoController extends AbstractActionController
{

    public function indexAction()
    {

        $curso = new Curso();
        $curso->setNoCurso('Teste');
        $curso->setSgCurso('tt');
        $curso->setChCurso(1);

        $em         = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository('Administrativo\Model\Curso');
        echo '<pre>';
        var_dump($repository);
        exit;


        return new ViewModel();
    }


}

