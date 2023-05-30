<?php

namespace App\Entity;

use App\Repository\VatCalculationHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VatCalculationHistoryRepository::class)
 */
class VatCalculationHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;    

    /**
     * @ORM\Column(type="float", length=255)
     * @Assert\NotBlank     
     */
    public ?float $user_input_amount = null;

    /**
     * @ORM\Column(type="float")      
     */
    public ?float $including_vat_amount = null;

    /**
     * @ORM\Column(type="float")        
     */
    public ?float $excluding_vat_amount = null;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank     
     */
    public ?float $vat_rate = null;  
    
    /**
     * @ORM\Column(type="float")        
     */
    public ?float $vat_amount = null;
    private ?string $vat_operation = null;

    public function getId(): ?int
    {
        return $this->id;
    }   

    public function getUserInputAmount(): ?float
    {
        return $this->user_input_amount;
    }

    public function setUserInputAmount(float $user_input_amount): self
    {
        $this->user_input_amount = $user_input_amount;

        return $this;
    }

    public function getIncludingVatAmount(): ?float
    {
        return $this->including_vat_amount;
    }

    public function setIncludingVatAmount(float $including_vat_amount): self
    {
        $this->including_vat_amount = $including_vat_amount;
        return $this;
    }

    public function getExcludingVatAmount(): ?float
    {
        return $this->excluding_vat_amount;
    }

    public function setExcludingVatAmount(float $excluding_vat_amount): self
    {
        $this->excluding_vat_amount = $excluding_vat_amount;
        return $this;
    }

    public function getVatRate(): ?float
    {
        return $this->vat_rate;
    }

    public function setVatRate(float $vat_rate): self
    {
        $this->vat_rate = $vat_rate;

        return $this;
    }  

    public function getVatOperation(): ?string
    {
        return $this->vat_operation;
    }

    public function setVatOperation(string $vat_operation): self
    {
        $this->vat_operation = $vat_operation;

        return $this;
    }
    
    public function getVatAmount(): ?float
    {
        return $this->vat_amount;
    }

    public function setVatAmount(float $vat_amount): self
    {
        $this->vat_amount = $vat_amount;
        return $this;
    }
}