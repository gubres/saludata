<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MedicamentoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: MedicamentoRepository::class)]
class Medicamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $posologia = null;

    #[ORM\Column(length: 50)]
    private ?string $duracionTratamiento = null;

    #[ORM\Column(type: 'text')]
    private ?string $frecuencia = null;

    #[ORM\Column(type: 'text')]
    private ?string $aplicacion = null;

    #[ORM\Column(type: 'boolean')]
    private bool $prescripcionMedica;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(inversedBy: 'medicamentos')]
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

    public function getPosologia(): ?string
    {
        return $this->posologia;
    }

    public function setPosologia(string $posologia): self
    {
        $this->posologia = $posologia;

        return $this;
    }

    public function getDuracionTratamiento(): ?string
    {
        return $this->duracionTratamiento;
    }

    public function setDuracionTratamiento(string $duracionTratamiento): self
    {
        $this->duracionTratamiento = $duracionTratamiento;

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

    public function getAplicacion(): ?string
    {
        return $this->aplicacion;
    }

    public function setAplicacion(string $aplicacion): self
    {
        $this->aplicacion = $aplicacion;

        return $this;
    }

    public function isPrescripcionMedica(): bool
    {
        return $this->prescripcionMedica;
    }

    public function setPrescripcionMedica(bool $prescripcionMedica): self
    {
        $this->prescripcionMedica = $prescripcionMedica;

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

    public function setCreadoPor(?User $creadoPor): self
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
