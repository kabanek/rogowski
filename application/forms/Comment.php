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

        $recaptcha = new Zend_Service_ReCaptcha('6LcBQtESAAAAACkNaTmkXEPvCO-bggD7BnQ86XWO', '6LcBQtESAAAAAOGfvZ2RELqSP7dwMv1sCckIGQyO');

        $captcha = new Zend_Form_Element_Captcha('recaptcha',
            array('captcha'        => 'ReCaptcha',
                'captchaOptions' => array('captcha' => 'ReCaptcha', 'service' => $recaptcha))
        );

        $this->addElement($captcha);

        $this->addElement('submit', 'submit', array(
            'label' => 'Dodaj',
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}