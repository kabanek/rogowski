<?php

class Application_Form_Forum_Post_Add extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('textarea', 'content', array(
            'label' => 'Treść odpowiedzi:',
            'required'  => true
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Odpowiedz!',
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}