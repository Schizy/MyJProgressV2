<?php

namespace App\Controller;

use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/", name:"homepage")]
    public function home(EntityManagerInterface $em): Response
    {
        return $this->render('home/home.html.twig', [
            'rules' => $em->getRepository(Grammar::class)->findBy([], ['id' => 'desc'], 5),
        ]);
    }
}
