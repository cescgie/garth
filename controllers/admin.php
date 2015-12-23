<?php

class Admin extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'ADMIN';
      $data['subtitle'] = 'ADMIN';
   }

   public function login(){
     if(!empty($_POST['username']) && !empty($_POST['password'])){
       $username = $_POST['username'];
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
               Message::set("Welcome back admin","success");
               Session::set("admin",$username);
               URL::REDIRECT("portfolio");
             }else{
               Message::set("Password not matched","info");
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
       URL::REDIRECT("portfolio");
     }else{
       Message::set("Please login first","info");
       URL::REDIRECT("portfolio");
     }
   }
}
