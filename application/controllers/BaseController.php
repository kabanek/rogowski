<?php

class BaseController extends Zend_Controller_Action 
{
    /**
     * @var Zend_Session
     */
    protected $_session;

    /**
     * @var Application_Model_User
     */
    protected $_user;

    /**
     * @var array
     */
    protected $_userData;

    /**
     * @var bool
     */
    protected $_loggedIn;

    /**
     * @var Application_Model_Post
     */
    protected $_post;

    function init()
    {
        $this->_session = Zend_Registry::get('session');
        $this->_user = new Application_Model_User;

        if (intval($this->_session->userId)) {
            $this->_userData = $this->_user->getAdapter()->select('u.*, g.*')
                ->from('user as u')
                ->joinLeft(array( 'g' => 'group'), 'group_id = g.id')->where('u.id = ?', $this->_session->userId)->query()->fetch();
            
            $this->_loggedIn = $this->view->loggedIn = true;
        } else {
            $this->_userData = array();
            $this->_loggedIn = $this->view->loggedIn = false;
        }

        $this->view->userData = $this->_userData;
        $this->_post = new Application_Model_Post;

        $this->view->new_posts = $this->_post->getAdapter()->query('SELECT * FROM post ORDER BY publish_time  DESC LIMIT 5')->fetchAll();
    }
}