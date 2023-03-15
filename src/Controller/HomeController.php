<?php

namespace App\Controller;

use App\Entity\Carte;
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
            'carte' => $carteRepository->findRandomPublic()[0],
            'donnees' => $donneesRepository->findDonnees()[0],
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

        $listeToutesCartes = $entityManager->getRepository(Carte::class)->findAll();

        $donnees = $entityManager->getRepository(Donnees::class)->find(1);
        $userId = $this->getUser()->getId();

        $userRep = $entityManager->getRepository(User::class)->find($userId);

        $idCarte = $request->request->get('idCarte');

        $listeCartes = $userRep->getListeCartesTirees();

        $listeCartes[] = $idCarte;

        $carteRetour = $entityManager->getRepository(Carte::class)->findRandomForUser($listeCartes, $listeToutesCartes);

        $userRep->setListeCartesTirees($listeCartes);

        $ndTirages = $donnees->getNbTiragesT()+1;

        $donnees->setNbTiragesT($ndTirages);

        $entityManager->persist($donnees);
        $entityManager->persist($userRep);

        $entityManager->flush();

        if ($carteRetour) {
            return new Response(
                $carteRetour[0]->getId() . "," . $carteRetour[0]->getContenu() . "," . $ndTirages
            );
        } else {
            return new Response(
                0 . "," . "Plus de cartes à tirer !" . "," . $ndTirages
            );
        }
    }

    #[Route('/pomodoroComplete', name: 'pomodoroComplete')]
    public function pomodoroComplete(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $donnees = $entityManager->getRepository(Donnees::class)->find(1);
        $userId = $this->getUser()->getId();

        $userRep = $entityManager->getRepository(User::class)->find($userId);

        $userRep->setNbPomodoro($userRep->getNbPomodoro()+1);

        $nbPomodoroT = $donnees->getNbPomodoroT()+1;

        $donnees->setNbPomodoroT($nbPomodoroT);

        $entityManager->persist($donnees);

        $entityManager->persist($userRep);

        $entityManager->flush();

        return new Response(
            $nbPomodoroT
        );
    }
}
