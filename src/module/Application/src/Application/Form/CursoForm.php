<?php

/**
 * Created by PhpStorm.
 * User: guilherme.zupolini
 * Date: 22/06/2017
 * Time: 15:19
 */
namespace Application\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class CursoForm extends Form
{
    private $name = "Curso";


    public function __construct($name = null, array $options = array())
    {
        parent::__construct($name, $options);

        $idCurso = new Hidden("idCurso");
        $idCurso->setAttributes(array(
            'id' => 'idCurso'
        ));
        $this->add($idCurso);

        $nmCurso = new Text("nmCurso");
        $nmCurso->setLabel("Nome Curso: ")
        ->setAttributes(array(
            'id' => 'nmCurso',
            'class' => 'form-control',
            'maxlength' => '100',
            'required' => true
        ))->setLabelAttributes(array('class' => 'control-label'));
        $this->add($nmCurso);

        $sgCurso = new Text("sgCurso");
        $sgCurso->setLabel("Sigla Curso: ")
        ->setAttributes(array(
            'id' => 'sgCurso',
            'maxlength' => '10',
            'required' => true,
            'class' => 'form-control'
        ))->setLabelAttributes(array('class' => 'control-label'));
        $this->add($sgCurso);

        $nuCargaHorario = new Text("nuCargaHorario");
        $nuCargaHorario->setLabel("Carga Horária: ")
        ->setAttributes(array(
            'id' => 'nuCargaHorario',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => '4'
        ))->setLabelAttributes(array('class' => 'control-label'));
        $this->add($nuCargaHorario);
    }
}