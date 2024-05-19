<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AlergiaRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: AlergiaRepository::class)]
class Alergia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(type: 'text')]
    private ?string $causa = null;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $primeraVez = null;

    #[ORM\Column(type: 'text')]
    private ?string $frecuencia = null;

    #[ORM\Column(type: 'text')]
    private ?string $tratamientoRealizado = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: HistorialClinico::class, inversedBy: 'alergias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCausa(): ?string
    {
        return $this->causa;
    }

    public function setCausa(string $causa): self
    {
        $this->causa = $causa;

        return $this;
    }

    public function getPrimeraVez(): ?DateTimeInterface
    {
        return $this->primeraVez;
    }

    public function setPrimeraVez(DateTimeInterface $primeraVez): self
    {
        $this->primeraVez = $primeraVez;

        return $this;
    }

    public function getFrecuencia(): ?string
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(string $frecuencia): self
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    public function getTratamientoRealizado(): ?string
    {
        return $this->tratamientoRealizado;
    }

    public function setTratamientoRealizado(string $tratamientoRealizado): self
    {
        $this->tratamientoRealizado = $tratamientoRealizado;

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

    public function setHistorialClinico(HistorialClinico $historialClinico): self
    {
        $this->historialClinico = $historialClinico;

        return $this;
    }
}
