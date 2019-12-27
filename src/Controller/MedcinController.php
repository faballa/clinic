<?php
namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedcinType;
use App\generator\Matriculegenere;
use App\Repository\MedecinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MedcinController extends AbstractController
{
 /**
  * @Route("/medcin", name="medcin.service.show")
  */
   public function showMedcin(MedecinRepository $repos )
   {
       $medcins =$repos->findAll();
        
       return $this->render('medcin/index.html.twig', [
           'medcin' =>$medcins,
       ]);


 }
    /**
     * @Route("/medcin/add", name="medcin.service.add")
     */
    public function addmedcin(Request $request, Matriculegenere $matriculegenere)
    {
        $medcins =new Medecin();
        $form = $this->createForm(MedcinType::class, $medcins);
        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
     $entityManager = $this->getDoctrine()->getManager();

     $matricule= $matriculegenere->generate($medcins);
     $medcins->setMatricule($matricule);
         $entityManager->persist($medcins);
           $entityManager->flush();

        return $this->redirectToRoute('medcin.service.show');
    }
         return $this->render('medcin/form.html.twig', [
            'form' => $form->createView(), 
            ]);
         
}
/**
 * @Route("/medcin/edit/{id}", name="medcin.service.edit")
 */
public function editmedcin( $id,Request $request,MedecinRepository $repos)
   
    {
    $medcins = $repos -> find($id);
    $form = $this->createForm(MedcinType::class, $medcins);
    $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
 $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($medcins);
       $entityManager->flush();

    return $this->redirectToRoute('medcin.service.show');
}
     return $this->render('medcin/form.html.twig', [
        'form' => $form->createView(), 
        ]);

} 
/**
* @Route("/medcin/delete/{id}", name="medcin.service.delete")
*/
public function deletemedcin( $id,Request $request,MedecinRepository $repos)

{ 
   $medcins = $repos -> find($id);
   $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($medcins);
      $entityManager->flush();

   return $this->redirectToRoute('medcin.service.show');
}
   
}