<?php

require_once 'BaseController.php';

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->view->posts = $this->_post->getAdapter()->query('SELECT * FROM post ORDER BY publish_time  DESC LIMIT 10')->fetchAll();
    }
}

