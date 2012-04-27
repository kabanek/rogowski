<?php

require_once 'BaseController.php';

class PostController extends BaseController 
{
    function newAction()
    {
        if (count($_POST)) {
            $data = $_POST;

            $this->_post->getAdapter()->query("INSERT INTO post VALUES(NULL, '{$data['title']}', '{$data['short']}', '{$data['content']}', '" . $this->_userData['id'] . "', NOW())");

            $this->_helper->redirector('index', 'index');
        }
    }

    function showAction()
    {
        $post_id = $this->_getParam('id');

        if (count($_POST)) { // dodaje komentarz
            $query = "INSERT INTO comment VALUES(NULL, '{$_POST['email']}','{$_POST['name']}','{$_POST['body']}', NOW(), $post_id)";

            $this->_post->getAdapter()->query($query);
            $this->_helper->redirector('show', 'post', 'default', array('id' => $post_id));
        }

        $this->view->comments = $this->_post->getAdapter()->query("SELECT * FROM comment WHERE post_id = $post_id ORDER BY date DESC")->fetchAll();

        $this->view->post = $this->_post->getAdapter()->query("SELECT * FROM post as p LEFT JOIN user as u ON u.id = p.author_id WHERE p.id = $post_id")->fetch();
    }

    function editAction()
    {
        $post_id = $this->_getParam('id');

        if (count($_POST)) {
            $query = "UPDATE post SET ";

            foreach ($_POST as $key => $value) {
                $query .= "$key = '$value', ";
            }

            // ucinam ostatni niepotrzebny przecinek
            $query = substr($query, 0, -2);

            $query .= " WHERE id = " . $post_id;

            $this->_post->getAdapter()->query($query);

            $this->_helper->redirector('show', 'post', NULL, array('id' => $post_id));
        }

        $this->view->post = $this->_post->getAdapter()->query("SELECT * FROM post WHERE id = $post_id")->fetch();
    }
}