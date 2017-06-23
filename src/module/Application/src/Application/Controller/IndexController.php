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
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $cursos = $entityManager->getRepository('Application\Entity\Curso')->findAll();

        return new ViewModel(array('cursos' => $cursos));
    }

    public function cadastroCursoAction()
    {
        $id = $this->params()->fromQuery("id");
        $form = new CursoForm("Curso");
        $tipo = "Cadastrar";

        if ($id) {
            $cursoService = $this->getServiceLocator()->get("CursoService");
            $curso = $cursoService->buscarCurso($id);

            $hydrator = new ClassMethods(false);
            $dados = $hydrator->extract($curso);

            $form->populateValues($dados);
            $tipo = "Alterar";
        }

        return new ViewModel(array('form' => $form, 'tipo' => $tipo));
    }

    public function consultarCursoAction()
    {
        $form = new CursoForm("consultarCurso");
        $form->get("nmCurso")->setAttribute('required', false);
        $form->get("sgCurso")->setAttribute('required', false);
        return new ViewModel(array('form' => $form));
    }

    public function salvarCursoAction()
    {
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();

        if ($post) {
            try {
                $cursoService = $this->getServiceLocator()->get("CursoService");

                if ($post['idCurso']) {
                    $cursoService->salvarCurso($post, $post['idCurso']);
                } else {
                    $cursoService->salvarCurso($post);
                }

                $msg = $post['idCurso'] ? "Dado(s) alterado(s) com sucesso !" : "Dado(s) salvo com sucesso !";

                $retorno = array('msg' => $msg, 'status' => 'sucesso');
            } catch (Exception $e) {
                $retorno = array('msg' => 'Erro ao salvar o(s) dado(s)', 'status' => 'erro');
            }
        } else {
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

    public function removerCursoAction()
    {
        $id = $this->params()->fromQuery("id");

        var_dump($id);

        $retorno = array();

        return $this->getResponse()->setContent(json_encode($retorno));
    }

    public function listarCursoAction()
    {
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();
        $cursoService = $this->getServiceLocator()->get("CursoService");
        $criterios = array();

        if($post['nmCurso'] != '') $criterios['nmCurso'] = $post['nmCurso'];
        if($post['sgCurso'] != '') $criterios['sgCurso'] = $post['sgCurso'];

        $dados = $criterios ? $cursoService->buscarCursos($criterios) : $cursoService->listarCursos();

//        var_dump($dados);exit;

        $hydrator = new ClassMethods(false);

        $cursos = array();

        foreach ($dados as $dado) {
            $cursos[] = $hydrator->extract($dado);
        }

        $retorno = array('msg' => 'ajax retornado', 'dados' => $cursos);

        return $this->getResponse()->setContent(json_encode($retorno));
    }
}
