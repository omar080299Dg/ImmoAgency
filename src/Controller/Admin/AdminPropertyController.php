<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var BienRepository
     */
    private $repository;

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;
    public function __construct(BienRepository $repository,ManagerRegistry $managerRegistry)
    {
       $this->repository = $repository;
       $this->managerRegistry = $managerRegistry;
    }

    /**
     *@Route("/admin",name="admin.property.index")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig',compact('properties'));
    }

    /**
     *@Route ("/admin/property/create",name="admin.property.new")
     */
    public function new(Request $request){
        $property = new Bien();
        $form = $this->createForm(BienType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->managerRegistry->getManager();
            $em->persist($property);
            $em->flush();
            $this->addFlash('success','Bien créé avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}",name="admin.property.edit",methods="GET|POST")
     * @param Bien $property
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Bien $property,Request $request)
    {
        $form = $this->createForm(BienType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->managerRegistry->getManager();
            $em->flush();
            $this->addFlash('success','Bien modifié avec succès');
           return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     *@Route("/admin/property/{id}",name="admin.property.delete",methods="DELETE")
     */
    public function delete(Bien $property,Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $em=$this->managerRegistry->getManager();
            $em->remove($property);
            $em->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.property.index');
    }
}