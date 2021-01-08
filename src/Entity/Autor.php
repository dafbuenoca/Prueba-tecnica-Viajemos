<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutorRepository::class)
 */
class Autor
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $apellidos;

    /**
     * @ORM\ManyToMany(targetEntity=Libro::class, inversedBy="autores_id")
     */
    private $libros_isbn;

    public function __construct()
    {
        $this->libros_isbn = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->apellidos. ' '. $this->nombre ;
    }

    /**
     * @return Collection|Libro[]
     */
    public function getLibrosIsbn(): Collection
    {
        return $this->libros_isbn;
    }

    public function addLibrosIsbn(Libro $librosIsbn): self
    {
        if (!$this->libros_isbn->contains($librosIsbn)) {
            $this->libros_isbn[] = $librosIsbn;
        }

        return $this;
    }

    public function removeLibrosIsbn(Libro $librosIsbn): self
    {
        $this->libros_isbn->removeElement($librosIsbn);

        return $this;
    }
}
