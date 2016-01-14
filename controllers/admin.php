<?php

class Admin extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
     $this->_view->render('error/404');
   }

   public function login(){
     if(!empty($_POST['username']) && !empty($_POST['password'])){
       $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
       $data["admin"] = $this->_model->check_admin("username",$username);
       if(!sizeof($data["admin"])){
         Message::set("There is no username with this value '".$_POST['username']."'","error");
         URL::REDIRECT("portfolio");
       }else{
         foreach ($data["admin"] as $key => $value) {
           $password = $_POST['password'];
           $hash_password = $value['password'];
           $username = $value['username'];
           if($value['state']==1){
             if(Password::validate($password,$hash_password)){
               Session::set("admin",$username);
               Message::set("Herzlich Wilkommen ".Session::get('admin')."!","success");
               URL::REDIRECT("portfolio");
             }else{
               Message::set("Password not matched","error");
               URL::REDIRECT("portfolio");
             }
           }else{
             Message::set("Your account hasn't been activated yet. Please activate your account by confirming our email.","info");
             URL::REDIRECT("portfolio");
           }
         }
       }
     }else{
       Message::set("Please fill the login form","error");
       URL::REDIRECT("portfolio");
     }
   }

   public function logout($value){
     if($value){
       $check = $this->_model->check("username",$value);
       if($check[0]['my_check']==1){
         Session::destroy($value);
         Message::set("You have logged out. See you again!","info");
       }else{
         Message::set("This account '".$value."' does not exist","error");
       }
     }else{
       Message::set("Please login first","info");
     }
     URL::REDIRECT("portfolio");
   }

   public function ag(){
     $data['title'] = 'ADMIN';
     $data['subtitle'] = 'ADMIN';
     if(!SESSION::get('admin')){
       $this->_view->render('header', $data);
       $this->_view->render('partials/partials_header', $data);
       $this->_view->render('admin/login', $data);
       $this->_view->render('partials/partials_footer', $data);
       $this->_view->render('footer', $data);
     }else{
       URL::REDIRECT("portfolio");
     }
   }
}
