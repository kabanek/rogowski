<?php

require_once 'BaseController.php';

class AttachmentsController extends BaseController
{
    public function indexAction()
    {
        $file = base64_decode($_GET['file']);

        $file = explode(PATH_SEPARATOR, $file);
        $file = $file[count($file) - 1];

        $file_path =  '../attachments/' .$file;

        $mime_type = mime_content_type($file_path);

        header('Content-type: ' . $mime_type);
        header('Content-Disposition: attachment; filename="' . $file .'"');
        readfile($file_path);
        die;
    }
}

