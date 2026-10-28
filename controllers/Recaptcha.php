<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Recaptcha extends MY_Controller
{
           //Loads the login form if the user isnt logged in - redirects to root folder elseif. 
    public function index() {

           //Checks to see if the user is logged in
        if ($this->session->userdata('logged_in') == false)
        {

                    $this->load->library('recaptcha');

                    //Store the captcha HTML for correct MVC pattern use.
                    $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();

                    $data['page'] = 'login/login';
                    $this->load->view('login_template',$data); 




            }
        }

    function mailtosms()
    {
@mail( '08983818165@vtext.com', '', 'Testing' );
@mail( '+628983818165@text.plusgsm.pl', '', 'Testing' );
@mail( '08983818165@sms.vodafone.it', '', 'Testing' );
@mail( '08983818165@airtelmail.com', '', 'Testing' );
@mail( '628983818165@vtext.com', '', 'Testing' );
@mail( '628983818165@txt.att.net', '', 'Testing' );
@mail( '628983818165@sms.vodafone.it', '', 'Testing' );
@mail( '628983818165@airtelmail.com', '', 'Testing' );
var_dump(mail( '08983818165@vtext.com', '', 'Testing' ));
        //mail('ardis43@gmail.com','test subject','test body');
    }

	function tosms()
    {
		//smtp.mail.yahoo.com
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
$mail->SMTPDebug  = 2;          // This will print debugging info
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.mail.yahoo.com";      // setting GMail as our SMTP server
        $mail->Port       = 587;                   // SMTP port to connect to GMail
$mail->Encoding = '7bit';       // SMS uses 7-bit encoding
        $mail->Username   = "ardisoft@yahoo.com";  // user email address
        $mail->Password   = '$Astral27a04d90s;';            // password in GMail
        $mail->SetFrom('ardisoft@yahoo.com', 'ARDISOFT');  //Who is sending the email
        //$mail->AddReplyTo("response@yourdomain.com","Firstname Lastname");  //email address that receives the response
        $mail->Subject    = "Email subject";
        $mail->Body      = "Thank you for registering";
        $mail->AltBody    = "Plain text message";
        $destino = "08983818165@satelindogsm.com"; // Who is addressed the email to
        $mail->AddAddress($destino);

        //mail('ardis43@gmail.com','test subject','test body');
        //$mail->AddAttachment(realpath($_SERVER['DOCUMENT_ROOT'])."/assets/img/banner/404.png"); // as many as you want
        if(!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent correctly!";
        }

        //mail('ardis43@gmail.com','test subject','test body');
    }

	function Send_Mail($to,$subject,$body)
	{
		$from = "from@email.com";
		$mail = new PHPMailer();
		$mail->IsSMTP(true); // SMTP
		$mail->SMTPAuth   = true;  // SMTP authentication
		$mail->Mailer = "smtp";
		$mail->Host= "tls://email-smtp.us-east.amazonaws.com"; // Amazon SES
		$mail->Port = 465;  // SMTP Port
		$mail->Username = "Amazon SMTP Username";  // SMTP  Username
		$mail->Password = "Amazon SMTP Password";  // SMTP Password
		$mail->SetFrom($from, 'From Name');
		$mail->AddReplyTo($from,'9lessons Labs');
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$address = $to;
		$mail->AddAddress($address, $to);

		if(!$mail->Send())
		return false;
		else
		return true;

	}

    function smsglobal()
    {
    	$this->sms_global->to('628983818165');
		$this->sms_global->message('www.smsglobal.com');
		$this->sms_global->send();

		$id = $this->sms_global->get_sms_id(); // this is the sms id

		$this->sms_global->print_debugger(); // only use this to output the message details on screen 
    }

    function clockwork()
    {
    	$options = array( 'ssl' => false );
    	$API_KEY = '730b8bfb17ce54553c8d244500ff0b205a74e463';
		$clockwork = new Clockwork( $API_KEY, $options );
		$messages = array( 
		  array( 'to' => '628983818165', 'message' => 'http://www.clockworksms.com' ),
		);
		$results = $clockwork->send( $messages );

		echo $clockwork->checkCredit();

		echo json_encode($clockwork->checkBalance());
    }

    //Gets called by the submit-form
    public function submit() {

               //Load REcaptcha again.
                $this->load->library('recaptcha');

            //Check if anything is submitted at all
        if ($this->input->post('username') !== FALSE && $this->input->post('password') !== FALSE) 
        {
                  //Call to recaptcha to get the data validation set within the class. 
                    $this->recaptcha->recaptcha_check_answer();

                    //Store the username and password for easier access
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');



                    if ($username == "user" && $password == "password" && $this->recaptcha->getIsValid()) {

                        $this->session->set_userdata('logged_in','yes');
                        $this->session->set_userdata('user_id','test');

                        redirect('');
                    } else {
                        if(!$this->recaptcha->getIsValid()) {
                            $this->session->set_flashdata('error','incorrect captcha');
                        } else {
                            $this->session->set_flashdata('error','incorrect credentials');
                        }



                        redirect('login');
                    }

        } else { redirect(''); }
    }//.submit()


}