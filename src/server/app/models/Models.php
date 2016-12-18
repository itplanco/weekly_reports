<?php

class Model {
    static function parse($obj) {
        if (is_array($obj)) {
            $obj = (object) $obj;
        }

        $className = get_called_class();
        $retObj = new $className;

        $classInfo = new ReflectionClass($className);
        foreach ($classInfo->getProperties() as $prop) {
            if (isset($obj->{$prop->name})) {
                $prop->setAccessible(TRUE);
                $prop->setValue($retObj, $obj->{$prop->name});
            }
        }
        return $retObj;
    } 
}