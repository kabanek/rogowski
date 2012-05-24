<?php

class Application_Model_Forum_Topic extends Zend_Db_Table {
    protected $_name = 'forum_topic';

    public function findByCategory($catgory_id)
    {
        return $this->getAdapter()->select('topic.*, u.*')
            ->from('forum_topic as topic', array('*', '(SELECT COUNT(*) FROM forum_post WHERE topic_id = topic.id) as number_of_posts'))
            ->where('topic.category_id = ?', $catgory_id)
            ->joinLeft(array( 'u' => 'user'), 'author_id = u.id')
            ->query()->fetchAll();
    }
}
