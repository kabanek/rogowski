<?php

class Application_Form_Forum_Topic_Add extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'title', array(
            'label' => 'Tytuł posta:',
            'required'  => false
        ));

        $this->addElement('textarea', 'content', array(
            'label' => 'Treść:',
            'required'  => true
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Dodaj',
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}