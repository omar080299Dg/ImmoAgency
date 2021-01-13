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

class ContactController extends AbstractController
{

    /**
     *@Route ("/Contact",name="property.contact")
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
        return $this->render('property/contact.html.twig',[
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);
    }
}
