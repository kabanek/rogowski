<?php

require_once 'BaseController.php';

class UserController extends BaseController
{

    public function loginAction()
    {
        $form = new Application_Form_Login;

        if (count($_POST)) {
            if ($form->isValid($_POST)) {
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

        $this->view->form = $form;
    }

    public function logoutAction()
    {
        unset($this->_session->userId);
        $this->_helper->redirector('index', 'index');
    }

    public function registerAction()
    {
        $form = new Application_Form_Register;

        if (count($_POST)) {
            if ($form->isValid($_POST)) {
                $userData = array(
                    'username'  => $_POST['username'],
                    'name'      => $_POST['name'],
                    'password'  => md5($_POST['password']),
                    'email'     => $_POST['email'],
                    'group_id'     => 1,   // czyli zwykły użytkownik
                );

                $this->_user->insert($userData);
                $this->_helper->redirector('index', 'index');
            }
        }

        $this->view->form = $form;
    }
}

