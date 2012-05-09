<?php

class Application_Model_User extends Zend_Db_Table implements Zend_Auth_Adapter_Interface {
    protected $_name = 'user';
    public $username;
    public $password;
    public $id;
    
    /**
     * Sprawdza, czy istnieje użytkownik o danej nazwie z tym hasłem
     * @param string $username
     * @param string $password 
     * @return array|bool zwraca tablicę jeśli udało się znaleźć użytkownika oraz false, w przeciwnym wypadku
     * @deprecated
     */
    public function check($username, $password)
    {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username LIKE '$username' AND password LIKE '$password'";
        
        return $this->getAdapter()->query($query)->fetch();
    }

    public function authenticate()
    {
        $user = $this->select()
            ->where('username = ?', $this->username)
            ->where('password = ?', md5($this->password))
            ->query()
            ->fetch();

        if (($user)) {
            // Uwierzytelnianie powiodło się, informujemy o sukcesie.
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $user['id']);
        }

        // Uwierzytelnianie nie powiodło się.
        // Zwracamy odpowiedni status, a jako tożsamość podajemy
        // wartość null.
        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);
    }
}