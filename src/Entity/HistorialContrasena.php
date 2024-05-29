<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\HistorialContrasenaRepository;
use App\Entity\User;

#[ORM\Entity(repositoryClass: HistorialContrasenaRepository::class)]
class HistorialContrasena
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $hashedPassword = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'historialContrasena')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $changedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHashedPassword(): ?string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(string $hashedPassword): self
    {
        $this->hashedPassword = $hashedPassword;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getChangedAt(): ?\DateTimeInterface
    {
        return $this->changedAt;
    }

    public function setChangedAt(\DateTimeInterface $changedAt): self
    {
        $this->changedAt = $changedAt;
        return $this;
    }
}
