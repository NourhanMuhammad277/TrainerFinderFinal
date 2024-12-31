<?php

require_once __DIR__ . "/../Models/AcceptedTrainerModel.php";
require_once __DIR__ . "/../Models/Reservation.php";
require_once __DIR__ . "/../Models/User.php";
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class FinderController
{
    public static function index()
    {
        $trainers = AcceptedTrainerModel::getAll();
        return $trainers;
    }

    public static function subscribe($trainer_id, $user_id): bool
    {
        $W_trainer = AcceptedTrainerModel::getById(id: $trainer_id);
        $W_user = User::getUserById(user_id: $user_id);
        $data  = [
            'trainer_id' => (int)$W_trainer['id'],
            'user_id' =>(int)$W_user['id']
        ];
        return Reservation::create(data: $data);
    }


    public function find() {}
}
