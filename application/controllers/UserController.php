<?php

require_once 'BaseController.php';

class UserController extends BaseController
{

    public function loginAction()
    {
        if (count($_POST)) {
            $user = new Application_Model_User;
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];

            $result = Zend_Auth::getInstance()->authenticate($user);

            if ($result->isValid()) {
                $this->_session->userId = $result->getIdentity();
                $this->_helper->redirector('index', 'index');
            } else {
                $this->_helper->redirector('login', 'user');
            }
        }
    }

    public function logoutAction()
    {
        unset($this->_session->userId);
        $this->_helper->redirector('index', 'index');
    }
}

