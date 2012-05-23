<?php

class Application_Form_Register extends Zend_Form {
    function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'username', array(
            'label' => 'Nazwa użytkownika',
            'required'  => false
        ));

        $this->addElement('text', 'name', array(
            'label' => 'Nazwa wyświetlana',
            'required'  => true
        ));

        $this->getElement('username')
            ->addFilters(array('StringTrim', 'StripTags'))
            ->addValidator(new Zend_Validate_Db_NoRecordExists('user', 'username'));

        $this->addElement('password', 'password', array(
            'label' => 'Hasło',
            'required'  => true
        ));

        $this->getElement('password')
            ->addValidator('StringLength', false, array(6));

        $this->addElement('password', 'password_confirm', array(
            'label' => 'Powtórz hasło',
            'required'  => true
        ));

        $this->getElement('password_confirm')
            ->addValidator(new Zend_Validate_Identical(array('token'=>'password')));

        $this->addElement('text', 'email', array(
            'label' => 'Adres email',
            'required'  => true
        ));

        $this->getElement('email')
            ->addFilters(array('StringTrim', 'StripTags'))
            ->addValidator('EmailAddress', true)
            ->addValidator(new Zend_Validate_Db_NoRecordExists('user', 'email'));

        $recaptcha = new Zend_Service_ReCaptcha('6LcBQtESAAAAACkNaTmkXEPvCO-bggD7BnQ86XWO', '6LcBQtESAAAAAOGfvZ2RELqSP7dwMv1sCckIGQyO');

        $captcha = new Zend_Form_Element_Captcha('recaptcha',
            array('captcha'        => 'ReCaptcha',
                'captchaOptions' => array('captcha' => 'ReCaptcha', 'service' => $recaptcha))
        );

        $this->addElement($captcha);

        $this->addElement('submit', 'submit', array(
            'label' => 'Zarejestruj się',
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}