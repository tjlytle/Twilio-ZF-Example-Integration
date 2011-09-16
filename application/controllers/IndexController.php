<?php
class IndexController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
    {
        if($this->_hasParam('order')){
            $order = Application_Model_Order::getOrder($this->_getParam('order'));
            $this->view->order = $order;
        }
    }
}

