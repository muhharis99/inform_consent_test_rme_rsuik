<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Construct extends CI_Controller {

	public function __construct(){
		parent::__construct();
          
		$this->template->useAsset()
               ->setCss(array(
			))
			->setJs(array(
               ))
               ->setTitle('RME');
	}

	public function index()
	{
	}
}