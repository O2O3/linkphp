<?php

/**
 * @author liujun
 * @copyright 2017
 */

function uploadOne($file){
        //�Ƿ���ڴ���
        if ($file['error'] != 0){
            echo '�ϴ�����';
            return false;
        }
        //��С
        $max_size = 1024*1024; //���ߴ�
        if ($file['size'] > $max_size){
            echo '�ϴ��ļ�����';
            return false;
        }
        
        //����
        //��֤�޸�����ĺ�׺�����Ϳ���Ӱ���$allow_ext_list��$allow_mime_list
        //����һ����׺����mime��ӳ��Ԫ��
        $type_map = array(
           '.png' => array('image/png','image/x-png'),
           '.jpg' => array('image/jpeg','image/pjpeg'),
           '.jpeg' => array('image/jpeg','image/pjpeg'),
           '.gif' => array('image/gif'),
        );
        //��׺��ԭʼ�ļ�������ȡ
        
        $allow_ext_list = array('.png','.gif','.jpg');
        $ext = strtolower(strrchr($file['name'],'.'));
        if (!in_array($ext,$allow_ext_list)){
            echo '�ϴ��ļ����Ͳ��Ϸ�';
            return false;
        }
        //MIME,typeԪ��
       // $allow_mime_list = array('image/png','image/jpg');
       $allow_mime_list = array();
       foreach($allow_ext_list as $value) {
          //�õ�ÿ����׺
          $allow_mime_list = array_merge($allow_mime_list,$type_map[$value]);
       }
          //ȥ�ظ�
          $allow_mime_list = array_unique($allow_mime_list);
        if (!in_array($file['type'],$allow_mime_list)){
            echo '�ϴ��ļ����Ͳ��Ϸ�';
            return false;
        }
        
        //php�Լ���ȡ�ļ���mime�����м��
        $finfo = new finfo(FILEINFO_MIME_TYPE); //���һ�����Լ���ļ�mime������Ϣ�Ķ���
        $mime_type = $finfo->file($file['tmp_name']); 
        
        //�ƶ�
        //�ϴ��ļ��洢��ַ
        $upload_path = './';
        //������Ŀ¼
        $subdir = data('YmdH') . '/';
        if (is_dir($upload_path . $subdir)) {//�����Ŀ¼�Ƿ����
           //������
           mkdir($upload_path . $subdir);
            
        }
        //�ļ�����
        $prefix = ''; //�ļ�ǰ׺
        //$filename = uniqID();
        //$filename = uniqID($prefix);
        $filename = uniqID($prefix,true) . $ext;
        if (move_uploaded_file($file['tmp_name'],upload_path . $filename)){
            //�ƶ��ɹ�
            return $subdir . $filename;
        } else {
            //�ƶ�ʧ��
            echo '�ƶ�ʧ��';
            return false;
        }
    }

?>