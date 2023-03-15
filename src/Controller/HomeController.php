<?php

namespace App\Controller;

use App\Entity\Donnees;
use App\Entity\User;
use App\Repository\CarteRepository;
use App\Repository\DonneesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('home/apropos.html.twig', [
        ]);
    }

    #[Route('/equipe', name: 'app_equipe')]
    public function equipe(): Response
    {
        return $this->render('home/equipe.html.twig', [
        ]);
    }

    #[Route('/tirageCarte', name: 'tirageCarte')]
    public function tirageCarte(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $donnees = $entityManager->getRepository(Donnees::class)->find(1);
        $userId = $this->getUser()->getId();

        $userRep = $entityManager->getRepository(User::class)->find($userId);

        $idCarte = $request->request->get('idCarte');

        $listeCartes = $userRep->getListeCartesTirees();

        $listeCartes[] = $idCarte;

        $userRep->setListeCartesTirees($listeCartes);

        $ndTirages = $donnees->getNbTiragesT()+1;

        $donnees->setNbTiragesT($ndTirages);

        $entityManager->persist($donnees);
        $entityManager->persist($userRep);

        $entityManager->flush();

        return new Response(
            $ndTirages
        );
    }

    #[Route('/pomodoroComplete', name: 'pomodoroComplete')]
    public function pomodoroComplete(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $donnees = $entityManager->getRepository(Donnees::class)->find(1);

        $donnees->setNbPomodoroT($donnees->getNbPomodoroT()+1);

        $entityManager->persist($donnees);

        $entityManager->flush();

        return new Response(
            'pomodoro'
        );
    }
}
