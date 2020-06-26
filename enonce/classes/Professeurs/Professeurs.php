<?php 

namespace Professeurs ;

// use étudiants\étudiants  ;





class Professeurs   {

    private  $titre  ;


    function __construct($name ,  $studentListe){
        $this->titre = 'prof';
        $this->name = $name ;
        $this->studentListe = $studentListe ;


    }
    function changeTitle($newtitle){

        $this->titre = $newtitle ;

    }

public function printprof(){

    echo $this->titre . ' ' . $this->name . '<br>';

    echo "le nombre d'étudiants " . count($this->studentListe) . '<br>' ;

    echo "la liste d'étudiants :" . '<br>' ;

    foreach($this->studentListe as $student){
$test = true ;
        if($student instanceof étudiants ){
            echo $student->name . '<br>' ;
        }else if($test == false){
            echo 'no students ' ;
            $test = false ;
            
        }
            
        

        
    }

    

}

    
}

