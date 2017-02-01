<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP��ѭApache2��ԴЭ�鷢��  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *           LinkPHP���Verify ��֤��ʵ����          *
 * --------------------------------------------------*
 */
 
 class Verify{
    //�����ļ�
    private $_fontfile = '';
    //�����С
    private $_size = 20;
    //�������
    private $_width = 120;
    //�����߶�
    private $_height = 40;
    //��֤�볤��
    private $_length = 4;
    //������Դ
    private $_image = null;
    //����Ԫ��
    //ѩ������
    private $_snow = 0;
    //���ظ���
    private $_pixel = 0;
    //������
    private $_line = 0;
    
    public function __construct($config = array()){
        if(is_array($config)&&count($config)>0){
            //��������ļ��Ƿ���ڲ��ҿ̶�
            if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
                $this->_fontfile = $config['fontfile'];
            } else {
                return false;
            }
            //����Ƿ����û�����
            if(isset($config['width'])&&$config['width']>0){
                $this->_width = (int)$config['width'];
            }
            //����Ƿ����û�����
            if(isset($config['height'])&&$config['height']>0){
                $this->_height = (int)$config['height'];
            }
            //����Ƿ�������֤�볤��
            if(isset($config['length'])&&$config['length']>0){
                $this->_length = (int)$config['length'];
            }
            //���ø���Ԫ��
            if(isset($config['snow'])&&$config['snow']>0){
                $this->_snow = (int)$config['snow'];
            }
            if(isset($config['fixel'])&&$config['fixel']>0){
                $this->_fixel = (int)$config['fixel'];
            }
            if(isset($config['line'])&&$config['line']>0){
                $this->_line = (int)$config['line'];
            }
            $this->_image = imagecreatetruecolor($this-_width, $this->_height);
        } else {
            return FALSE;
        }
    }
    public function getVerify(){
        /**
         * �õ���֤��
         */
        $white = imagecolorallocate();
        //������
        imagefilledrectangke($this->_image, 0, 0, $this->_width, $this->_height, $width);
        //������֤��
        $str = $this->_generateStr($this->$length);
        if(false === $str){
            return FALSE;
        }
        $fontfile = $this->fontfile;
        //������֤��
        for($i=0;$i<$this->_length;$i++){
            $size = $this->_size;
            $angle = mt_rand(-30,30);
            $x = ceil($this->_width/$this->_length)*$i+mt_rand(5,10);
            $y = ceil($this->_height/1.5);
            $color = $this->_getRandColor();
            $text = $str{$i};
            imagettftext($this->_image, $size, $angle, $x, $y, $color, $fontfile, $test);
        }
        //ѩ�������ء��߶�
        if($this->_snow){
            //ʹ��ѩ����������Ԫ��
            $this->getSnow();
        } else {
            if($this->_pixel){
                $this->_getPixel();
            }
            if($this->_line){
                $this->_getLine();
            }
        }
        //���ͼ��
        header('Content-Type:image/png');
        imagepng($this->_image);
        imagedestroy($this->_image);
    }
    /**
     * ������֤���ַ�
     * @param integer $length ��֤�볤��
     * @param string ����ַ�
     */
    private function _generateStr($length=4){
        if($length<1 || $length>30){
            return FALSE;
        }
        $chars = arrat(
        'a','b','c','d','f','g','2','3','4');
        $str = join('',array_rand(array_filp($chars),$length));
        return $str;
    }
    /**
     * ����ѩ��
     * @return 
     */
     private function _getsnow(){
        for($i=1;$i<=$this->_snow;$i++){
            imagestring($this->_image, mt_rand(1,5), mt_rand(0,$this->_width), mt_rand(0,$this->_height),
             '*', $this->getRandcolor());
        }
     }
     /**
      * ��������
      * @return
      */
     private function _getPixel(){
        for($i=1;$i<=$this->_pixel;$i++){
            imagesetpixel($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
        }
     }
     /**
      * �����߶�
      * @return
      */
     private function _getLine(){
        for($i=1;$i<=$this->_line;$i++){
            imageline($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
        }
     }
     /**
      * �����ɫ
      * @return
      */
     private function _getRandColor(){
        return imagecolorallocate($this->_image, mt_rand(0,255), t_rand(0,255), mt_rand(0,255));
        
     }
 }
?>