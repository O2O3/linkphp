<?php

/**
 * @author LinkPHP
 * @copyright 2017
 * httpЭ��
 * php�������ݸ�ʽ
 */

$host = 'www.1.com'; // hostʹ��IPҲ����
$poort = '80';
//��������
$link = Fsockopen($host,$port);

//������������
//������
define('CRLF',"\r\n");
$request_data = 'GET /index.php/Home/Index/index HTTP/1.1' . CRLF;
//����ͷ
$request_data .= 'Host:www.1.com' . CRLF;
$request_data .= 'User-Agent:'; 
$request_data .= 'Connection:Keep-Alive' . CRLF;
//���б�ʾͷ����
$request_data .= CRLF;
//�������壬GETû������
//�����������GET��������
fwrite($link,$request_data);
//��ȡ����������Ӧ����
while (!feof($link)){
   echo fgets($link,1024);
}
fclose($link);
?>