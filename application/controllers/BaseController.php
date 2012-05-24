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

    /**
     * @var Application_Model_Forum_Category
     */
    protected $_forum_category;

    /**
     * @var Application_Model_Forum_Topic
     */
    protected $_forum_topic;

    /**
     * @var Application_Model_Forum_Post
     */
    protected $_forum_post;

    function init()
    {
        $this->_session = Zend_Registry::get('session');
        $this->_user = new Application_Model_User;

        $this->_forum_category = new Application_Model_Forum_Category;
        $this->_forum_topic = new Application_Model_Forum_Topic;
        $this->_forum_post = new Application_Model_Forum_Post;

        if (intval($this->_session->userId)) {
            $this->_userData = $this->_user->getAdapter()->select('u.*, g.*')
                ->from('user as u', array('*', 'u.id as user_id'))
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