<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieListRepository")
 */
class MovieList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Votre nom doit être renseigné")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La liste ne peut être vide")
     */
    private $movieList;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movie", inversedBy="userMovieList")
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMovieList(): ?string
    {
        return $this->movieList;
    }

    public function setMovieList(string $movieList): self
    {
        $this->movieList = $movieList;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Movie $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
        }

        return $this;
    }

    public function removeFilm(Movie $film): self
    {
        if ($this->films->contains($film)) {
            $this->films->removeElement($film);
        }

        return $this;
    }
}
