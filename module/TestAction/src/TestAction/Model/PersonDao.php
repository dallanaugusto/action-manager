<?php

namespace TestAction\Model;

class PersonDao {
    
    private static $data;
    
    public static function getAll()
    {
        if (!self::$data) {
            $personDao = new Container('personDao');
            if (!isset($personDao->people))
                $personDao->people = array(
                    new Person(1, 'John Kings', 1),
                    new Person(2, 'Karen Smith', 2),
                    new Person(3, 'Steve McDonald', 1),
                    new Person(4, 'Johanne Hanks', 2),
                );
            self::$data = $personDao->people;
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
