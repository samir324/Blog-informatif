<?php 

include 'includes/autoloader.php';





$prof = new Professeurs\Professeurs('salah' , [new étudiants\étudiants('ahmed mohamed') , new étudiants\étudiants('ilyass') , new étudiants\étudiants('yassine')]);

$prof->changeTitle('Dr');


$prof->printprof();


mail('salaheddib.55@gmail.com' , 'test' , 'test');
