<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $apellidos = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Paciente>
     */
    #[ORM\OneToMany(targetEntity: Paciente::class, mappedBy: 'sanitario_asignado')]
    private Collection $pacientes;

    /**
     * @var Collection<int, Paciente>
     */
    #[ORM\OneToMany(mappedBy: "updated_by", targetEntity: Paciente::class)]
    private Collection $updatedPacientes;

    #[ORM\Column(type: 'boolean')]
    private bool $eliminado = false;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = true;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $creado_en = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $actualizado_en = null;

    /**
     * @var Collection<int, HistorialClinico>
     */
    #[ORM\OneToMany(targetEntity: HistorialClinico::class, mappedBy: 'creadoPor', orphanRemoval: true)]
    private Collection $historialClinicosCreado;

    /**
     * @var Collection<int, HistorialClinico>
     */
    #[ORM\OneToMany(targetEntity: HistorialClinico::class, mappedBy: 'actualizadoPor', orphanRemoval: true)]
    private Collection $historialClinicosActualizado;

    public function __construct()
    {
        $this->pacientes = new ArrayCollection();
        $this->updatedPacientes = new ArrayCollection();
        $this->historialClinicosCreado = new ArrayCollection();
        $this->historialClinicosActualizado = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        if (!$this->isActive || $this->eliminado) {
            return [];
        }

        return array_unique($roles);
    }
    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Paciente>
     */
    public function getPacientes(): Collection
    {
        return $this->pacientes;
    }

    public function addPaciente(Paciente $paciente): static
    {
        if (!$this->pacientes->contains($paciente)) {
            $this->pacientes->add($paciente);
            $paciente->setSanitarioAsignado($this); // modificación para evitar creación de propiedades dinámicas
        }
        return $this;
    }

    public function removePaciente(Paciente $paciente): static
    {
        if ($this->pacientes->removeElement($paciente)) {
            // set the owning side to null (unless already changed)
            if ($paciente->getSanitarioAsignado() === $this) {
                $paciente->setSanitarioAsignado(null);
            }
        }
        return $this;
    }

    public function addUpdatedPaciente(Paciente $paciente): static
    {
        if (!$this->updatedPacientes->contains($paciente)) {
            $this->updatedPacientes->add($paciente);
            $paciente->setUpdatedBy($this); // modificación para evitar creación de propiedades dinámicas
        }
        return $this;
    }

    public function removeUpdatedPaciente(Paciente $paciente): static
    {
        if ($this->updatedPacientes->removeElement($paciente)) {
            if ($paciente->getUpdatedBy() === $this) {
                $paciente->setUpdatedBy(null);
            }
        }
        return $this;
    }

    public function getEliminado(): bool
    {
        return $this->eliminado;
    }

    public function setEliminado(bool $eliminado): static
    {
        $this->eliminado = $eliminado;
        if ($this->eliminado) {
            $this->roles = [];
            $this->isActive = false;
        }
        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;
        if (!$this->isActive) {
            $this->roles = [];
        }
        return $this;
    }

    public function getCreadoEn(): ?\DateTimeInterface
    {
        return $this->creado_en;
    }

    public function setCreadoEn(?\DateTimeInterface $creado_en): static
    {
        $this->creado_en = $creado_en;
        return $this;
    }

    public function getActualizadoEn(): ?\DateTimeInterface
    {
        return $this->actualizado_en;
    }

    public function setActualizadoEn(?\DateTimeInterface $actualizado_en): static
    {
        $this->actualizado_en = $actualizado_en;
        return $this;
    }

    /**
     * @return Collection<int, HistorialClinico>
     */
    public function getHistorialClinicosCreado(): Collection
    {
        return $this->historialClinicosCreado;
    }

    public function addHistorialClinicosCreado(HistorialClinico $historialClinico): static
    {
        if (!$this->historialClinicosCreado->contains($historialClinico)) {
            $this->historialClinicosCreado->add($historialClinico);
            $historialClinico->setCreadoPor($this); //modificación para evitar creación de propiedades dinámicas
        }

        return $this;
    }

    public function removeHistorialClinicosCreado(HistorialClinico $historialClinico): static
    {
        if ($this->historialClinicosCreado->removeElement($historialClinico)) {
            // set the owning side to null (unless already changed)
            if ($historialClinico->getCreadoPor() === $this) {
                $historialClinico->setCreadoPor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HistorialClinico>
     */
    public function getHistorialClinicosActualizado(): Collection
    {
        return $this->historialClinicosActualizado;
    }

    public function addHistorialClinicosActualizado(HistorialClinico $historialClinico): static
    {
        if (!$this->historialClinicosActualizado->contains($historialClinico)) {
            $this->historialClinicosActualizado->add($historialClinico);
            $historialClinico->setActualizadoPor($this); //modificación para evitar creación de propiedades dinámicas
        }

        return $this;
    }

    public function removeHistorialClinicosActualizado(HistorialClinico $historialClinico): static
    {
        if ($this->historialClinicosActualizado->removeElement($historialClinico)) {
            // set the owning side to null (unless already changed)
            if ($historialClinico->getActualizadoPor() === $this) {
                $historialClinico->setActualizadoPor(null);
            }
        }

        return $this;
    }
}
