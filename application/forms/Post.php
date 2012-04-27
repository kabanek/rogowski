<?php

class Application_Form_Post extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'title', array(
            'label' => 'Tytuł posta',
            'required'  => true
        ));

        $this->addElement('textarea', 'short', array(
            'label' => 'Krótkie wprowadzenie',
            'required'  => true
        ));
        $this->addElement('textarea', 'content', array(
            'label' => 'Treść postu',
            'required'  => true
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Dodaj',
        ));
    }
}