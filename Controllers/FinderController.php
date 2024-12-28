<?php

require __DIR__ ."/../Models/AcceptedTrainerModel.php";

class FinderController {
public static function index(){
$trainers = AcceptedTrainerModel::getAll();
return $trainers;
}

public function find(){
    
}



}