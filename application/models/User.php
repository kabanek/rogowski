<?php

class Application_Model_User extends Zend_Db_Table {
    protected $_name = 'user';
    
    /**
     * Sprawdza, czy istnieje użytkownik o danej nazwie z tym hasłem
     * @param string $username
     * @param string $password 
     * @return array|bool zwraca tablicę jeśli udało się znaleźć użytkownika oraz false, w przeciwnym wypadku
     */
    public function check($username, $password)
    {
        $password = md5($password);
        
        return $this->select()
                ->where("username LIKE '$username'")
                ->where("password LIKE '$password'")
                ->query()
                ->fetch();
    }
}