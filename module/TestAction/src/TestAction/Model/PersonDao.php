<?php

namespace TestAction\Model;

class PersonDao {
    
    private static $data;
    
    public static function getAll()
    {
        if (!self::$data) {
            session_start();
            if (!isset($_SESSION['personDao']))
                $_SESSION['personDao'] =  array(
                    new Person(1, 'John Kings', 1),
                    new Person(2, 'Karen Smith', 2),
                    new Person(3, 'Steve McDonald', 1),
                    new Person(4, 'Johanne Hanks', 2),
                );
            self::$data = $_SESSION['personDao'];
        }
        return self::$data;
    }
    
    public static function getPerson($id)
    {
        $all = self::getAll();
        foreach ($all as $person)
            if ($id == $person->getId())
                return $person;
        return null;
    }
    
    
}
