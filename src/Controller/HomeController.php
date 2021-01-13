<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home")
     * @param BienRepository $repository
     * @return Response
     */


    public function index(BienRepository $repository) : Response
    {
        $properties = $repository->findLatest();
        dump($properties);
        return $this->render('pages/home.html.twig',[
            'current_menu' => 'biens',
            'properties' =>  $properties
        ]);
    }
}
