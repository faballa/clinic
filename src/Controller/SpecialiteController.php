<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecialiteController extends AbstractController
{
     /**
     * @Route("/specialite", name="specialite.service.show1")
     */
    public function showSpecialite(SpecialiteRepository $repos )
    {
        $specialite =$repos->findAll();
         
        return $this->render('specialite/index.html.twig', [
            'specialite' =>$specialite,
        ]);
    } 
   /**
     * @Route("/specialite/add", name="specialite.service.show")
     */
    public function addSpecialite(Request $request)
    {
        $specialite =new Specialite();
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
         $entityManager = $this->getDoctrine()->getManager();

         $entityManager->persist($specialite);
           $entityManager->flush();

        return $this->redirectToRoute('specialite.service.show1');
    }
         return $this->render('specialite/form.html.twig', [
            'form' => $form->createView(), 
            ]);
         
        
}
/**
* @Route("/specialite/edit/{id}", name="specialite.service.edit")
*/
public function editSpecialite( $id,Request $request,SpecialiteRepository $repos)
  
   {$specialites = $repos -> find($id);
   $form = $this->createForm(SpecialiteType::class, $specialites);
   $form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($specialites);
      $entityManager->flush();

   return $this->redirectToRoute('specialite.service.show1');
}
    return $this->render('specialite/form.html.twig', [
       'form' => $form->createView(), 
       ]);

}
/**
* @Route("/specialite/delete/{id}", name="specialite.service.delete")
*/
public function deleteSpecialite( $id,Request $request,SpecialiteRepository $repos)

{ 
   $specialites = $repos -> find($id);
   $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($specialites);
      $entityManager->flush();

   return $this->redirectToRoute('specialite.service.show120');
}

}