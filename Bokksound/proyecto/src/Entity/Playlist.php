<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    private ?User $user_id = null;

    #[ORM\ManyToMany(targetEntity: Cancion::class, inversedBy: 'playlists')]
    private Collection $cancion_id;

    public function __construct()
    {
        $this->cancion_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Cancion>
     */
    public function getCancionId(): Collection
    {
        return $this->cancion_id;
    }

    public function addCancionId(Cancion $cancionId): static
    {
        if (!$this->cancion_id->contains($cancionId)) {
            $this->cancion_id->add($cancionId);
        }

        return $this;
    }

    public function removeCancionId(Cancion $cancionId): static
    {
        $this->cancion_id->removeElement($cancionId);

        return $this;
    }
}
