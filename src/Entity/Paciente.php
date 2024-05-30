<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PacienteRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PacienteRepository::class)]
#[UniqueEntity(fields: ['dni'], message: 'El número de DNI ya existe')]
class Paciente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $imagen;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",
        message: "El nombre solo puede contener letras y espacios"
    )]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",
        message: "El apellido solo puede contener letras y espacios"
    )]
    private ?string $apellido = null;

    #[ORM\Column(length: 9, unique: true)]
    #[Assert\NotBlank]
    private ?string $dni = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_nacimiento = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",
        message: "La profesión solo puede contener letras y espacios"
    )]
    private ?string $profesion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $direccion = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ciudad = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $comunidad_autonoma = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $pais = null;

    #[ORM\Column(length: 50)]
    private ?string $genero = null;

    #[ORM\Column(length: 50)]
    private ?string $estado_civil = null;

    #[ORM\ManyToOne(inversedBy: 'pacientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $sanitario_asignado = null;

    #[ORM\Column(length: 9)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^[0-9]{9}$/",
        message: "El teléfono debe contener exactamente 9 dígitos"
    )]
    private ?int $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $eliminado = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'updatedPacientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $updated_by = null;

    #[ORM\OneToOne(mappedBy: 'paciente', cascade: ['persist', 'remove'])]
    private ?HistorialClinico $historialClinico = null;

    #[ORM\OneToMany(mappedBy: 'paciente', targetEntity: Cita::class, orphanRemoval: true)]
    private Collection $citas;

    public function __construct()
    {
        $zonaHoraria = new DateTimeZone('Europe/Madrid');
        $this->created_at = new DateTimeImmutable('now', $zonaHoraria);
        $this->updated_at = new DateTime('now', $zonaHoraria);
        $this->eliminado = false;
        $this->citas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): static
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getProfesion(): ?string
    {
        return $this->profesion;
    }

    public function setProfesion(string $profesion): static
    {
        $this->profesion = $profesion;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(?string $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getComunidadAutonoma(): ?string
    {
        return $this->comunidad_autonoma;
    }

    public function setComunidadAutonoma(?string $comunidad_autonoma): static
    {
        $this->comunidad_autonoma = $comunidad_autonoma;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): static
    {
        $this->pais = $pais;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estado_civil;
    }

    public function setEstadoCivil(string $estado_civil): static
    {
        $this->estado_civil = $estado_civil;

        return $this;
    }

    public function getSanitarioAsignado(): ?User
    {
        return $this->sanitario_asignado;
    }

    public function setSanitarioAsignado(?User $sanitario_asignado): static
    {
        $this->sanitario_asignado = $sanitario_asignado;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isEliminado(): ?bool
    {
        return $this->eliminado;
    }

    public function setEliminado(bool $eliminado): static
    {
        $this->eliminado = $eliminado;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(?User $updated_by): static
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getHistorialClinico(): ?HistorialClinico
    {
        return $this->historialClinico;
    }

    public function setHistorialClinico(?HistorialClinico $historialClinico): self
    {
        if ($historialClinico === null && $this->historialClinico !== null) {
            $this->historialClinico->setPaciente(null);
        }

        if ($historialClinico !== null && $historialClinico->getPaciente() !== $this) {
            $historialClinico->setPaciente($this);
        }

        $this->historialClinico = $historialClinico;

        return $this;
    }

    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setPaciente($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->removeElement($cita)) {
            if ($cita->getPaciente() === $this) {
                $cita->setPaciente(null);
            }
        }

        return $this;
    }
}
