<?php

/**
 * @author liujun
 * @copyright 2017
 * session���ݱ�
 * create table if not exists fly_session(
 *   session_id varchar(40) not null default '' comment 'sessionID';
 *   session_content text;
 *   last_time int not null default '0' comment '�����ʱ��';
 * primary key(session_id) 
 * )engine=MyISAM default charset=utf8 comment session���ݱ�'';
 */


function userSessionBegin(){
    
}
function userSessionEnd(){
    
}
function userSessionRead($sess_id){
    /**
     * ������
     * ִ��ʱ������session���ƿ���ʱ
     * ������    ��session�������ж�ȡ����
     * @param $sess_id string
     * @return string
     */
     //��ʼ�����ݿ����������
     //��ѯ
    
}
function userSessionWrite($sess_id,$sess_content){
    /**
     * ���²���
     * ִ��ʱ����   �ű����ڽ���ʱ��php��������βʱ
     * ������       ����ǰ�ű�����õ�session���ݣ��־û��洢�����ݿ���
     * @param $sess_id string
     * @param $sess_content text
     * @return bool 
     */
     //��ʼ�����ݿ����������
     //������������
}
function userSessionDelete($sess_id){
    /**
     * ɾ������
     * ִ��ʱ����   ������session_destroy()����session�����б�����
     * ������       ɾ����ǰsession������������¼��
     * @param $sess_id string
     * @return bool 
     */
     //��ʼ�����ݿ����������
     //ɾ�����
    
}
function userSessionGC($sess_id){
     /**
     * ɾ�����ݿ�session���ֶ����ݲ���
     * ִ��ʱ����   ���һ��д��������������ʱ����ɾ��
     * ������       ɾ����ǰsession�����ݿ��ֶ����ݣ���¼��
     * @param $sess_id string
     * @return bool 
     */
     //��ʼ�����ݿ����������
     //�ж�ʱ��ִ��ɾ�����
    
}
session_set_save_handler(
    'userSessionBegin',
    'userSessionEnd',
    'userSessionRead',
    'userSessionWrite',
    'userSessionDelete',
    'userSessionGC'
);

?>