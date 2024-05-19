<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CostumbresRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: CostumbresRepository::class)]
class Costumbres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $fumante;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frecuenciaFuma = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadEmpezoFumar = null;

    #[ORM\Column(type: 'boolean')]
    private bool $consumoAlcohol;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frecuenciaConsumoAlcohol = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadEmpezoBeber = null;

    #[ORM\Column(type: 'boolean')]
    private bool $otrasDrogas;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tipoDrogas = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $frecuencia = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadEmpezoUsar = null;

    #[ORM\Column(type: 'boolean')]
    private bool $actividadFisica;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tipoActividadFisica = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $duracionActividadFisica = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $frecuenciaActividadFisica = null;

    #[ORM\Column(type: 'boolean')]
    private bool $actividadSexual;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadPrimeraRelacionSexual = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $frecuenciaActividadSexual = null;

    #[ORM\Column(type: 'boolean')]
    private bool $usoPreservativo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $parejasSexualesActual = null;

    #[ORM\Column(type: 'boolean')]
    private bool $higieneIntima;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $metodoHigieneIntima = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $actualizadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $actualizadoPor = null;

    #[ORM\OneToOne(inversedBy: 'costumbres', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    // Getters y Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFumante(): bool
    {
        return $this->fumante;
    }

    public function setFumante(bool $fumante): self
    {
        $this->fumante = $fumante;

        return $this;
    }

    public function getFrecuenciaFuma(): ?int
    {
        return $this->frecuenciaFuma;
    }

    public function setFrecuenciaFuma(?int $frecuenciaFuma): self
    {
        $this->frecuenciaFuma = $frecuenciaFuma;

        return $this;
    }

    public function getEdadEmpezoFumar(): ?int
    {
        return $this->edadEmpezoFumar;
    }

    public function setEdadEmpezoFumar(?int $edadEmpezoFumar): self
    {
        $this->edadEmpezoFumar = $edadEmpezoFumar;

        return $this;
    }

    public function getConsumoAlcohol(): bool
    {
        return $this->consumoAlcohol;
    }

    public function setConsumoAlcohol(bool $consumoAlcohol): self
    {
        $this->consumoAlcohol = $consumoAlcohol;

        return $this;
    }

    public function getFrecuenciaConsumoAlcohol(): ?int
    {
        return $this->frecuenciaConsumoAlcohol;
    }

    public function setFrecuenciaConsumoAlcohol(?int $frecuenciaConsumoAlcohol): self
    {
        $this->frecuenciaConsumoAlcohol = $frecuenciaConsumoAlcohol;

        return $this;
    }

    public function getEdadEmpezoBeber(): ?int
    {
        return $this->edadEmpezoBeber;
    }

    public function setEdadEmpezoBeber(?int $edadEmpezoBeber): self
    {
        $this->edadEmpezoBeber = $edadEmpezoBeber;

        return $this;
    }

    public function getOtrasDrogas(): bool
    {
        return $this->otrasDrogas;
    }

    public function setOtrasDrogas(bool $otrasDrogas): self
    {
        $this->otrasDrogas = $otrasDrogas;

        return $this;
    }

    public function getTipoDrogas(): ?string
    {
        return $this->tipoDrogas;
    }

    public function setTipoDrogas(?string $tipoDrogas): self
    {
        $this->tipoDrogas = $tipoDrogas;

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

    public function getEdadEmpezoUsar(): ?int
    {
        return $this->edadEmpezoUsar;
    }

    public function setEdadEmpezoUsar(?int $edadEmpezoUsar): self
    {
        $this->edadEmpezoUsar = $edadEmpezoUsar;

        return $this;
    }

    public function getActividadFisica(): bool
    {
        return $this->actividadFisica;
    }

    public function setActividadFisica(bool $actividadFisica): self
    {
        $this->actividadFisica = $actividadFisica;

        return $this;
    }

    public function getTipoActividadFisica(): ?string
    {
        return $this->tipoActividadFisica;
    }

    public function setTipoActividadFisica(?string $tipoActividadFisica): self
    {
        $this->tipoActividadFisica = $tipoActividadFisica;

        return $this;
    }

    public function getDuracionActividadFisica(): ?string
    {
        return $this->duracionActividadFisica;
    }

    public function setDuracionActividadFisica(?string $duracionActividadFisica): self
    {
        $this->duracionActividadFisica = $duracionActividadFisica;

        return $this;
    }

    public function getFrecuenciaActividadFisica(): ?string
    {
        return $this->frecuenciaActividadFisica;
    }

    public function setFrecuenciaActividadFisica(?string $frecuenciaActividadFisica): self
    {
        $this->frecuenciaActividadFisica = $frecuenciaActividadFisica;

        return $this;
    }

    public function getActividadSexual(): bool
    {
        return $this->actividadSexual;
    }

    public function setActividadSexual(bool $actividadSexual): self
    {
        $this->actividadSexual = $actividadSexual;

        return $this;
    }

    public function getEdadPrimeraRelacionSexual(): ?int
    {
        return $this->edadPrimeraRelacionSexual;
    }

    public function setEdadPrimeraRelacionSexual(?int $edadPrimeraRelacionSexual): self
    {
        $this->edadPrimeraRelacionSexual = $edadPrimeraRelacionSexual;

        return $this;
    }

    public function getFrecuenciaActividadSexual(): ?string
    {
        return $this->frecuenciaActividadSexual;
    }

    public function setFrecuenciaActividadSexual(?string $frecuenciaActividadSexual): self
    {
        $this->frecuenciaActividadSexual = $frecuenciaActividadSexual;

        return $this;
    }

    public function getUsoPreservativo(): bool
    {
        return $this->usoPreservativo;
    }

    public function setUsoPreservativo(bool $usoPreservativo): self
    {
        $this->usoPreservativo = $usoPreservativo;

        return $this;
    }

    public function getParejasSexualesActual(): ?int
    {
        return $this->parejasSexualesActual;
    }

    public function setParejasSexualesActual(?int $parejasSexualesActual): self
    {
        $this->parejasSexualesActual = $parejasSexualesActual;

        return $this;
    }

    public function getHigieneIntima(): bool
    {
        return $this->higieneIntima;
    }

    public function setHigieneIntima(bool $higieneIntima): self
    {
        $this->higieneIntima = $higieneIntima;

        return $this;
    }

    public function getMetodoHigieneIntima(): ?string
    {
        return $this->metodoHigieneIntima;
    }

    public function setMetodoHigieneIntima(?string $metodoHigieneIntima): self
    {
        $this->metodoHigieneIntima = $metodoHigieneIntima;

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

    public function getActualizadoEn(): ?DateTimeInterface
    {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(?DateTimeInterface $actualizadoEn): self
    {
        $this->actualizadoEn = $actualizadoEn;

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
