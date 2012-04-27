<?php

require_once 'BaseController.php';

class PostController extends BaseController 
{
    function newAction()
    {
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
                unset($_POST['submit']);
                $_POST['post_id'] = $post_id;
                $_POST['date'] = date('Y-m-d H:i:s');
                $this->_post->insert($_POST);

                $this->_helper->redirector('index', 'index');
            }

            $this->_helper->redirector('show', 'post', 'default', array('id' => $post_id));
        }

        $this->view->comments = $this->_post->getAdapter()->query("SELECT * FROM comment WHERE post_id = $post_id ORDER BY date DESC")->fetchAll();
        $this->view->post = $this->_post->getAdapter()->query("SELECT * FROM post as p LEFT JOIN user as u ON u.id = p.author_id WHERE p.id = $post_id")->fetch();

        $this->view->form = $form;
    }

    function editAction()
    {
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