<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Person
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $lastName;

    /**
     * @var \DateTime Date de naissance
     * 
     * @ORM\Column(type="date", nullable=false)
     */
    protected $birthDate;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $birthPlace;

    /**
     * 
     */
    public function __construct(Person $person = null)
    {
        if ($person != null){
            $this->firstName = $person->getFirstName();
            $this->lastName = $person->getLastName();
            $this->birthDate = $person->getBirthDate();
            $this->birthPlace = $person->getBirthPlace();   
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }
}
