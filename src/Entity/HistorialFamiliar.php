<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\HistorialFamiliarRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: HistorialFamiliarRepository::class)]
class HistorialFamiliar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private bool $padreVivo;

    #[ORM\Column(type: 'boolean')]
    private bool $madreVivo;

    #[ORM\Column(type: 'integer')]
    private int $hermanos;

    #[ORM\Column(type: 'boolean')]
    private bool $hermanosVivos;

    #[ORM\Column(type: 'integer')]
    private int $hijos;

    #[ORM\Column(type: 'boolean')]
    private bool $hijosVivos;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadFallecimientoHijos = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadFallecimientoPadre = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadFallecimientoMadre = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadFallecimientoHermanos = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $causaMuertePadre = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $causaMuerteMadre = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $causaMuerteHermanos = null;

    #[ORM\Column(type: 'boolean')]
    private bool $diabetes;

    #[ORM\Column(type: 'boolean')]
    private bool $enfermedadCardiaca;

    #[ORM\Column(type: 'boolean')]
    private bool $hipertension;

    #[ORM\Column(type: 'boolean')]
    private bool $enfermedadMetabolica;

    #[ORM\Column(type: 'boolean')]
    private bool $cancer;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tipoCancer = null;

    #[ORM\Column(type: 'boolean')]
    private bool $enfermedadRenalCronica;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $otraEnfermedadCronica = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $actualizadoEn = null;

    #[ORM\Column(type: 'integer')]
    private int $creadoPor;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $actualizadoPor = null;

    #[ORM\OneToOne(inversedBy: 'historialFamiliar', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPadreVivo(): bool
    {
        return $this->padreVivo;
    }

    public function setPadreVivo(bool $padreVivo): self
    {
        $this->padreVivo = $padreVivo;

        return $this;
    }

    public function getMadreVivo(): bool
    {
        return $this->madreVivo;
    }

    public function setMadreVivo(bool $madreVivo): self
    {
        $this->madreVivo = $madreVivo;

        return $this;
    }

    public function getHermanos(): int
    {
        return $this->hermanos;
    }

    public function setHermanos(int $hermanos): self
    {
        $this->hermanos = $hermanos;

        return $this;
    }

    public function getHermanosVivos(): bool
    {
        return $this->hermanosVivos;
    }

    public function setHermanosVivos(bool $hermanosVivos): self
    {
        $this->hermanosVivos = $hermanosVivos;

        return $this;
    }

    public function getHijos(): int
    {
        return $this->hijos;
    }

    public function setHijos(int $hijos): self
    {
        $this->hijos = $hijos;

        return $this;
    }

    public function getHijosVivos(): bool
    {
        return $this->hijosVivos;
    }

    public function setHijosVivos(bool $hijosVivos): self
    {
        $this->hijosVivos = $hijosVivos;

        return $this;
    }

    public function getEdadFallecimientoHijos(): ?int
    {
        return $this->edadFallecimientoHijos;
    }

    public function setEdadFallecimientoHijos(?int $edadFallecimientoHijos): self
    {
        $this->edadFallecimientoHijos = $edadFallecimientoHijos;

        return $this;
    }

    public function getEdadFallecimientoPadre(): ?int
    {
        return $this->edadFallecimientoPadre;
    }

    public function setEdadFallecimientoPadre(?int $edadFallecimientoPadre): self
    {
        $this->edadFallecimientoPadre = $edadFallecimientoPadre;

        return $this;
    }

    public function getEdadFallecimientoMadre(): ?int
    {
        return $this->edadFallecimientoMadre;
    }

    public function setEdadFallecimientoMadre(?int $edadFallecimientoMadre): self
    {
        $this->edadFallecimientoMadre = $edadFallecimientoMadre;

        return $this;
    }

    public function getEdadFallecimientoHermanos(): ?int
    {
        return $this->edadFallecimientoHermanos;
    }

    public function setEdadFallecimientoHermanos(?int $edadFallecimientoHermanos): self
    {
        $this->edadFallecimientoHermanos = $edadFallecimientoHermanos;

        return $this;
    }

    public function getCausaMuertePadre(): ?string
    {
        return $this->causaMuertePadre;
    }

    public function setCausaMuertePadre(?string $causaMuertePadre): self
    {
        $this->causaMuertePadre = $causaMuertePadre;

        return $this;
    }

    public function getCausaMuerteMadre(): ?string
    {
        return $this->causaMuerteMadre;
    }

    public function setCausaMuerteMadre(?string $causaMuerteMadre): self
    {
        $this->causaMuerteMadre = $causaMuerteMadre;

        return $this;
    }

    public function getCausaMuerteHermanos(): ?string
    {
        return $this->causaMuerteHermanos;
    }

    public function setCausaMuerteHermanos(?string $causaMuerteHermanos): self
    {
        $this->causaMuerteHermanos = $causaMuerteHermanos;

        return $this;
    }

    public function getDiabetes(): bool
    {
        return $this->diabetes;
    }

    public function setDiabetes(bool $diabetes): self
    {
        $this->diabetes = $diabetes;

        return $this;
    }

    public function getEnfermedadCardiaca(): bool
    {
        return $this->enfermedadCardiaca;
    }

    public function setEnfermedadCardiaca(bool $enfermedadCardiaca): self
    {
        $this->enfermedadCardiaca = $enfermedadCardiaca;

        return $this;
    }

    public function getHipertension(): bool
    {
        return $this->hipertension;
    }

    public function setHipertension(bool $hipertension): self
    {
        $this->hipertension = $hipertension;

        return $this;
    }

    public function getEnfermedadMetabolica(): bool
    {
        return $this->enfermedadMetabolica;
    }

    public function setEnfermedadMetabolica(bool $enfermedadMetabolica): self
    {
        $this->enfermedadMetabolica = $enfermedadMetabolica;

        return $this;
    }

    public function getCancer(): bool
    {
        return $this->cancer;
    }

    public function setCancer(bool $cancer): self
    {
        $this->cancer = $cancer;

        return $this;
    }

    public function getTipoCancer(): ?string
    {
        return $this->tipoCancer;
    }

    public function setTipoCancer(?string $tipoCancer): self
    {
        $this->tipoCancer = $tipoCancer;

        return $this;
    }

    public function getEnfermedadRenalCronica(): bool
    {
        return $this->enfermedadRenalCronica;
    }

    public function setEnfermedadRenalCronica(bool $enfermedadRenalCronica): self
    {
        $this->enfermedadRenalCronica = $enfermedadRenalCronica;

        return $this;
    }

    public function getOtraEnfermedadCronica(): ?string
    {
        return $this->otraEnfermedadCronica;
    }

    public function setOtraEnfermedadCronica(?string $otraEnfermedadCronica): self
    {
        $this->otraEnfermedadCronica = $otraEnfermedadCronica;

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

    public function getCreadoPor(): int
    {
        return $this->creadoPor;
    }

    public function setCreadoPor(int $creadoPor): self
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    public function getActualizadoPor(): ?int
    {
        return $this->actualizadoPor;
    }

    public function setActualizadoPor(?int $actualizadoPor): self
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
