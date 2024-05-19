<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuejaActualRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: QuejaActualRepository::class)]
class QuejaActual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $queja = null;

    #[ORM\Column(type: 'text')]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $cuandoEmpezo = null;

    #[ORM\Column(type: 'text')]
    private ?string $duracion = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\ManyToOne(targetEntity: HistorialClinico::class, inversedBy: 'quejasActuales')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQueja(): ?string
    {
        return $this->queja;
    }

    public function setQueja(string $queja): self
    {
        $this->queja = $queja;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCuandoEmpezo(): ?DateTimeInterface
    {
        return $this->cuandoEmpezo;
    }

    public function setCuandoEmpezo(DateTimeInterface $cuandoEmpezo): self
    {
        $this->cuandoEmpezo = $cuandoEmpezo;

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(string $duracion): self
    {
        $this->duracion = $duracion;

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
