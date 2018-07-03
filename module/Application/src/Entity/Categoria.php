<?php

namespace Application\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\CategoriaRepository")
 */
class Categoria extends AbstractEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, nullable=false)
     */
    private $descricao;
    
    /**
     * @var string
     *
     * @ORM\Column(name="credito", type="string", length=1, nullable=false)
     */
    private $credito;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Categoria
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * Set credito
     *
     * @param string $credito
     *
     * @return Categoria
     */
    public function setCredito($credito) {
        $this->credito = $credito;
        return $this;
    }

    /**
     * Get credito
     *
     * @return string
     */
    public function getCredito() {
        return $this->credito;
    }

}
