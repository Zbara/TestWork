<?php

namespace App\Controller;

use App\Entity\Dev;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $dev = $this->getDoctrine()->getRepository(Dev::class)->findAll();


        return $this->render('index/index.html.twig');
    }
}
