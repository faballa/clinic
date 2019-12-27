<?php

namespace App\Form;
use DateTime;
use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedcinType extends AbstractType
{   
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /*  ->add('matricule') */
            ->add('prenom')
            ->add('nom')
            ->add('Tel')
            ->add('dateNaissance',DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('service',EntityType::class,[
                'class' => Service::class,
                'choice_label' => 'libelle'
            ])
         

            ->add('specialite',EntityType::class,[
                'class' => Specialite::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'by_reference' => false
            ])
            ->add('Enregistrer',SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
