<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'chambre', targetEntity: Hotel::class)]
    private Collection $Hotel;

    #[ORM\Column]
    private ?int $Nbre_personne = null;

    #[ORM\Column]
    private ?int $Nbre_lit = null;

    #[ORM\Column(length: 255)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $img_chambre = null;

    #[ORM\ManyToOne(inversedBy: 'Chambre')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;

    public function __construct()
    {
        $this->Hotel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Hotel>
     */
    public function getHotel(): Collection
    {
        return $this->Hotel;
    }

    public function addHotel(Hotel $hotel): static
    {
        if (!$this->Hotel->contains($hotel)) {
            $this->Hotel->add($hotel);
            $hotel->setChambre($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): static
    {
        if ($this->Hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getChambre() === $this) {
                $hotel->setChambre(null);
            }
        }

        return $this;
    }

    public function getNbrePersonne(): ?int
    {
        return $this->Nbre_personne;
    }

    public function setNbrePersonne(int $Nbre_personne): static
    {
        $this->Nbre_personne = $Nbre_personne;

        return $this;
    }

    public function getNbreLit(): ?int
    {
        return $this->Nbre_lit;
    }

    public function setNbreLit(int $Nbre_lit): static
    {
        $this->Nbre_lit = $Nbre_lit;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImgChambre(): ?string
    {
        return $this->img_chambre;
    }

    public function setImgChambre(string $img_chambre): static
    {
        $this->img_chambre = $img_chambre;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
