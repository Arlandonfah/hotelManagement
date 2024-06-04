<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Avis = null;

    #[ORM\OneToMany(mappedBy: 'avis', targetEntity: Client::class)]
    private Collection $Client;

    #[ORM\OneToMany(mappedBy: 'avis', targetEntity: Hotel::class)]
    private Collection $Hotel;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date_avis = null;

    public function __construct()
    {
        $this->Client = new ArrayCollection();
        $this->Hotel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvis(): ?string
    {
        return $this->Avis;
    }

    public function setAvis(string $Avis): static
    {
        $this->Avis = $Avis;

        return $this;
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
            $client->setAvis($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->Client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getAvis() === $this) {
                $client->setAvis(null);
            }
        }

        return $this;
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
            $hotel->setAvis($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): static
    {
        if ($this->Hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getAvis() === $this) {
                $hotel->setAvis(null);
            }
        }

        return $this;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->Date_avis;
    }

    public function setDateAvis(\DateTimeInterface $Date_avis): static
    {
        $this->Date_avis = $Date_avis;

        return $this;
    }
}
