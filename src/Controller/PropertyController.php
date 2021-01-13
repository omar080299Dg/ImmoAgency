<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\BienSearch;
use App\Entity\Contact;
use App\Form\BienSearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\BienRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController
{
    /**
     * @var BienRepository
     */
    private $repository;

    public function __construct(BienRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @Route("/biens",name="property.index")
     * @return Response
     */


    public function index(PaginatorInterface $paginator,Request $request) : Response
    {
        $search = new BienSearch();
        $form = $this->createForm(BienSearchType::class,$search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repository->findByObjectif(),
            $request->query->getInt('page',1),
            12);
        dump($properties);
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    /**
     *@Route("/biens/{slug}-{id}",name="property.show",requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Bien $property,string $slug,Request $request,ContactNotification $notification) : Response
    {

        if ($property->getSlug() !== $slug){
            return  $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ],301);
        }

        $contact = new Contact();
        $contact->setBien($property);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success',"Votre message a été transmis, nous vous répondrons dans les meilleurs délais.");
            return  $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
        ]);
        }

        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);

    }
}