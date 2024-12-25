<?php
use AccpetedTrainerModel;
class FinderController {
public static function index(){
$trainers = AccpetedTrainerModel::getAll();
return $trainers;
}

public function find(){
    
}



}