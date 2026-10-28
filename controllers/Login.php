<?php
    class Login extends CI_Controller{
    	function login(){
    		$this::parrent;
    	}
		
    	function success(){
    		echo "Login Successfully!!!";
    	}
		
		function onLogin(){
			$u = new User();
			$u->username = 'MyUsername';
			$u->password = 'MyPassword';
			$u->save();
			
			echo "string";
		}
    }
?>