<?php

namespace linkphp;

use linkphp\boot\Env;
use linkphp\system\core\Engine;
use linkphp\boot\Component;
use linkphp\boot\Definition;
use linkphp\boot\di\InstanceDefinition;
use Container;

class Application
{

    private $data;

    //保存是否已经初始化
    private static $_init;
    //links启动
    static public function run()
    {
        if(!isset(self::$_init)){
            Component::bind((new Definition())
                ->setAlias('env')
                ->setIsSingleton(true)
                ->setClassName('linkphp\\boot\\Env')
            );
            (new Container())->setup();
            Engine::initialize();
            //初次初始化执行改变属性值为true
            self::$_init = new self();
        }
        return self::$_init;
    }

    public function check(Env $env)
    {
        return $this;
    }

    public function request()
    {
        Component::get('request')->request()->start();
        return $this;
    }

    public function response()
    {
        Component::get('request')->request()->setData($this->data)->send();
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    static public function getRequestMethod()
    {
        return Component::get('request')->request()->getRequestMethod();
    }

    static public function Router()
    {
        return Component::get('run');
    }

    static public function env()
    {
        return Component::get('env');
    }

    static public function httpRequest()
    {
        return Component::get('request')->request();
    }

    static public function get($alias)
    {
        return Component::get($alias);
    }

    static public function bind(InstanceDefinition $definition)
    {
        return Component::bind($definition);
    }

    static public function definition()
    {
        return new Definition();
    }

    static public function getContainerInstance()
    {
        return Component::getContainerInstance();
    }

    static public function input($param)
    {
        return $param;
    }

    static public function url($c=null,$a=null,$p=null)
    {
        return Component::get('make')->url($c,$a,$p);
    }

    static public function make()
    {
        return Component::get('make');
    }

    static public function config()
    {
        return Component::get('config');
    }
}