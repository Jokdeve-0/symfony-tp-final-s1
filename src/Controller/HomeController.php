<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="rte_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig', [
            'title' => 'Home',
        ]);
    }
    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        return $this->render('home/list.html.twig', [
            'title' => 'Home',
        ]);
    }
}
