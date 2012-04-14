<?php

require_once 'BaseController.php';

class UserController extends BaseController
{

    public function loginAction()
    {
        if (count($_POST)) {
            $table = new Application_Model_User;

            $user = $table->check($_POST['username'], $_POST['password']);

            if (count($user)) { // czy znalazł takiego usera
                $this->_session->userId = $user['id'];
                $this->_helper->redirector('index', 'index');
            }

            $this->_helper->redirector('user', 'login');
        }
    }

    public function logoutAction()
    {
        unset($this->_session->userId);
        $this->_helper->redirector('index', 'index');
    }
}

