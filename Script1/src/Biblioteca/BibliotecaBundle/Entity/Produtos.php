<?php

namespace Biblioteca\BibliotecaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produtos
 *
 * @ORM\Table(name="Produtos")
 * @ORM\Entity
 */
class Produtos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="Titulo2", type="string", length=255)
     */
    private $titulo2;

    /**
     * @var string
     *
     * @ORM\Column(name="Texto", type="text")
     * @Assert\NotBlank
     */
    private $texto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DataCadastro", type="datetime")
     * @Assert\NotBlank
     */
    private $dataCadastro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DataAtualizacao", type="datetime")
     */
    private $dataAtualizacao;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Produtos
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Set titulo2
     *
     * @param string $titulo2
     * @return Produtos
     */
    public function setTitulo2($titulo2)
    {
        $this->titulo2 = $titulo2;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get titulo2
     *
     * @return string
     */
    public function getTitulo2()
    {
        return $this->titulo2;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Produtos
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     * @return Produtos
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime 
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set dataAtualizacao
     *
     * @param \DateTime $dataAtualizacao
     * @return Produtos
     */
    public function setDataAtualizacao($dataAtualizacao)
    {
        $this->dataAtualizacao = $dataAtualizacao;

        return $this;
    }

    /**
     * Get dataAtualizacao
     *
     * @return \DateTime 
     */
    public function getDataAtualizacao()
    {
        return $this->dataAtualizacao;
    }
}
