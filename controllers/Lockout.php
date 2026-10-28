<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lockout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model('user_log');
        // $sess = sess_on('auth');
        // if(isset($sess->sessid))
        // {
        //     $sessid = $sess->sessid;
        // }
        // else
        // {
        //     $sessid = session_id();
        // }
        // $user_log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'))->first();
        // //if (sess_on($id) && sess_on($id)->date == date('Y-m-d')) {
        // if (count($user_log) > 0)
        // {
        //     if($user_log->user_id) {
        //         if (in_array(segments(), array('signin'))) {
        //             redirect(SUBDOM, 'refresh');
        //         }
        //     }
        //     else {
        //         if (!in_array(segments(), array('signin', 'reset', 'auth_on', 'auth_status', 'coba'))) {
        //             redirect(SUBDOM . 'main/signin', 'refresh');
        //         }
        //     }
        //     //$this->load->model('poli_antrian');
        // } else {
        //     if (!in_array(segments(), array('signin', 'reset', 'auth_on', 'auth_status', 'coba'))) {
        //         redirect(SUBDOM . 'main/signin', 'refresh');
        //     }
        // }
        // pre($sess); 
		// var_dump('c'); die();
    }
	public function index() {
		$view = 'form/lockout';
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'home'   => true,
            'header' => false,
            'view'   => $view,
            // 'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
	}
}