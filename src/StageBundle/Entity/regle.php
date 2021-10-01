<?php

namespace StageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * regle
 *
 * @ORM\Table(name="regle")
 * @ORM\Entity(repositoryClass="StageBundle\Repository\regleRepository")
 */
class regle
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
     * @ORM\ManyToOne(targetEntity="StageBundle\Entity\indexe")
     * @ORM\JoinColumn(name="indexe_id",referencedColumnName="id")
     */
    private $indexe;

    /**
     * @return mixed
     */
    public function getIndexe()
    {
        return $this->indexe;
    }

    /**
     * @param mixed $indexe
     * @return regle
     */
    public function setIndexe($indexe)
    {
        $this->indexe = $indexe;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


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
     * Set description
     *
     * @param string $description
     *
     * @return regle
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return regle
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
}

