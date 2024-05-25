<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\HistoricoObstetricoYGinecologicoRepository;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: HistoricoObstetricoYGinecologicoRepository::class)]
class HistoricoObstetricoYGinecologico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $edadPrimeraRegla = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $edadUltimaRegla = null;

    #[ORM\Column(type: 'integer')]
    private ?int $duracionRegla = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $cicloRegular = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $usoMedicacion = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $medicamento = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $posologia = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $dolor = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $intensidadDolor = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $tieneHijos = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cantidadHijos = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tipoParto = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $tiempoEntrePartos = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $edadPrimeroParto = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $edadUltimoParto = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $citologiaVaginal = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $primeraColeta = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $ultimaColeta = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $resultadoColeta = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $cancerDeMama = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $fechaCancer = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tratamientoCancer = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $vph = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $tratamientoVph = null;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creadoPor = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $actualizadoEn = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $actualizadoPor = null;

    #[ORM\OneToOne(inversedBy: 'historicoObstetricoYGinecologico', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistorialClinico $historialClinico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEdadPrimeraRegla(): ?int
    {
        return $this->edadPrimeraRegla;
    }

    public function setEdadPrimeraRegla(int $edadPrimeraRegla): self
    {
        $this->edadPrimeraRegla = $edadPrimeraRegla;

        return $this;
    }

    public function getEdadUltimaRegla(): ?int
    {
        return $this->edadUltimaRegla;
    }

    public function setEdadUltimaRegla(?int $edadUltimaRegla): self
    {
        $this->edadUltimaRegla = $edadUltimaRegla;

        return $this;
    }

    public function getDuracionRegla(): ?int
    {
        return $this->duracionRegla;
    }

    public function setDuracionRegla(int $duracionRegla): self
    {
        $this->duracionRegla = $duracionRegla;

        return $this;
    }

    public function isCicloRegular(): ?bool
    {
        return $this->cicloRegular;
    }

    public function setCicloRegular(bool $cicloRegular): self
    {
        $this->cicloRegular = $cicloRegular;

        return $this;
    }

    public function isUsoMedicacion(): ?bool
    {
        return $this->usoMedicacion;
    }

    public function setUsoMedicacion(bool $usoMedicacion): self
    {
        $this->usoMedicacion = $usoMedicacion;

        return $this;
    }

    public function getMedicamento(): ?string
    {
        return $this->medicamento;
    }

    public function setMedicamento(?string $medicamento): self
    {
        $this->medicamento = $medicamento;

        return $this;
    }

    public function getPosologia(): ?string
    {
        return $this->posologia;
    }

    public function setPosologia(?string $posologia): self
    {
        $this->posologia = $posologia;

        return $this;
    }

    public function isDolor(): ?bool
    {
        return $this->dolor;
    }

    public function setDolor(bool $dolor): self
    {
        $this->dolor = $dolor;

        return $this;
    }

    public function getIntensidadDolor(): ?int
    {
        return $this->intensidadDolor;
    }

    public function setIntensidadDolor(?int $intensidadDolor): self
    {
        $this->intensidadDolor = $intensidadDolor;

        return $this;
    }

    public function isTieneHijos(): ?bool
    {
        return $this->tieneHijos;
    }

    public function setTieneHijos(bool $tieneHijos): self
    {
        $this->tieneHijos = $tieneHijos;

        return $this;
    }

    public function getCantidadHijos(): ?int
    {
        return $this->cantidadHijos;
    }

    public function setCantidadHijos(?int $cantidadHijos): self
    {
        $this->cantidadHijos = $cantidadHijos;

        return $this;
    }

    public function getTipoParto(): ?string
    {
        return $this->tipoParto;
    }

    public function setTipoParto(?string $tipoParto): self
    {
        $this->tipoParto = $tipoParto;

        return $this;
    }

    public function getTiempoEntrePartos(): ?int
    {
        return $this->tiempoEntrePartos;
    }

    public function setTiempoEntrePartos(?int $tiempoEntrePartos): self
    {
        $this->tiempoEntrePartos = $tiempoEntrePartos;

        return $this;
    }

    public function getEdadPrimeroParto(): ?DateTimeInterface
    {
        return $this->edadPrimeroParto;
    }

    public function setEdadPrimeroParto(?DateTimeInterface $edadPrimeroParto): self
    {
        $this->edadPrimeroParto = $edadPrimeroParto;

        return $this;
    }

    public function getEdadUltimoParto(): ?DateTimeInterface
    {
        return $this->edadUltimoParto;
    }

    public function setEdadUltimoParto(?DateTimeInterface $edadUltimoParto): self
    {
        $this->edadUltimoParto = $edadUltimoParto;

        return $this;
    }

    public function isCitologiaVaginal(): ?bool
    {
        return $this->citologiaVaginal;
    }

    public function setCitologiaVaginal(bool $citologiaVaginal): self
    {
        $this->citologiaVaginal = $citologiaVaginal;

        return $this;
    }

    public function getPrimeraColeta(): ?DateTimeInterface
    {
        return $this->primeraColeta;
    }

    public function setPrimeraColeta(?DateTimeInterface $primeraColeta): self
    {
        $this->primeraColeta = $primeraColeta;

        return $this;
    }

    public function getUltimaColeta(): ?DateTimeInterface
    {
        return $this->ultimaColeta;
    }

    public function setUltimaColeta(?DateTimeInterface $ultimaColeta): self
    {
        $this->ultimaColeta = $ultimaColeta;

        return $this;
    }

    public function getResultadoColeta(): ?string
    {
        return $this->resultadoColeta;
    }

    public function setResultadoColeta(?string $resultadoColeta): self
    {
        $this->resultadoColeta = $resultadoColeta;

        return $this;
    }

    public function isCancerDeMama(): ?bool
    {
        return $this->cancerDeMama;
    }

    public function setCancerDeMama(bool $cancerDeMama): self
    {
        $this->cancerDeMama = $cancerDeMama;

        return $this;
    }

    public function getFechaCancer(): ?DateTimeInterface
    {
        return $this->fechaCancer;
    }

    public function setFechaCancer(?DateTimeInterface $fechaCancer): self
    {
        $this->fechaCancer = $fechaCancer;

        return $this;
    }

    public function getTratamientoCancer(): ?string
    {
        return $this->tratamientoCancer;
    }

    public function setTratamientoCancer(?string $tratamientoCancer): self
    {
        $this->tratamientoCancer = $tratamientoCancer;

        return $this;
    }

    public function isVph(): ?bool
    {
        return $this->vph;
    }

    public function setVph(bool $vph): self
    {
        $this->vph = $vph;

        return $this;
    }

    public function getTratamientoVph(): ?string
    {
        return $this->tratamientoVph;
    }

    public function setTratamientoVph(?string $tratamientoVph): self
    {
        $this->tratamientoVph = $tratamientoVph;

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

    public function getActualizadoEn(): ?DateTimeInterface
    {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(?DateTimeInterface $actualizadoEn): self
    {
        $this->actualizadoEn = $actualizadoEn;

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
