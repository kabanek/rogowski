<?php

class Application_Model_Forum_Category extends Zend_Db_Table {
    protected $_name = 'forum_category';

    public function getAll()
    {
        return $this->getAdapter()
            ->select('*')
            ->from(array('cat'  => $this->_name))
            ->order('order DESC')
            ->query()
            ->fetchAll();
    }
}