<?php

/**
 * @author liujun
 * @copyright 2017
 * ��Ч��[�ػ����ڽ���]
 * ��Ч·��[��վ��Ч]
 * ��Ч��[��ǰ����Ч]
 * �Ƿ��Ϊ��ȫ���Ӵ���
 * �Ƿ��Ϊhttp����
 */
session_set_cookie_params(3600); //����session
session_start();//����session����
$_SESSION['mid'];
session_destroy();//���ٵ�ǰsession��Ӧ�����������ر�session����
Unset($_SESSION);//���ٱ���
setcookie(session_name(),'',time()-1);//����cookie�е�seesion-id
$_SESSION = array(); //���session����
?>