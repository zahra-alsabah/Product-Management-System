<?php

namespace StageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * indexe
 *
 * @ORM\Table(name="indexe")
 * @ORM\Entity(repositoryClass="StageBundle\Repository\indexeRepository")
 */
class indexe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;



    /**
     * @ORM\ManyToOne(targetEntity="StageBundle\Entity\Server")
     * @ORM\JoinColumn(name="Server_id",referencedColumnName="id")
     */
    private $Server;

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->Product;
    }

    /**
     * @param mixed $Product
     * @return indexe
     */
    public function setProduct($Product)
    {
        $this->Product = $Product;
        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity="StageBundle\Entity\Product")
     * @ORM\JoinColumn(name="Product_id",referencedColumnName="id")
     */
    private $Product;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return indexe
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return indexe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->Server;
    }

    /**
     * @param mixed $Server
     * @return indexe
     */
    public function setServer($Server)
    {
        $this->Server = $Server;
        return $this;
    }

}

