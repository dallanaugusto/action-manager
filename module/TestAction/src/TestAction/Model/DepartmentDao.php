<?php

namespace TestAction\Model;

use Zend\Session\Container;

class DepartmentDao {
    
    private static $data;
    
    public static function getAll()
    {
        if (!self::$data) {
            $departmentDao = new Container('departmentDao');
            if (!isset($departmentDao->departments))
                $departmentDao->departments = array(
                    new Department(1, 'Tecnology'),
                    new Department(2, 'Directory'),
                );
            self::$data = $departmentDao->departments;
        }
        return self::$data;
    }
    
    public static function getDepartment($id)
    {
        $all = self::getAll();
        foreach ($all as $department)
            if ($id == $department->getId())
                return $department;
        return null;
    }
    
    
}
