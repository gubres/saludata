<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CitaRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: CitaRepository::class)]
class Cita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    private ?DateTimeInterface $fechaCita = null;

    #[ORM\ManyToOne(targetEntity: Paciente::class, inversedBy: 'citas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paciente $paciente = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $fechaCreacion = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $fechaEdicion = null;

    #[ORM\Column(type: 'boolean')]
    private bool $eliminado = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCita(): ?DateTimeInterface
    {
        return $this->fechaCita;
    }

    public function setFechaCita(DateTimeInterface $fechaCita): self
    {
        $this->fechaCita = $fechaCita;

        return $this;
    }

    public function getFechaCreacion(): ?DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getFechaEdicion(): ?DateTimeInterface
    {
        return $this->fechaEdicion;
    }

    public function setFechaEdicion(?DateTimeInterface $fechaEdicion): self
    {
        $this->fechaEdicion = $fechaEdicion;

        return $this;
    }

    public function isEliminado(): bool
    {
        return $this->eliminado;
    }

    public function setEliminado(bool $eliminado): self
    {
        $this->eliminado = $eliminado;

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

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(Paciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }
}
