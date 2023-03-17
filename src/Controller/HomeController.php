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
    public function index(CarteRepository $carteRepository, DonneesRepository $donneesRepository, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $rep_cartes = $entityManager->getRepository(Carte::class);

        //Si l'utilisateur est connecté
        if ($this->getUser()) {

            $listeToutesCartes = $rep_cartes->findAll();

            //Liste cartes tirées par l'utilisateur
            $userId = $this->getUser()->getId();

            $userRep = $entityManager->getRepository(User::class)->find($userId);

            $listeCartes = $userRep->getListeCartesTirees();

            //Get nouvelle carte retour
            if (count($listeCartes) >= count($listeToutesCartes)) { //Si l'utilisateur a tiré toutes les cartes
                $carteRetour = $rep_cartes->findRandomForUser([], $listeToutesCartes)[0];
            } else { //Si il reste des cartes à tirer
                $carteRetour = $rep_cartes->findRandomForUser($listeCartes, $listeToutesCartes)[0];
            }
        } else {
            $carteRetour = $rep_cartes->findRandomPublic();
        }

        return $this->render('home/index.html.twig', [
            'carte' => $carteRetour,
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

        //Mise à jour du nombre de tirage total
        $donnees = $entityManager->getRepository(Donnees::class)->find(1);

        $ndTirages = $donnees->getNbTiragesT()+1;

        $donnees->setNbTiragesT($ndTirages);

        //Get des Repos
        $rep_cartes = $entityManager->getRepository(Carte::class);

        //Si l'utilisateur est connecté
        if ($this->getUser()) {
            $listeToutesCartes = $rep_cartes->findAll();

            //Liste cartes tirées par l'utilisateur
            $userId = $this->getUser()->getId();

            $userRep = $entityManager->getRepository(User::class)->find($userId);

            $listeCartes = $userRep->getListeCartesTirees();

            //Carte tirée par l'utilisateur
            $idCarte = $request->request->get('idCarte');

            //Ajout carte à la liste des cartes tirées de l'utilisateur
            if (!(count($listeCartes) >= count($listeToutesCartes))){
                $listeCartes[] = $idCarte;
            }

            $userRep->setListeCartesTirees($listeCartes);

            //Get nouvelle carte retour
            if (count($listeCartes) >= count($listeToutesCartes)){ //Si l'utilisateur a tiré toutes les cartes
                $carteRetour = $rep_cartes->findRandomForUser([], $listeToutesCartes)[0];
            } else { //Si il reste des cartes à tirer
                $carteRetour = $rep_cartes->findRandomForUser($listeCartes, $listeToutesCartes)[0];
            }

            //Persist et flush des données modifiés
            $entityManager->persist($donnees);
            $entityManager->persist($userRep);

            $entityManager->flush();

        } else {
            $carteRetour = $rep_cartes->findRandomPublic();
        }

        //Retour de la carte et des infos
        if ($carteRetour) {
            return new Response(
                $carteRetour->getId() . "," . $carteRetour->getContenu() . "," . $ndTirages
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

        //Get des données
        $donnees = $entityManager->getRepository(Donnees::class)->find(1);
        $userId = $this->getUser()->getId();

        $userRep = $entityManager->getRepository(User::class)->find($userId);

        //Mise à jour des données
        $userRep->setNbPomodoro($userRep->getNbPomodoro()+1);

        $nbPomodoroT = $donnees->getNbPomodoroT()+1;

        $donnees->setNbPomodoroT($nbPomodoroT);

        //Persist et flush des données modifiés
        $entityManager->persist($donnees);
        $entityManager->persist($userRep);

        $entityManager->flush();

        //Retour des infos
        return new Response(
            $nbPomodoroT
        );
    }
}
