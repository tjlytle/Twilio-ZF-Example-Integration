<?php
class IndexController extends Zend_Controller_Action
{
    protected $twilio;
    
    public function init()
    {
        $this->twilio = $this->getFrontController()->getParam('bootstrap')->getResource('twilio');
        
        $contextSwitch = $this->getHelper('contextSwitch');
        $contextSwitch->addContext('twiml', array('suffix' => 'twiml'));
        $contextSwitch->addHeader('twiml', 'Content-Type', 'application/xml');
        $contextSwitch->addActionContext('index', 'twiml');
        $contextSwitch->initContext();
    }

    public function indexAction()
    {
        if($this->_hasParam('Digits')){
            $this->_setParam('order', $this->_getParam('Digits'));
        }
        
        if($this->_hasParam('order')){
            $order = Application_Model_Order::getOrder($this->_getParam('order'));
            $this->view->order = $order;
        }
    }
}

