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
    private ?string $NombrePlaylist = null;

    #[ORM\ManyToMany(targetEntity: Cancion::class, inversedBy: 'playlists')]
    private Collection $canciones_id;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    private ?Usuario $UsuarioID = null;

    public function __construct()
    {
        $this->canciones_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePlaylist(): ?string
    {
        return $this->NombrePlaylist;
    }

    public function setNombrePlaylist(string $NombrePlaylist): static
    {
        $this->NombrePlaylist = $NombrePlaylist;

        return $this;
    }

    /**
     * @return Collection<int, Cancion>
     */
    public function getCancionesId(): Collection
    {
        return $this->canciones_id;
    }

    public function addCancionesId(Cancion $cancionesId): static
    {
        if (!$this->canciones_id->contains($cancionesId)) {
            $this->canciones_id->add($cancionesId);
        }

        return $this;
    }

    public function removeCancionesId(Cancion $cancionesId): static
    {
        $this->canciones_id->removeElement($cancionesId);

        return $this;
    }

    public function getUsuarioID(): ?Usuario
    {
        return $this->UsuarioID;
    }

    public function setUsuarioID(?Usuario $UsuarioID): static
    {
        $this->UsuarioID = $UsuarioID;

        return $this;
    }
}
