<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SignosVitalesRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: SignosVitalesRepository::class)]
class SignosVitales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private ?float $altura = null;

    #[ORM\Column(type: 'float')]
    private ?float $peso = null;

    #[ORM\Column(type: 'float')]
    private ?float $masaCorporal = null;

    #[ORM\Column(type: 'float')]
    private ?float $temperatura = null;

    #[ORM\Column(type: 'integer')]
    private ?int $frecuenciaRespiratoria = null;

    #[ORM\Column(type: 'float')]
    private ?float $sistole = null;

    #[ORM\Column(type: 'float')]
    private ?float $diastole = null;

    #[ORM\Column(type: 'integer')]
    private ?int $frecuenciaCardiaca = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $porcentajeGrasaCorporal = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $masaCorporalMagra = null;

    #[ORM\Column(type: 'integer')]
    private ?int $saturacionOxigeno = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: HistorialClinico::class, inversedBy: 'signosVitales')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAltura(): ?float
    {
        return $this->altura;
    }

    public function setAltura(float $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        // Calcular la masa corporal (kg/m^2) y guardarla
        if ($this->altura > 0) {
            $this->masaCorporal = $this->peso / (($this->altura / 100) * ($this->altura / 100));
        }

        return $this;
    }

    public function getMasaCorporal(): ?float
    {
        return $this->masaCorporal;
    }

    public function getTemperatura(): ?float
    {
        return $this->temperatura;
    }

    public function setTemperatura(float $temperatura): self
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    public function getFrecuenciaRespiratoria(): ?int
    {
        return $this->frecuenciaRespiratoria;
    }

    public function setFrecuenciaRespiratoria(int $frecuenciaRespiratoria): self
    {
        $this->frecuenciaRespiratoria = $frecuenciaRespiratoria;

        return $this;
    }

    public function getSistole(): ?float
    {
        return $this->sistole;
    }

    public function setSistole(float $sistole): self
    {
        $this->sistole = $sistole;

        return $this;
    }

    public function getDiastole(): ?float
    {
        return $this->diastole;
    }

    public function setDiastole(float $diastole): self
    {
        $this->diastole = $diastole;

        return $this;
    }

    public function getFrecuenciaCardiaca(): ?int
    {
        return $this->frecuenciaCardiaca;
    }

    public function setFrecuenciaCardiaca(int $frecuenciaCardiaca): self
    {
        $this->frecuenciaCardiaca = $frecuenciaCardiaca;

        return $this;
    }

    public function getPorcentajeGrasaCorporal(): ?float
    {
        return $this->porcentajeGrasaCorporal;
    }

    public function setPorcentajeGrasaCorporal(?float $porcentajeGrasaCorporal): self
    {
        $this->porcentajeGrasaCorporal = $porcentajeGrasaCorporal;

        return $this;
    }

    public function getMasaCorporalMagra(): ?float
    {
        return $this->masaCorporalMagra;
    }

    public function setMasaCorporalMagra(?float $masaCorporalMagra): self
    {
        $this->masaCorporalMagra = $masaCorporalMagra;

        return $this;
    }

    public function getSaturacionOxigeno(): ?int
    {
        return $this->saturacionOxigeno;
    }

    public function setSaturacionOxigeno(int $saturacionOxigeno): self
    {
        $this->saturacionOxigeno = $saturacionOxigeno;

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
