<?php

class Application_Form_Login extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'username', array(
            'label' => 'Nazwa użytkownika',
            'required'  => false
        ));

        $this->addElement('password', 'password', array(
            'label' => 'Hasło',
            'required'  => true
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Zaloguj',
        ));
    }
}