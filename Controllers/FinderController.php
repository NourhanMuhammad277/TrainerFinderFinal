<?php

require __DIR__ ."/../Models/AcceptedTrainerModel.php";
require __DIR__ ."/../Models/User.php";

class FinderController {
public static function index(){
$trainers = AcceptedTrainerModel::getAll();
return $trainers;
}

public static function subscribe($trainer_id , $user_id){
$W_trainer = AcceptedTrainerModel::getById(id: $trainer_id);
$W_user = User::getById($user_id);


}


public function find(){
    
}



}