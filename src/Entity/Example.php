<?php

namespace App\Entity;

use App\Entity\Enums\ExampleStateEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: \App\Repository\ExampleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Example extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Grammar::class, inversedBy: 'examples')]
    private $grammar;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Groups('grammar:list')]
    private $phrase;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Groups('grammar:list')]
    private $translation;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    #[Groups('grammar:list')]
    private ExampleStateEnum|string $state = ExampleStateEnum::PENDING;

    public function getGrammar()
    {
        return $this->grammar;
    }

    /**
     * @return Example
     */
    public function setGrammar($grammar)
    {
        $this->grammar = $grammar;

        return $this;
    }

    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @return Example
     */
    public function setPhrase($phrase): static
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @return Example
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    public function getState(): string
    {
        return $this->state->value;
    }

    /**
     * @return $this
     */
    public function setState(ExampleStateEnum $state): Example
    {
        $this->state = $state;

        return $this;
    }
}
