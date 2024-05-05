<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PacienteRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PacienteRepository::class)]
#[UniqueEntity(fields: ['dni'], message: 'El número de DNI ya existe')]
class Paciente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // El campo BLOB para almacenar la imagen
    #[ORM\Column(type: 'blob', nullable: true)]
    private $imagen;

    #[ORM\Column(length: 50)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $Apellido = null;

    #[ORM\Column(length: 9)]
    private ?string $DNI = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha_nacimiento = null;

    #[ORM\Column(length: 50)]
    private ?string $Profesion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Direccion = null;

    #[ORM\Column(length: 50)]
    private ?string $Genero = null;

    #[ORM\Column(length: 50)]
    private ?string $Estado_civil = null;

    #[ORM\ManyToOne(inversedBy: 'pacientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Sanitario_asignado = null;

    #[ORM\Column]
    private ?int $Telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column]
    private ?bool $Eliminado = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'updatedPacientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Updated_by = null;


    public function __construct()
    {
        $zonaHoraria = new DateTimeZone('Europe/Madrid');
        $this->Created_at = new DateTimeImmutable('now', $zonaHoraria);
        $this->Updated_at = new DateTime('now', $zonaHoraria);
        $this->Eliminado = false;
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
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(string $Apellido): static
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): static
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->Fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $Fecha_nacimiento): static
    {
        $this->Fecha_nacimiento = $Fecha_nacimiento;

        return $this;
    }

    public function getProfesion(): ?string
    {
        return $this->Profesion;
    }

    public function setProfesion(string $Profesion): static
    {
        $this->Profesion = $Profesion;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): static
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->Genero;
    }

    public function setGenero(string $Genero): static
    {
        $this->Genero = $Genero;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->Estado_civil;
    }

    public function setEstadoCivil(string $Estado_civil): static
    {
        $this->Estado_civil = $Estado_civil;

        return $this;
    }

    public function getSanitarioAsignado(): ?User
    {
        return $this->Sanitario_asignado;
    }

    public function setSanitarioAsignado(?User $Sanitario_asignado): static
    {
        $this->Sanitario_asignado = $Sanitario_asignado;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->Telefono;
    }

    public function setTelefono(int $Telefono): static
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function isEliminado(): ?bool
    {
        return $this->Eliminado;
    }

    public function setEliminado(bool $Eliminado): static
    {
        $this->Eliminado = $Eliminado;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $Created_at): static
    {
        $this->Created_at = $Created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->Updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $Updated_at): static
    {
        $this->Updated_at = $Updated_at;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->Updated_by;
    }

    public function setUpdatedBy(?User $Updated_by): static
    {
        $this->Updated_by = $Updated_by;

        return $this;
    }
}
