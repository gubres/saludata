<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ExamenAbdomenRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: ExamenAbdomenRepository::class)]
class ExamenAbdomen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $inspeccion = null;

    #[ORM\Column(type: 'text')]
    private ?string $palpacion = null;

    #[ORM\Column(type: 'text')]
    private ?string $percusion = null;

    #[ORM\Column(type: 'text')]
    private ?string $ausculta = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: HistorialClinico::class, inversedBy: 'examenesAbdomen')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInspeccion(): ?string
    {
        return $this->inspeccion;
    }

    public function setInspeccion(string $inspeccion): self
    {
        $this->inspeccion = $inspeccion;

        return $this;
    }

    public function getPalpacion(): ?string
    {
        return $this->palpacion;
    }

    public function setPalpacion(string $palpacion): self
    {
        $this->palpacion = $palpacion;

        return $this;
    }

    public function getPercusion(): ?string
    {
        return $this->percusion;
    }

    public function setPercusion(string $percusion): self
    {
        $this->percusion = $percusion;

        return $this;
    }

    public function getAusculta(): ?string
    {
        return $this->ausculta;
    }

    public function setAusculta(string $ausculta): self
    {
        $this->ausculta = $ausculta;

        return $this;
    }

    public function getCreadoEn(): ?DateTimeInterface
    {
        return $this->creadoEn;
    }

    public function setCreadoEn(DateTimeInterface $creadoEn): self
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }

    public function getCreadoPor(): ?User
    {
        return $this->creadoPor;
    }

    public function setCreadoPor(User $creadoPor): self
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    public function getHistorialClinico(): ?HistorialClinico
    {
        return $this->historialClinico;
    }

    public function setHistorialClinico(?HistorialClinico $historialClinico): self
    {
        $this->historialClinico = $historialClinico;

        return $this;
    }
}
