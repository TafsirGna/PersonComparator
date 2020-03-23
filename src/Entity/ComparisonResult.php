<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComparisonResultRepository")
 * @ORM\Table(schema="metier")
 * @ORM\HasLifecycleCallbacks()
 */
class ComparisonResult
{
    use TimestampTrait, UserActionsTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DbOnePerson", inversedBy="comparisonResults", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dbOnePerson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DbTwoPerson", inversedBy="comparisonResults", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dbTwoPerson;

    /**
     * @ORM\Column(type="json")
     */
    private $result = [];

    public function __construct(?DbOnePerson $dbOnePerson, ?DbTwoPerson $dbTwoPerson, $result = null){
        $this->dbOnePerson = $dbOnePerson;
        $this->dbTwoPerson = $dbTwoPerson;
        $this->result = $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDbOnePerson(): ?DbOnePerson
    {
        return $this->dbOnePerson;
    }

    public function setDbOnePerson(?DbOnePerson $dbOnePerson): self
    {
        $this->dbOnePerson = $dbOnePerson;

        return $this;
    }

    public function getDbTwoPerson(): ?DbTwoPerson
    {
        return $this->dbTwoPerson;
    }

    public function setDbTwoPerson(?DbTwoPerson $dbTwoPerson): self
    {
        $this->dbTwoPerson = $dbTwoPerson;

        return $this;
    }

    public function getResult(): ?array
    {
        return $this->result;
    }

    public function setResult(array $result): self
    {
        $this->result = $result;

        return $this;
    }
}
