<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasificacionSanguineaRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: ClasificacionSanguineaRepository::class)]
class ClasificacionSanguinea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 2)]
    private ?string $tipo = null;

    #[ORM\Column(type: 'string', length: 1)]
    private ?string $rh = null;

    #[ORM\Column(type: 'boolean')]
    private bool $donante;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $ultimaDonacion = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $frecuencia = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $actualizadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $actualizadoPor = null;

    #[ORM\OneToOne(inversedBy: 'clasificacionSanguinea', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getRh(): ?string
    {
        return $this->rh;
    }

    public function setRh(string $rh): self
    {
        $this->rh = $rh;

        return $this;
    }

    public function isDonante(): bool
    {
        return $this->donante;
    }

    public function setDonante(bool $donante): self
    {
        $this->donante = $donante;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUltimaDonacion(): ?DateTimeInterface
    {
        return $this->ultimaDonacion;
    }

    public function setUltimaDonacion(?DateTimeInterface $ultimaDonacion): self
    {
        $this->ultimaDonacion = $ultimaDonacion;

        return $this;
    }

    public function getFrecuencia(): ?string
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(?string $frecuencia): self
    {
        $this->frecuencia = $frecuencia;

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

    public function getActualizadoEn(): ?DateTimeInterface
    {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(?DateTimeInterface $actualizadoEn): self
    {
        $this->actualizadoEn = $actualizadoEn;

        return $this;
    }

    public function getActualizadoPor(): ?User
    {
        return $this->actualizadoPor;
    }

    public function setActualizadoPor(?User $actualizadoPor): self
    {
        $this->actualizadoPor = $actualizadoPor;

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
