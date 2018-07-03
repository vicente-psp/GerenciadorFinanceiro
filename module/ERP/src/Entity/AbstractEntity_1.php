<?php
namespace ERP\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Category
 *
 * @ORM\Table(name="erp")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Categoria\Entity\CategoryRepository")
 */
class erp extends AbstractEntity
{
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
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Category
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }
}