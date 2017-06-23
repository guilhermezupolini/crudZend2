<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Curso;
use Application\Form\CursoForm;
use Application\Service\CursoService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $cursos        = $entityManager->getRepository('Application\Entity\Curso')->findAll();

        return new ViewModel(array('cursos' => $cursos));
    }

    public function cadastrarCursoAction(){
        $form = new CursoForm("Curso");
        return new ViewModel(array('form' => $form));
    }

    public function consultarCursoAction(){
        $teste = "cheguei aqui consultar";
        return new ViewModel(array('teste' => $teste));
    }

    public function salvarCursoAction(){
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();

        if($post){
            try{

                $curso = new Curso();
                $curso->getIdCurso($post['idCurso'] ? $post['idCurso'] : null);
                $curso->setNoCurso($post['nmCurso']);
                $curso->setSgCurso($post['sgCurso']);
                $curso->setChCurso($post['nuCargaHorario']);

                $cursoService = $this->getServiceLocator()->get("CursoService");
                $cursoService->salvarCurso($curso);

                $msg = $post['idCurso'] ? "Dado(s) alterado(s) com sucesso !" : "Dado(s) salvo com sucesso !";

                $retorno = array('msg' => $msg, 'status' => 'sucesso');
            }catch(Exception $e){
                $retorno = array('msg' => 'Erro ao salvar o(s) dado(s)', 'status' => 'erro');
            }
        }else{
//            try{
//
//                $curso = new Curso();
//                $curso->setNoCurso($post['nmCurso']);
//                $curso->setSgCurso($post['sgCurso']);
//                $curso->setChCurso($post['nuCargaHorario']);
//
//                $cursoService = $this->getServiceLocator()->get("Application\Service\CursoService");
//                $cursoService->salvar($curso, $post['idCurso']);
//
//                $retorno = array('msg' => 'Dado(s) alterado(s) com sucesso', 'status' => 'sucesso');
//            }catch(Exception $e){
                $retorno = array('msg' => 'Erro ao alterar o(s) dado(s)', 'status' => 'sucesso');
//            }
        }


        return $this->getResponse()->setContent(json_encode($retorno));
    }

    public function listarCursoAction(){
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();

        $retorno = array('msg' => 'ajax retornado');

        return $this->getResponse()->setContent(json_encode($retorno));
    }
}
