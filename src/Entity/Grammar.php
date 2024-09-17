<?php

namespace App\Entity;

use App\Entity\Enums\JLPTEnum;
use App\Repository\GrammarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GrammarRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Grammar extends AbstractEntity
{
    #[ORM\Column(type: 'string')]
    #[Groups('grammar:list')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    private $name;

    // todo: implémenter l'enum
//    #[ORM\Column(type: 'string')]
//    private JLPTEnum $jlpt;

    #[ORM\OneToMany(targetEntity: Example::class, mappedBy: 'grammar', cascade: ['persist', 'remove'])]
    // @Groups("grammar:list")
    private $examples = [];

    public function addExample(Example $example): self
    {
        $this->examples[] = $example;

        return $this;
    }

    /**
     * @param Example[] $examples
     */
    public function setExamples(array $examples): self
    {
        foreach ($examples as $newOrModifiedExample) {
            if (!$newOrModifiedExample->getId()) {
                $this->addExample($newOrModifiedExample->setGrammar($this));
                continue;
            }

            foreach ($this->examples as $example) {
                if ($example->getId() == $newOrModifiedExample->getId()) {
                    $example
                        ->setPhrase($newOrModifiedExample->getPhrase())
                        ->setTranslation($newOrModifiedExample->getTranslation());
                }
            }
        }

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Grammar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getJlpt(): JLPTEnum
    {
        return $this->jlpt;
    }

    public function setJlpt(JLPTEnum $jlpt): Grammar
    {
        $this->jlpt = $jlpt;

        return $this;
    }

    public function getExamples()
    {
        return $this->examples;
    }
}
