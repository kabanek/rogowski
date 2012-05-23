<?php

require_once 'BaseController.php';

class PostController extends BaseController 
{
    function newAction()
    {
        if (!$this->view->loggedIn) { // nie zalogowany
            $this->_helper->redirector('index', 'index');
        }

        if (!$this->_userData['code'] == 'admin') { //posty dodawać może tylko admin
            $this->_helper->redirector('index', 'index');
        }

        $form = new Application_Form_Post;

        if (count($_POST)) {
            if ($form->isValid($_POST)) {
                unset($_POST['submit']);
                $_POST['author_id'] = $this->_userData['id'];
                $this->_post->insert($_POST);

                $this->_helper->redirector('index', 'index');
            }
        }

        $this->view->form = $form;
    }

    function showAction()
    {
        $post_id = $this->_getParam('id');

        $form = new Application_Form_Comment;

        if (count($_POST)) { // dodaje komentarz

            if ($form->isValid($_POST)) {
                unset($_POST['submit'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);
                $_POST['post_id'] = $post_id;
                $_POST['date'] = date('Y-m-d H:i:s');
                $comment = new Application_Model_Comment;
                $comment->insert($_POST);

                $this->_helper->redirector('index', 'index');
            }

            $this->_helper->redirector('show', 'post', 'default', array('id' => $post_id));
        }

        $this->view->post = $this->_post->getAdapter()->select('u.*, p.*')
            ->from('post as p')
            ->joinLeft(array( 'u' => 'user'), 'author_id = u.id')->where('p.id = ?', $post_id)->query()->fetch();

        if (!$this->view->post) { // nie znaleziono posta
            $this->_helper->redirector('index', 'index');
        }

        $comment = new Application_Model_Comment;
        $this->view->comments = $comment->select()->where('post_id = ?', $post_id)->order('date DESC')->query()->fetchAll();

        $this->view->form = $form;
    }

    function editAction()
    {
        if (!$this->view->loggedIn) { // nie zalogowany
            $this->_helper->redirector('index', 'index');
        }

        if (!$this->_userData['code'] == 'admin') { //posty edytować może tylko admin
            $this->_helper->redirector('index', 'index');
        }

        $post_id = $this->_getParam('id');

        $post = $this->_post->getAdapter()->query("SELECT * FROM post WHERE id = $post_id")->fetch();

        $form = new Application_Form_Post;

        if (count($_POST)) {
            if ($form->isValid($_POST)) {
                unset($_POST['submit']);
                $_POST['author_id'] = $this->_userData['id'];
                $this->_post->update($_POST, 'id = ' . $post_id);

                $this->_helper->redirector('show', 'post', NULL, array('id' => $post_id));
            }
        } else {
            $form->getElement('title')->setValue($post['title']);
            $form->getElement('short')->setValue($post['short']);
            $form->getElement('content')->setValue($post['content']);
        }

        $this->view->form = $form;
    }
}