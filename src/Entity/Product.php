<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity,
    ApiResource(
        normalizationContext: ['groups' => ['manufacturer', 'read']],
    )
]
class Product
{
    /**
     * The id of the product.
     */
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer'),
        Groups(["manufacturer", "read"])
    ]
    private ?int $id = null;

    /**
     * The MPN (manufacturer part number) of the product)
     */
    #[
        Assert\NotNull,
        ORM\Column(type: 'string'),
        Groups(["manufacturer", "read"])
    ]
    private ?string $mpn = null;

    /**
     * The name of the product.
     */
    #[
        Assert\NotBlank,
        ORM\Column(type: 'string'),
        Groups(["manufacturer", "read"])
    ]
    private string $name = '';

    /**
     * The description of the product.
     */
    #[
        Assert\NotBlank,
        ORM\Column(type: 'text'),
        Groups(["manufacturer", "read"])
    ]
    private string $description = '';

    /**
     * The date of issue of the product.
     */
    #[
        Assert\NotNull,
        ORM\Column(type: 'datetime'),
        Groups(["manufacturer", "read"])
    ]
    private ?\DateTimeInterface $issueDate = null;

    /**
     * The manufacturer of the product.
     */
    #[
        ORM\ManyToOne(targetEntity: 'Manufacturer', inversedBy: 'products')
    ]
    private ?Manufacturer $manufacturer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMpn(): ?string
    {
        return $this->mpn;
    }

    public function setMpn(?string $mpn): void
    {
        $this->mpn = $mpn;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(?\DateTimeInterface $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    #[Groups(['read'])]
    public function getRandomPrice(): int
    {
        return 42;
    }
}