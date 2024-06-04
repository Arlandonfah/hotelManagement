<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Client::class)]
    private Collection $Client;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Chambre::class)]
    private Collection $Chambre;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_fin = null;

    #[ORM\Column(length: 255)]
    private ?string $paye = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paiement $paiement = null;

    public function __construct()
    {
        $this->Client = new ArrayCollection();
        $this->Chambre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->Client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->Client->contains($client)) {
            $this->Client->add($client);
            $client->setReservation($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->Client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getReservation() === $this) {
                $client->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambre(): Collection
    {
        return $this->Chambre;
    }

    public function addChambre(Chambre $chambre): static
    {
        if (!$this->Chambre->contains($chambre)) {
            $this->Chambre->add($chambre);
            $chambre->setReservation($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): static
    {
        if ($this->Chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getReservation() === $this) {
                $chambre->setReservation(null);
            }
        }

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->Date_debut;
    }

    public function setDateDebut(\DateTimeInterface $Date_debut): static
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(\DateTimeInterface $Date_fin): static
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }

    public function getPaye(): ?string
    {
        return $this->paye;
    }

    public function setPaye(string $paye): static
    {
        $this->paye = $paye;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }
}
