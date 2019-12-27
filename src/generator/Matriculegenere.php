<?php   

namespace App\generator;

use App\Entity\Medecin;
use App\Repository\MedecinRepository;

class Matriculegenere{
    private $mat;

    public function __construct(MedecinRepository $medecinRepository)
    {
        $automat = $medecinRepository->findAll();
        $count = count($automat);
        $this->mat = sprintf("%05d", $count+1);
    }


public function generate(Medecin $med){
   
    $index= 'M';

    $service= $med->getService()->getLibelle();
    $nbmot= (str_word_count($service,1));

    if (count($nbmot) >=2) {
       foreach ($nbmot as $key => $value) {
          $index.=strtoupper(substr($value,0,1));
       }
    }else {
        $index.=strtoupper(substr($nbmot[0],0,2));
    }

    return $index.$this->mat;
}
}