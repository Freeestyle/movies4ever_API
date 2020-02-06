<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le titre est obligatoire")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La date de sortie est obligatoire")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le synopsis est obligatoire")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $director;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MovieList", mappedBy="films")
     */
    private $userMovieList;

    public function __construct()
    {
        $this->userMovieList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     * @return Movie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }



    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(?string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getOriginalCountry(): ?string
    {
        return $this->originalCountry;
    }

    public function setOriginalCountry(?string $originalCountry): self
    {
        $this->originalCountry = $originalCountry;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return Collection|MovieList[]
     */
    public function getUserMovieList(): Collection
    {
        return $this->userMovieList;
    }

    public function addUserMovieList(MovieList $userMovieList): self
    {
        if (!$this->userMovieList->contains($userMovieList)) {
            $this->userMovieList[] = $userMovieList;
            $userMovieList->addFilm($this);
        }

        return $this;
    }

    public function removeUserMovieList(MovieList $userMovieList): self
    {
        if ($this->userMovieList->contains($userMovieList)) {
            $this->userMovieList->removeElement($userMovieList);
            $userMovieList->removeFilm($this);
        }

        return $this;
    }
}
