<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *              LinkPHP系统框架路由类                *
 * --------------------------------------------------*
 */
 
 class Router
 {
     //url模式
     private $_url_module;
     //请求参数
     private $_url = array();
     //默认操作平台
     static private $_default_platform;
     //默认控制器
     static private $_default_controller;
     //默认操作方法
     static private $_default_action;


     //路由类构造函数
     public function __construct()
     {
         $this->_url_module = C('URL_MODULE');
         static::$_default_platform = C('DEFAULT_PLATFORM');
         static::$_default_controller = C('DEFAULT_CONTROLLER');
         static::$_default_action = C('DEFAULT_ACTION');
         $this->initUrlParam($_SERVER['REQUEST_URI']);
     }

     /**
      * URL参数匹配
      */
     public function initUrlParam($url)
     {
         $param = array(
             'platform'   => '',
             'controller' => '',
             'action'     => '',
             'param'      => array( )
         );
         switch($this->_url_module){
             case 0:
                 static::initDispatchParamByNomal();
                 break;
             case 1:
                 $dispatch = explode('/',trim($url,'/'));
                 if(in_array('index.php',$dispatch)){
                     $param['platform'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                     $param['controller'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                     $param['action'] = isset($dispatch['3']) ? $dispatch['3'] : '';
                     static::initDispatchParamByPathInfo($param);
                 } else {
                     $param['platform'] = isset($dispatch['0']) ? $dispatch['0'] : '';
                     $param['controller'] = isset($dispatch['1']) ? $dispatch['1'] : '';
                     $param['action'] = isset($dispatch['2']) ? $dispatch['2'] : '';
                     static::initDispatchParamByPathInfo($param);
                 }
                 $this->_url = $param;
                 break;
             case 2:
                 $this->_url = '';
                 break;
         }
     }

     /**
      * 初始化分发参数
      */
     static public function initDispatchParamByNomal(){
         //定义常量保存操作平台
         define('PLATFORM',isset($_GET[C('VAR_PLATFORM')]) ? ucfirst($_GET[C('VAR_PLATFORM')]) : static::$_default_platform);
         //定义常量保存控制器
         define('CONTROLLER',isset($_GET[C('VAR_CONTROLLER')]) ? ucfirst($_GET[C('VAR_CONTROLLER')]) : static::$_default_controller);
         //定义常量保存操作方法
         define('ACTION',isset($_GET[C('VAR_ACTION')]) ? $_GET[C('VAR_ACTION')] : static::$_default_action);
     }
     static public function initDispatchParamByPathInfo($param){
         //dump(isset($param['action']));die;
         //定义常量保存操作平台
         define('PLATFORM',isset($param['platform'])&&$param['platform']!='' ? ucfirst($param['platform']) : static::$_default_platform);
         //定义常量保存控制器
         define('CONTROLLER',isset($param['controller'])&&$param['controller']!='' ? ucfirst($param['controller']) : static::$_default_controller);
         //定义常量保存操作方法
         define('ACTION',isset($param['action'])&&$param['action']!='' ? $param['action'] : static::$_default_action);
     }
 }



?>