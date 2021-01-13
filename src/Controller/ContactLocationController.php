<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactLocationController extends AbstractController
{

    /**
     *@Route ("/Contact",name="location.contactlocation")
     */
    public function index(Request $request,ContactNotification $notification) : Response
    {
        $property = new Bien();
        $contact = new Contact();
        $contact->setBien($property);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success',"Votre message a été transmis, nous vous répondrons dans les meilleurs délais.");

        }
        return $this->render('location/contactlocation.html.twig',[
            'current_menu' => 'location',
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}
