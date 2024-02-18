<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function menu()
    {
        $finder = new Finder();
        $finder->directories()->in("../public/photos/");

        return $this->render('menu/menu.html.twig', [
            'dossiers' => $finder,
        ]);
    }
}
