<?php

interface Model
{
    public static function getAll();
    public static function getById($id);
    public static function create($data):bool;
    public static function update($id, $data):bool;
    public static function delete($id):bool;
}
