<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibroRepository::class)
 */
class Libro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sinopsis;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $n_paginas;

    /**
     * @ORM\ManyToOne(targetEntity=Editorial::class, inversedBy="libros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editoriales_id;

    /**
     * @ORM\ManyToMany(targetEntity=Autor::class, mappedBy="libros_isbn")
     */
    private $autores_id;

    public function __construct()
    {
        $this->autores_id = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->sinopsis;
    }

    public function setSinopsis(?string $sinopsis): self
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    public function getNPaginas(): ?string
    {
        return $this->n_paginas;
    }

    public function setNPaginas(?string $n_paginas): self
    {
        $this->n_paginas = $n_paginas;

        return $this;
    }

    public function getEditorialesId(): ?Editorial
    {
        return $this->editoriales_id;
    }

    public function setEditorialesId(?Editorial $editoriales_id): self
    {
        $this->editoriales_id = $editoriales_id;

        return $this;
    }

    /**
     * @return Collection|Autor[]
     */
    public function getAutoresId(): Collection
    {
        return $this->autores_id;
    }

    public function addAutoresId(Autor $autoresId): self
    {
        if (!$this->autores_id->contains($autoresId)) {
            $this->autores_id[] = $autoresId;
            $autoresId->addLibrosIsbn($this);
        }

        return $this;
    }

    public function removeAutoresId(Autor $autoresId): self
    {
        if ($this->autores_id->removeElement($autoresId)) {
            $autoresId->removeLibrosIsbn($this);
        }

        return $this;
    }
}
