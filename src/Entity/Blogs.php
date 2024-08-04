<?php

namespace App\Entity;

use App\Repository\BlogsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogsRepository::class)]
class Blogs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $BlogTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $BlogContent = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $BlogDate = null;

    #[ORM\Column(length: 255)]
    private ?string $BlogImage = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $BlogUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogTitle(): ?string
    {
        return $this->BlogTitle;
    }

    public function setBlogTitle(string $BlogTitle): static
    {
        $this->BlogTitle = $BlogTitle;

        return $this;
    }

    public function getBlogContent(): ?string
    {
        return $this->BlogContent;
    }

    public function setBlogContent(string $BlogContent): static
    {
        $this->BlogContent = $BlogContent;

        return $this;
    }

    public function getBlogDate(): ?\DateTimeInterface
    {
        return $this->BlogDate;
    }

    public function setBlogDate(\DateTimeInterface $BlogDate): static
    {
        $this->BlogDate = $BlogDate;

        return $this;
    }

    public function getBlogImage(): ?string
    {
        return $this->BlogImage;
    }

    public function setBlogImage(string $BlogImage): static
    {
        $this->BlogImage = $BlogImage;

        return $this;
    }

    public function getBlogUser(): ?User
    {
        return $this->BlogUser;
    }

    public function setBlogUser(?User $BlogUser): static
    {
        $this->BlogUser = $BlogUser;

        return $this;
    }
}
