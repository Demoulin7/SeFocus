<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CarteType;

class FormulairCarteController extends AbstractController
{
    #[Route('/formulair/carte', name: 'app_formulair_carte')]
    public function index(): Response
    {
        $form = $this->createForm(CarteType::class);

        return $this->render('formulair_carte/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
