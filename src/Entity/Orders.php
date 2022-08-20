<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $reference = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?coupons $coupons = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $users = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: Ordersdetails::class, orphanRemoval: true)]
    private Collection $ordersdetails;

    public function __construct()
    {
        $this->ordersdetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCoupons(): ?coupons
    {
        return $this->coupons;
    }

    public function setCoupons(?coupons $coupons): self
    {
        $this->coupons = $coupons;

        return $this;
    }

    public function getUsers(): ?user
    {
        return $this->users;
    }

    public function setUsers(?user $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Ordersdetails>
     */
    public function getOrdersdetails(): Collection
    {
        return $this->ordersdetails;
    }

    public function addOrdersdetail(Ordersdetails $ordersdetail): self
    {
        if (!$this->ordersdetails->contains($ordersdetail)) {
            $this->ordersdetails->add($ordersdetail);
            $ordersdetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrdersdetail(Ordersdetails $ordersdetail): self
    {
        if ($this->ordersdetails->removeElement($ordersdetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersdetail->getOrders() === $this) {
                $ordersdetail->setOrders(null);
            }
        }

        return $this;
    }
}
