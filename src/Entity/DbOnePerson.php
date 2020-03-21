<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DbOnePersonRepository")
 * @ORM\Table(schema="metier")
 * @ORM\HasLifecycleCallbacks()
 */
class DbOnePerson extends Person
{
    use TimestampTrait, UserActionsTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComparisonResult", mappedBy="dbOnePerson")
     */
    private $comparisonResults;

    public function __construct()
    {
        $this->comparisonResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ComparisonResult[]
     */
    public function getComparisonResults(): Collection
    {
        return $this->comparisonResults;
    }

    public function addComparisonResult(ComparisonResult $comparisonResult): self
    {
        if (!$this->comparisonResults->contains($comparisonResult)) {
            $this->comparisonResults[] = $comparisonResult;
            $comparisonResult->setDbOnePerson($this);
        }

        return $this;
    }

    public function removeComparisonResult(ComparisonResult $comparisonResult): self
    {
        if ($this->comparisonResults->contains($comparisonResult)) {
            $this->comparisonResults->removeElement($comparisonResult);
            // set the owning side to null (unless already changed)
            if ($comparisonResult->getDbOnePerson() === $this) {
                $comparisonResult->setDbOnePerson(null);
            }
        }

        return $this;
    }
}
