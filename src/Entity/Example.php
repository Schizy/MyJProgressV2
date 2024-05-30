<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: \App\Repository\ExampleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Example extends AbstractEntity
{
    const STATES = [
        self::REJECTED,
        self::PENDING,
        self::PUBLISHED,
    ];

    const REJECTED = 'rejected';

    const PENDING = 'pending';

    const PUBLISHED = 'published';

    
    #[ORM\ManyToOne(targetEntity: \App\Entity\Grammar::class, inversedBy: 'examples')]
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
    private $state = self::PENDING;

    /**
     * @return mixed
     */
    public function getGrammar()
    {
        return $this->grammar;
    }

    /**
     * @param mixed $grammar
     *
     * @return Example
     */
    public function setGrammar($grammar)
    {
        $this->grammar = $grammar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @param mixed $phrase
     *
     * @return Example
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $translation
     *
     * @return Example
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return $this
     */
    public function setState(string $state): Example
    {
        if (in_array($state, self::STATES)) {
            $this->state = $state;
        }

        return $this;
    }
}
