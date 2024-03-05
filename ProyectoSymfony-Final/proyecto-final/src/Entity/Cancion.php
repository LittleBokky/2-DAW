<?php

namespace App\Entity;

use App\Repository\CancionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionRepository::class)]
class Cancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Autor = null;

    #[ORM\Column(length: 255)]
    private ?string $Album = null;

    #[ORM\Column(length: 255)]
    private ?string $Audio = null;

    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'canciones_id')]
    private Collection $playlists;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?string
    {
        return $this->Autor;
    }

    public function setAutor(string $Autor): static
    {
        $this->Autor = $Autor;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->Album;
    }

    public function setAlbum(string $Album): static
    {
        $this->Album = $Album;

        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->Audio;
    }

    public function setAudio(string $Audio): static
    {
        $this->Audio = $Audio;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->addCancionesId($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            $playlist->removeCancionesId($this);
        }

        return $this;
    }
}
