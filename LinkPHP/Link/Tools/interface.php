<?php

/**
 * @author liujun
 * @copyright 2017
 */

//�ӿ�

interface connectAll{
    
    function connect();//�ӿ��еķ������ǳ��󷽷���������������
}
class Db{
    
    public $host = "localhost";
}
//�̳нӿڵ����ԣ�����Ϊ��ʵ�֣�implements��
class Login extends Db implements connextAll{
    
    function connect(){
        echo "<br />����{$this->host}��������";
    }
}

$c1 = new Login();
$c1 -> connect();

?>