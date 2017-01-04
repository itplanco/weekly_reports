<?php

use PHPUnit\Framework\TestCase;

class Test1 extends Model {
    private $prop1 = 1;
    protected $prop2 = "prop2";
    public $prop3;
}

class Test2 extends Model {
    public $test1Prop;

    static function parse($obj) {
        $obj = (object) $obj;
        $retObj = parent::parse($obj);
        $retObj->test1Prop = Test1::parse($obj->test1Prop);
        return $retObj;
    }
}

class ModelTest extends TestCase {
    function testParseObject() {
        $expected = new Test1();
        $expected->prop3 = "prop3";

        $obj = ["prop1" => 1, "prop2" => "prop2", "prop3" => "prop3"];
        
        $actual = Test1::Parse($obj);

        $this->assertEquals($expected, $actual);
    }

    function testParseNestedObject() {
        $expected = new Test2();
        $expected->test1Prop = new Test1();
        $expected->test1Prop->prop3 = "prop3";

        $obj = [
            "test1Prop" => ["prop1" => 1, "prop2" => "prop2", "prop3" => "prop3"]
        ];
        
        $actual = Test2::Parse($obj);

        $this->assertEquals($expected, $actual);
    }
    
    function testUserParse() {
        $expected = new User();
        $expected->user_id = "user_id";
        $expected->name = "user_name";
        $expected->groups[] = new Group();
        $expected->groups[0]->group_id = "group_id";
        $expected->groups[0]->name = "group_name";

        $actual = User::parse(json_decode(json_encode($expected), TRUE));
        $this->assertEquals($expected, $actual);
    }
}