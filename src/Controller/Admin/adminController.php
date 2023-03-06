<?php

namespace App\Controller\Admin;


use App\Entity\User;
use App\Entity\Carte;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\UserCrudController;
use App\Controller\Admin\CarteCrudController;
use App\Entity\Producteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class adminController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )   {    
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //demande si le compte à le role admin.
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'l utilisateur essais de se connecter sans compte admin');
        $url = $this->adminUrlGenerator //génère un URL
        ->setController(UserCrudController::class)//URL pour l'utilisateur
        ->setController(CarteCrudController::class)//URL pour les cartes
        ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SeFocus');
    }

    public function configureMenuItems(): iterable //configure 
    {
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Carte', 'fas fa-list', Carte::class);
    }
}
