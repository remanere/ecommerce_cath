<?php

namespace App\Entity;

use App\Repository\OrdersdetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersdetailsRepository::class)]
class Ordersdetails
{

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'ordersdetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?orders $orders = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'ordersdetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?products $products = null;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrders(): ?orders
    {
        return $this->orders;
    }

    public function setOrders(?orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getProducts(): ?products
    {
        return $this->products;
    }

    public function setProducts(?products $products): self
    {
        $this->products = $products;

        return $this;
    }
}
