<?php

class Application_Model_Forum_Post extends Zend_Db_Table {
    protected $_name = 'forum_post';

    public function findByTopicId($topic_id)
    {
        return $this->getAdapter()->select('post.*, u.*')
            ->from('forum_post as post')
            ->where('post.topic_id = ?', $topic_id)
            ->joinLeft(array( 'u' => 'user'), 'author_id = u.id')
            ->query()->fetchAll();
    }
}