<?php

interface Model
{
    public static function getAll():array;
    public static function getById($id):array;
    public static function create($data):bool;
    public static function update($id, $data):bool;
    public static function delete($id):bool;
}
