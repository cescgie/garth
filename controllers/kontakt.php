<?php

class Kontakt extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'KONTAKT';
      $data['subtitle'] = 'KONTAKT';
      $data['menu_active'] = 'kontakt';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/kontakt', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
   public function send(){
     if(isset($_POST['name']) && $_POST['name']!=''
     && isset($_POST['email']) && $_POST['email']!=''
     && isset($_POST['textarea_kontakt']) && $_POST['textarea_kontakt']!=''){
        $to = 'y.firmanda@netpoint-media.de';
	      $email = $_POST['email'];
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $message = filter_var($_POST['textarea_kontakt'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $subject = "Email von ".$name." fuer astrid-garth.de";
        $headers = 'Von: '. $name. "\r\n" .
		    "Reply-To: " .$email. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        Message::set("Message sent to astrid-gath.de");
        $this->index();
     }else{
       Message::set("Bitte die Form ausfuellen!");
       $this->index();
     }
   }
}
