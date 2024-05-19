<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResultadoPruebaRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: ResultadoPruebaRepository::class)]
class ResultadoPrueba
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $nombrePrueba = null;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $fecha = null;

    #[ORM\Column(type: 'text')]
    private ?string $resultado = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $archivo = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: HistorialClinico::class, inversedBy: 'resultadosPruebas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePrueba(): ?string
    {
        return $this->nombrePrueba;
    }

    public function setNombrePrueba(string $nombrePrueba): self
    {
        $this->nombrePrueba = $nombrePrueba;

        return $this;
    }

    public function getFecha(): ?DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getResultado(): ?string
    {
        return $this->resultado;
    }

    public function setResultado(string $resultado): self
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getArchivo()
    {
        return $this->archivo;
    }

    public function setArchivo($archivo): self
    {
        $this->archivo = $archivo;

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
