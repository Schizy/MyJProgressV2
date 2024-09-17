<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

class MercureController extends AbstractController
{
    #[Route('/mercure', name: 'app_mercure')]
    public function index(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/1',
            json_encode(['status' => 'OutOfStock']));

        $hub->publish($update);

        return new Response('A JS event is trigerred in connected browsers!', headers: ['Content-Type' => 'text/event-stream']);
    }
}
