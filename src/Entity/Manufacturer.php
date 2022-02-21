<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter as ApiFilters;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/** A manufacturer */
#[
    ORM\Entity,
    ApiResource(
        collectionOperations: ['get', 'post'],
        itemOperations: ['get', 'put'],
        denormalizationContext: ['groups' => ['write']],
        normalizationContext: ['groups' => ['read']],
    ),
    ApiFilter(ApiFilters\SearchFilter::class, properties: ['id' => 'exact', 'description' => 'partial']),
    ApiFilter(ApiFilters\DateFilter::class, properties: ['listedDate']),
    ApiFilter(ApiFilters\OrderFilter::class, properties: ['id'])
]
class Manufacturer
{
    /** The id of the manufacturer  */
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer'),
        Groups(["read"])
    ]
    private ?int $id = null;

    /** The name of the manufacturer */
    #[
        Assert\NotBlank,
        ORM\Column(type: 'string'),
        Groups(["read", "write"])
    ]
    private string $name = '';

    /** The description of manufacturer */
    #[
        Assert\NotBlank,
        ORM\Column(type: 'text'),
        Groups(["read", "write"])
    ]
    private string $description = '';

    /** The countryCode of manufacturer */
    #[
        Assert\NotBlank,
        ORM\Column(type: 'string', length: 3),
        Groups(["write"])
    ]
    private string $countryCode = '';

    /** The date that the manufacturer listed  */
    #[
        Assert\NotNull,
        ORM\Column(type: 'datetime'),
        Groups(["read", "write"])
    ]
    private ?\DateTimeInterface $listedDate = null;

    /**
     * @var Product[] Available products from this manufacturer
     */
    #[
        ORM\OneToMany(mappedBy: 'manufacturer', targetEntity: 'Product', cascade: ['persist', 'remove']),
        Groups(["read", "write"])
    ]
    private iterable $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getListedDate(): ?\DateTimeInterface
    {
        return $this->listedDate;
    }

    public function setListedDate(?\DateTimeInterface $listedDate): void
    {
        $this->listedDate = $listedDate;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): iterable|ArrayCollection
    {
        return $this->products;
    }
}