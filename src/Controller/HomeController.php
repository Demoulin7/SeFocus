<?php

namespace App\Controller;

use App\Repository\CarteRepository;
use App\Repository\DonneesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarteRepository $carteRepository, DonneesRepository $donneesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'cartes' => $carteRepository->findPublic(),
            'donnees' => $donneesRepository->findDonnees()[0]
        ]);
    }
}
