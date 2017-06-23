<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Entity
 * @ORM\Table(name="tb_curso")
 */
class Curso
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(name="id_curso", type="integer", nullable=false)
     */
    private $idCurso;


    /**
     * @ORM\Column(name="nm_curso", type="string", nullable=false)
     */
    private $nmCurso;


    /**
     * @ORM\Column(name="sg_curso", type="string", nullable=false)
     */
    private $sgCurso;

    /**
     * @ORM\Column(name="nu_carga_horario", type="integer", nullable=false)
     */
    private $nuCargaHorario;

    public function getIdCurso()
    {
        return $this->idCurso;
    }

    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;
    }

    public function getNmCurso()
    {
        return $this->nmCurso;
    }

    public function setNmCurso($nmCurso)
    {
        $this->nmCurso = $nmCurso;
    }

    public function getSgCurso()
    {
        return $this->sgCurso;
    }

    public function setSgCurso($sgCurso)
    {
        $this->sgCurso = $sgCurso;
    }

    public function getNuCargaHorario()
    {
        return $this->nuCargaHorario;
    }

    public function setNuCargaHorario($nuCargaHorario)
    {
        $this->nuCargaHorario = $nuCargaHorario;
    }


}
