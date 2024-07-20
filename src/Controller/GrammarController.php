<?php

namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use App\Form\ExampleFormType;
use App\Message\ExampleMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/grammars')]
class GrammarController extends AbstractController
{
    private $em;
    private $bus;

    public function __construct(
        EntityManagerInterface $em,
        MessageBusInterface $bus
    ) {
        $this->em = $em;
        $this->bus = $bus;
    }

    #[Route('/', name: "grammar-list")]
    public function list()
    {
        return $this->render('grammar/list.html.twig', [
            'title' => 'Liste des règles de grammaire',
            'grammars' => $this->em->getRepository(Grammar::class)->list(),
        ]);
    }

    #[Route('/{id}-{rule}', name: "grammar-rule")]
    public function rule(Request $request, Grammar $grammar, $adminEmail, MailerInterface $mailer): Response
    {
        $example = (new Example())->setGrammar($grammar);
        $example_form = $this->createForm(ExampleFormType::class, $example);

        $example_form->handleRequest($request);
        if ($example_form->isSubmitted() && $example_form->isValid()) {
            $this->em->persist($example);
            $this->em->flush();

//            $this->bus->dispatch(new ExampleMessage($example->getId(), [
//                'from' => "controller",
//            ]));

//            $mailer->send(
//                (new NotificationEmail())
//                    ->subject('New example posted')
//                    ->htmlTemplate('emails/example_notification.html.twig')
//                    ->to($adminEmail)
//                    ->context(['example' => $example])
//            );

            return $this->redirect($request->getRequestUri());
        }

        return $this->render('grammar/rule.html.twig', [
            'title' => $grammar->getName(),
            'grammar' => $grammar,
            'example_form' => $example_form->createView(),
        ]);
    }

    #[Route('add', name: 'grammar-add')]
    public function add()
    {
        return $this->render('grammar/add.html.twig', [
            'title' => 'Nouvelle grammaire',
            'grammars' => $this->em->getRepository(Grammar::class)->findAll(),
        ]);
    }
}
