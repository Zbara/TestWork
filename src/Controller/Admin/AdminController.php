<?php
namespace App\Controller\Admin;

use App\Entity\Dev;
use App\Form\DevType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/main", name="admin_main")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/new", methods="GET|POST",  name="admin_created")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $post = new Dev();
        $form = $this->createForm(DevType::class, $post)->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        return $this->render('admin/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

}
