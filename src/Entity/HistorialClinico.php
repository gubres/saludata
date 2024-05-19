<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\HistorialClinicoRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: HistorialClinicoRepository::class)]
class HistorialClinico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creadoEn = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ActualizadoEn = null;

    #[ORM\ManyToOne(inversedBy: 'historialClinicos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ActualizadoPor = null;

    #[ORM\OneToOne(inversedBy: 'historialClinico', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paciente $paciente = null;

    #[ORM\OneToOne(mappedBy: 'historialClinico', cascade: ['persist', 'remove'])]
    private ?HistorialFamiliar $historialFamiliar = null;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: Medicamento::class)]
    private Collection $medicamentos;

    #[ORM\OneToOne(mappedBy: 'historialClinico', cascade: ['persist', 'remove'])]
    private ?Costumbres $costumbres = null;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: SignosVitales::class)]
    private Collection $signosVitales;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: Alergia::class)]
    private Collection $alergias;

    #[ORM\OneToOne(mappedBy: 'historialClinico', cascade: ['persist', 'remove'])]
    private ?ClasificacionSanguinea $clasificacionSanguinea = null;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: Dieta::class)]
    private Collection $dietas;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: Vacuna::class)]
    private Collection $vacunas;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: QuejaActual::class)]
    private Collection $quejasActuales;

    #[ORM\OneToOne(mappedBy: 'historialClinico', cascade: ['persist', 'remove'])]
    private ?HistoricoObstetricoYGinecologico $historicoObstetricoYGinecologico = null;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenCabeza::class)]
    private Collection $examenesCabeza;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenTorax::class)]
    private Collection $examenesTorax;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenAbdomen::class)]
    private Collection $examenesAbdomen;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenPelvico::class)]
    private Collection $examenesPelvico;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenMiembrosSuperiores::class)]
    private Collection $examenesMiembrosSuperiores;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ExamenMiembrosInferiores::class)]
    private Collection $examenesMiembrosInferiores;

    #[ORM\OneToMany(mappedBy: 'historialClinico', targetEntity: ResultadoPrueba::class)]
    private Collection $resultadosPruebas;

    public function __construct()
    {
        $this->medicamentos = new ArrayCollection();
        $this->signosVitales = new ArrayCollection();
        $this->alergias = new ArrayCollection();
        $this->dietas = new ArrayCollection();
        $this->vacunas = new ArrayCollection();
        $this->quejasActuales = new ArrayCollection();
        $this->examenesCabeza = new ArrayCollection();
        $this->examenesTorax = new ArrayCollection();
        $this->examenesAbdomen = new ArrayCollection();
        $this->examenesPelvico = new ArrayCollection();
        $this->examenesMiembrosSuperiores = new ArrayCollection();
        $this->examenesMiembrosInferiores = new ArrayCollection();
        $this->resultadosPruebas = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreadoEn(): ?\DateTimeInterface
    {
        return $this->creadoEn;
    }

    public function setCreadoEn(\DateTimeInterface $creadoEn): static
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }

    public function getCreadoPor(): ?User
    {
        return $this->creadoPor;
    }

    public function setCreadoPor(User $creadoPor): static
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    public function getActualizadoEn(): ?\DateTimeInterface
    {
        return $this->ActualizadoEn;
    }

    public function setActualizadoEn(\DateTimeInterface $ActualizadoEn): static
    {
        $this->ActualizadoEn = $ActualizadoEn;

        return $this;
    }

    public function getActualizadoPor(): ?User
    {
        return $this->ActualizadoPor;
    }

    public function setActualizadoPor(?User $ActualizadoPor): static
    {
        $this->ActualizadoPor = $ActualizadoPor;

        return $this;
    }

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): static
    {
        $this->paciente = $paciente;

        return $this;
    }
    public function getHistorialFamiliar(): ?HistorialFamiliar
    {
        return $this->historialFamiliar;
    }

    public function setHistorialFamiliar(?HistorialFamiliar $historialFamiliar): self
    {
        // unset the owning side of the relation if necessary
        if ($historialFamiliar === null && $this->historialFamiliar !== null) {
            $this->historialFamiliar->setHistorialClinico(null);
        }

        // set the owning side of the relation if necessary
        if ($historialFamiliar !== null && $historialFamiliar->getHistorialClinico() !== $this) {
            $historialFamiliar->setHistorialClinico($this);
        }

        $this->historialFamiliar = $historialFamiliar;

        return $this;
    }
    /**
     * @return Collection<int, Medicamento>
     */
    public function getMedicamentos(): Collection
    {
        return $this->medicamentos;
    }

    public function addMedicamento(Medicamento $medicamento): self
    {
        if (!$this->medicamentos->contains($medicamento)) {
            $this->medicamentos[] = $medicamento;
            $medicamento->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeMedicamento(Medicamento $medicamento): self
    {
        if ($this->medicamentos->removeElement($medicamento)) {
            // set the owning side to null (unless already changed)
            if ($medicamento->getHistorialClinico() === $this) {
                $medicamento->setHistorialClinico(null);
            }
        }

        return $this;
    }
    public function getCostumbres(): ?Costumbres
    {
        return $this->costumbres;
    }

    public function setCostumbres(?Costumbres $costumbres): self
    {
        // unset the owning side of the relation if necessary
        if ($costumbres === null && $this->costumbres !== null) {
            $this->costumbres->setHistorialClinico(null);
        }

        // set the owning side of the relation if necessary
        if ($costumbres !== null && $costumbres->getHistorialClinico() !== $this) {
            $costumbres->setHistorialClinico($this);
        }

        $this->costumbres = $costumbres;

        return $this;
    }
    /**
     * @return Collection<int, SignosVitales>
     */
    public function getSignosVitales(): Collection
    {
        return $this->signosVitales;
    }

    public function addSignosVitale(SignosVitales $signosVitales): self
    {
        if (!$this->signosVitales->contains($signosVitales)) {
            $this->signosVitales[] = $signosVitales;
            $signosVitales->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeSignosVitale(SignosVitales $signosVitales): self
    {
        if ($this->signosVitales->removeElement($signosVitales)) {
            // set the owning side to null (unless already changed)
            if ($signosVitales->getHistorialClinico() === $this) {
                $signosVitales->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, Alergia>
     */
    public function getAlergias(): Collection
    {
        return $this->alergias;
    }

    public function addAlergia(Alergia $alergia): self
    {
        if (!$this->alergias->contains($alergia)) {
            $this->alergias[] = $alergia;
            $alergia->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeAlergia(Alergia $alergia): self
    {
        if ($this->alergias->removeElement($alergia)) {
            // set the owning side to null (unless already changed)
            if ($alergia->getHistorialClinico() === $this) {
                $alergia->setHistorialClinico(null);
            }
        }

        return $this;
    }

    public function getClasificacionSanguinea(): ?ClasificacionSanguinea
    {
        return $this->clasificacionSanguinea;
    }

    public function setClasificacionSanguinea(?ClasificacionSanguinea $clasificacionSanguinea): self
    {
        // unset the owning side of the relation if necessary
        if ($clasificacionSanguinea === null && $this->clasificacionSanguinea !== null) {
            $this->clasificacionSanguinea->setHistorialClinico(null);
        }

        // set the owning side of the relation if necessary
        if ($clasificacionSanguinea !== null && $clasificacionSanguinea->getHistorialClinico() !== $this) {
            $clasificacionSanguinea->setHistorialClinico($this);
        }

        $this->clasificacionSanguinea = $clasificacionSanguinea;

        return $this;
    }
    /**
     * @return Collection<int, Dieta>
     */
    public function getDietas(): Collection
    {
        return $this->dietas;
    }

    public function addDieta(Dieta $dieta): self
    {
        if (!$this->dietas->contains($dieta)) {
            $this->dietas[] = $dieta;
            $dieta->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeDieta(Dieta $dieta): self
    {
        if ($this->dietas->removeElement($dieta)) {
            // set the owning side to null (unless already changed)
            if ($dieta->getHistorialClinico() === $this) {
                $dieta->setHistorialClinico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vacuna>
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(Vacuna $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas[] = $vacuna;
            $vacuna->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeVacuna(Vacuna $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            // set the owning side to null (unless already changed)
            if ($vacuna->getHistorialClinico() === $this) {
                $vacuna->setHistorialClinico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QuejaActual>
     */
    public function getQuejasActuales(): Collection
    {
        return $this->quejasActuales;
    }

    public function addQuejaActual(QuejaActual $quejaActual): self
    {
        if (!$this->quejasActuales->contains($quejaActual)) {
            $this->quejasActuales[] = $quejaActual;
            $quejaActual->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeQuejaActual(QuejaActual $quejaActual): self
    {
        if ($this->quejasActuales->removeElement($quejaActual)) {
            // set the owning side to null (unless already changed)
            if ($quejaActual->getHistorialClinico() === $this) {
                $quejaActual->setHistorialClinico(null);
            }
        }

        return $this;
    }

    public function getHistoricoObstetricoYGinecologico(): ?HistoricoObstetricoYGinecologico
    {
        return $this->historicoObstetricoYGinecologico;
    }

    public function setHistoricoObstetricoYGinecologico(?HistoricoObstetricoYGinecologico $historicoObstetricoYGinecologico): self
    {
        // unset the owning side of the relation if necessary
        if ($historicoObstetricoYGinecologico === null && $this->historicoObstetricoYGinecologico !== null) {
            $this->historicoObstetricoYGinecologico->setHistorialClinico(null);
        }

        // set the owning side of the relation if necessary
        if ($historicoObstetricoYGinecologico !== null && $historicoObstetricoYGinecologico->getHistorialClinico() !== $this) {
            $historicoObstetricoYGinecologico->setHistorialClinico($this);
        }

        $this->historicoObstetricoYGinecologico = $historicoObstetricoYGinecologico;

        return $this;
    }
    /**
     * @return Collection<int, ExamenCabeza>
     */
    public function getExamenesCabeza(): Collection
    {
        return $this->examenesCabeza;
    }

    public function addExamenCabeza(ExamenCabeza $examenCabeza): self
    {
        if (!$this->examenesCabeza->contains($examenCabeza)) {
            $this->examenesCabeza[] = $examenCabeza;
            $examenCabeza->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenCabeza(ExamenCabeza $examenCabeza): self
    {
        if ($this->examenesCabeza->removeElement($examenCabeza)) {
            // set the owning side to null (unless already changed)
            if ($examenCabeza->getHistorialClinico() === $this) {
                $examenCabeza->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, ExamenTorax>
     */
    public function getExamenesTorax(): Collection
    {
        return $this->examenesTorax;
    }

    public function addExamenTorax(ExamenTorax $examenTorax): self
    {
        if (!$this->examenesTorax->contains($examenTorax)) {
            $this->examenesTorax[] = $examenTorax;
            $examenTorax->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenTorax(ExamenTorax $examenTorax): self
    {
        if ($this->examenesTorax->removeElement($examenTorax)) {
            // set the owning side to null (unless already changed)
            if ($examenTorax->getHistorialClinico() === $this) {
                $examenTorax->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, ExamenAbdomen>
     */
    public function getExamenesAbdomen(): Collection
    {
        return $this->examenesAbdomen;
    }

    public function addExamenAbdomen(ExamenAbdomen $examenAbdomen): self
    {
        if (!$this->examenesAbdomen->contains($examenAbdomen)) {
            $this->examenesAbdomen[] = $examenAbdomen;
            $examenAbdomen->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenAbdomen(ExamenAbdomen $examenAbdomen): self
    {
        if ($this->examenesAbdomen->removeElement($examenAbdomen)) {
            // set the owning side to null (unless already changed)
            if ($examenAbdomen->getHistorialClinico() === $this) {
                $examenAbdomen->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, ExamenPelvico>
     */
    public function getExamenesPelvico(): Collection
    {
        return $this->examenesPelvico;
    }

    public function addExamenPelvico(ExamenPelvico $examenPelvico): self
    {
        if (!$this->examenesPelvico->contains($examenPelvico)) {
            $this->examenesPelvico[] = $examenPelvico;
            $examenPelvico->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenPelvico(ExamenPelvico $examenPelvico): self
    {
        if ($this->examenesPelvico->removeElement($examenPelvico)) {
            // set the owning side to null (unless already changed)
            if ($examenPelvico->getHistorialClinico() === $this) {
                $examenPelvico->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, ExamenMiembrosSuperiores>
     */
    public function getExamenesMiembrosSuperiores(): Collection
    {
        return $this->examenesMiembrosSuperiores;
    }

    public function addExamenMiembrosSuperiores(ExamenMiembrosSuperiores $examenMiembrosSuperiores): self
    {
        if (!$this->examenesMiembrosSuperiores->contains($examenMiembrosSuperiores)) {
            $this->examenesMiembrosSuperiores[] = $examenMiembrosSuperiores;
            $examenMiembrosSuperiores->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenMiembrosSuperiores(ExamenMiembrosSuperiores $examenMiembrosSuperiores): self
    {
        if ($this->examenesMiembrosSuperiores->removeElement($examenMiembrosSuperiores)) {
            // set the owning side to null (unless already changed)
            if ($examenMiembrosSuperiores->getHistorialClinico() === $this) {
                $examenMiembrosSuperiores->setHistorialClinico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExamenMiembrosInferiores>
     */
    public function getExamenesMiembrosInferiores(): Collection
    {
        return $this->examenesMiembrosInferiores;
    }

    public function addExamenMiembrosInferiores(ExamenMiembrosInferiores $examenMiembrosInferiores): self
    {
        if (!$this->examenesMiembrosInferiores->contains($examenMiembrosInferiores)) {
            $this->examenesMiembrosInferiores[] = $examenMiembrosInferiores;
            $examenMiembrosInferiores->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeExamenMiembrosInferiores(ExamenMiembrosInferiores $examenMiembrosInferiores): self
    {
        if ($this->examenesMiembrosInferiores->removeElement($examenMiembrosInferiores)) {
            // set the owning side to null (unless already changed)
            if ($examenMiembrosInferiores->getHistorialClinico() === $this) {
                $examenMiembrosInferiores->setHistorialClinico(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, ResultadoPrueba>
     */
    public function getResultadosPruebas(): Collection
    {
        return $this->resultadosPruebas;
    }

    public function addResultadosPrueba(ResultadoPrueba $resultadosPrueba): self
    {
        if (!$this->resultadosPruebas->contains($resultadosPrueba)) {
            $this->resultadosPruebas[] = $resultadosPrueba;
            $resultadosPrueba->setHistorialClinico($this);
        }

        return $this;
    }

    public function removeResultadosPrueba(ResultadoPrueba $resultadosPrueba): self
    {
        if ($this->resultadosPruebas->removeElement($resultadosPrueba)) {
            // set the owning side to null (unless already changed)
            if ($resultadosPrueba->getHistorialClinico() === $this) {
                $resultadosPrueba->setHistorialClinico(null);
            }
        }

        return $this;
    }
}
