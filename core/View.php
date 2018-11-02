<?php

class View {
    protected $_head, $_body, $_outputBuffer, $_siteTitle = SITE_TITLE, $_layout = DEFAULT_LAYOUT, $_viewData=null, $_viewError=null;
    public $displayErrors;

    public function render($viewName) {
        // dnd(->_db->find('posts'));

        $viewArray = explode('/', $viewName);
        $viewString = implode(DS, $viewArray);
        // dnd($viewArray);
        // dnd($viewString);
        // dnd(DS);
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
        } else {
            die('The view \"' . $viewName . '\" does not exist');
        }
    }

    public function content($type) {
        if ($type == 'head') {
            return $this->_head;
        } elseif ($type == 'body') {
            return $this->_body;
        }
        return false;
    }

    public function start($type) {
        $this->_outputBuffer = $type;
        ob_start();
    }
    public function end() {
        if($this->_outputBuffer == 'head') {
            $this->_head = ob_get_clean();
        } elseif ($this->_outputBuffer = 'body') {
            $this->_body = ob_get_clean();
        } else {
            die('You must first run the start method.');
        }
    }

    public function getSiteTitle() {
        return $this->_siteTitle;
    }
    public function setSiteTitle($title) {
        $this->_siteTitle = $title;
    }
    public function setLayout($path) {
        $this->_layout = $path;
    }
    public function getViewData() {
        return $this->_viewData;
    }
    public function setViewData($data) {
        $this->_viewData = $data;
    }
    public function getViewError() {
        return $this->_viewError;
    }
    public function setViewError($error) {
        $this->_viewError = $error;
    }

}