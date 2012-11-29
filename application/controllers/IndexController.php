<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $targets = new SimpleXMLElement(file_get_contents(APPLICATION_PATH . '/configs/target-config.xml'));
        $this->view->targets = $targets;

        $flashMessages = $this->_helper->flashMessenger->getMessages();
        if (count($flashMessages)) {
            $this->view->flashMessages = $flashMessages;
        }
    }

    public function wolAction()
    {
        $macaddr = $this->_getParam('macaddr');
        $command = "/usr/bin/wol -v {$macaddr}";
//        d($command);
        exec($command, $output, $returnVar);
        $name = $this->_getParam('name');
        $this->_helper->flashMessenger('結果ステータス： ' . $returnVar . '(' . $name . ')');

        $this->_helper->redirector('index');
    }
}

