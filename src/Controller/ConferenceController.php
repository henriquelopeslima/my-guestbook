<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route(['/', '/hello/{name}'], name: 'homepage')]
    public function index(Request $request, string $name = null): Response
    {
        $greet = $this->getHello($name ?? $request->query->get('hello') ?? '');

        return new Response(<<<EOF
            <html>
                <body>
                    $greet
                    <img src="/images/under-construction.gif" />
                </body>
            </html>
            EOF
        );
    }

    private function getHello(?string $name = null): ?string
    {
        return is_null($name) ? '' : sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
    }
}
