<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
include APPPATH . 'controllers/Construct.php';

class Error extends Construct
{
    public function __construct()
    {
        parent::__construct();

    }
    
    public function index()
    {
        $this->template->useAsset()->setJs(array('jquery.min'));
        $this->template->useAsset()->setCSS(array('bootstrap.min.theme4', 'error', 'responsive'));

        $data = array(
            'assets'  => $this->template->getMetadata(),
        );

        go('error', $data);
    }
}
