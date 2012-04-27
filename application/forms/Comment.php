<?php

class Application_Form_Comment extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'name', array(
            'label' => 'Autor:',
            'required'  => false
        ));

        $this->addElement('text', 'email', array(
            'label' => 'Adres email (wymagane):',
            'required'  => true
        ));
        $this->addElement('textarea', 'body', array(
            'label' => 'Treść wiadomości (wymagane):',
            'required'  => true
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Dodaj',
        ));
    }
}