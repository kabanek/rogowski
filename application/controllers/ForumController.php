<?php

require_once 'BaseController.php';

class ForumController extends BaseController
{

    public function indexAction()
    {
        $this->view->categories = $this->_forum_category->getAll();

        $this->view->forum_topic = $this->_forum_topic;
    }

    public function addtopicAction()
    {
        if (!$this->_loggedIn) { // aby dodać temat musi być zalogowanym
            $this->_helper->redirector('index', 'index');
        }

        $category = $this->_forum_category->find($this->_getParam('category_id'))->getRow(0)->toArray();

        if (!$category) { // czy taka kategoria istnieje
            $this->_helper->redirector('index', 'index');
        }

        $form = new Application_Form_Forum_Topic_Add;

        if (count($_POST)) {
            if ($form->isValid($_POST)) {
                unset($_POST['submit']);
                unset($_POST['csrf']);
                $_POST['author_id'] = $this->_userData['user_id'];
                $_POST['category_id'] = $this->_getParam('category_id');
                $_POST['created_at'] = date('Y-m-d H:i:s');
                $this->_forum_topic->insert($_POST);

                $this->_helper->redirector('index', 'forum');
            }
        }

        $this->view->form = $form;
    }

    public function showtopicAction()
    {
        $category = $this->_forum_category->find($this->_getParam('category_id'))->getRow(0)->toArray();

        if (!$category) { // czy taka kategoria istnieje
            $this->_helper->redirector('index', 'index');
        }

        $topic = $this->_forum_topic->getAdapter()->select('topic.*, u.*')
            ->from('forum_topic as topic')
            ->where('topic.id = ?', $this->_getParam('topic_id'))
            ->joinLeft(array( 'u' => 'user'), 'author_id = u.id')
            ->query()->fetch();

        if (!$topic) { // czy taki temat istnieje
            $this->_helper->redirector('index', 'index');
        }

        if ($this->_loggedIn) {
            $form = new Application_Form_Forum_Post_Add;

            if (count($_POST)) {
                if ($form->isValid($_POST)) {
                    unset($_POST['submit']);
                    unset($_POST['csrf']);
                    $_POST['author_id'] = $this->_userData['user_id'];
                    $_POST['topic_id'] = $this->_getParam('topic_id');
                    $_POST['created_at'] = date('Y-m-d H:i:s');
                    $this->_forum_post->insert($_POST);

                    $this->_helper->redirector('show_topic', 'forum', 'default', array(
                        'category_id'   => $this->_getParam('category_id'),
                        'topic_id'      => $this->_getParam('topic_id')
                    ));
                }
            }

            $this->view->form = $form;
        }

        $posts = $this->_forum_post->findByTopicId($this->_getParam('topic_id'));

        $this->view->category = $category;
        $this->view->topic = $topic;
        $this->view->posts = $posts;
    }
}
