<?php

namespace Administrativo\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Entity()
 * @ORM\Table(name="desafio-zf.tb_curso")
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
    private $noCurso;


    /**
     * @ORM\Column(name="sg_curso", type="string", nullable=false)
     */
    private $sgCurso;

    /**
     * @ORM\Column(name="nu_carga_horario", type="integer", nullable=false)
     */
    private $chCurso;

    public function getIdCurso()
    {
        return $this->idCurso;
    }

    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;
    }

    public function getNoCurso()
    {
        return $this->noCurso;
    }

    public function setNoCurso($noCurso)
    {
        $this->noCurso = $noCurso;
    }

    public function getSgCurso()
    {
        return $this->sgCurso;
    }

    public function setSgCurso($sgCurso)
    {
        $this->sgCurso = $sgCurso;
    }

    public function getChCurso()
    {
        return $this->chCurso;
    }

    public function setChCurso($chCurso)
    {
        $this->chCurso = $chCurso;
    }


}