<?php

class Kontakt extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'KONTAKT';
      $data['subtitle'] = 'KONTAKT';
      $data['menu_active'] = 'kontakt';

      $clause = "WHERE slug = 'kontakt'";
      $data['kontakt'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      //meta tag
      $description = 'Kontakt astrid-garth.de';
      $data['meta_keywords'] = SITETITLE.', kontakt, astrid-garth.de';
      $data['meta_description'] = $description;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/kontakt', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }

   public function update(){
      $data['content'] = $_POST['content'];
      $id = $_POST['id'];
      if(SESSION::get('admin')){
        $update = $this->_model->update("text",$data,"id=$id");
      }
   }

   public function send(){
     if(isset($_POST['name']) && $_POST['name']!=''
     && isset($_POST['email']) && $_POST['email']!=''
     && isset($_POST['textarea_kontakt']) && $_POST['textarea_kontakt']!=''){
        $to = KONTAKT_EMAIL;
	    $email = $_POST['email'];
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $message = filter_var($_POST['textarea_kontakt'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $subject = "Email von ".$name." fuer sbrisny.de";
        $headers = 'Von: '. $name. "\r\n" .
		    "Reply-To: " .$email. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        Message::set("Message sent to sbrisny.de");
        $this->index();
     }else{
       Message::set("Bitte die Form ausfuellen!");
       $this->index();
     }
   }
}
