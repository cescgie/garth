<?php

class Portfolio extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'PORTFOLIO';
      $data['subtitle'] = 'PORTFOLIO';
      $data['menu_active'] = 'portfolio';
      //get all kategories
      $data['kategories'] = $this->_model->selectAll("kategories");
      //get all albums
      $data['albums'] = $this->_model->selectAll("albums");

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/portfolio/submenu', $data);
      if(SESSION::get('admin')){
        $this->_view->render('partials/portfolio/upload_form', $data);
      }
      $this->_view->render('partials/portfolio/index', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
   public function kategorie($name){
      $data['title'] = 'PORTFOLIO | '.strtoupper($name);
      $data['subtitle'] = 'PORTFOLIO | '.strtoupper($name);
      $data['menu_active'] = 'portfolio';
      $data['sub_menu_active'] = $name;
      $data['kategorie_name'] = $name;
      //get kategorie id
      $data['kategorie_id'] = $this->_model->selectOne("kategories","name",$name);
      $kategorie_id = $data['kategorie_id'][0]['id'];
      //get all albums from one kategorie
      $data['albums'] = $this->_model->selectOne("albums","kategorie_id",$kategorie_id);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/kategorie', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
   public function album(){
      $name = $_GET['album'];
      $kategorie = $_GET['kategorie'];
      $data['title'] = 'PORTFOLIO | '.strtoupper($kategorie).' | '.strtoupper($name);
      $data['subtitle'] = 'PORTFOLIO | '.strtoupper($kategorie).' | '.strtoupper($name);
      $data['menu_active'] = 'portfolio';
      $data['sub_menu_active'] = $kategorie;
      $data['album_name'] = $name;

      //get album id
      $data['album_id'] = $this->_model->selectOne("albums","name",$name);
      $album_id = $data['album_id'][0]['id'];

      //get all images from one album
      $data['images'] = $this->_model->selectOne("images","album_id",$album_id);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/album', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
  }
  public function upload(){
    if(isset($_POST['newalbum']) && $_POST['newalbum']=='on'){
      //create new album
      if(isset($_POST['new_album_name']) && $_POST['kategorie_name']!=""){
        $new_album_name = $_POST['new_album_name'];
        $kategorie_name = $_POST['kategorie_name'];
        //get kategorie id
        $data['kategorie_id'] = $this->_model->selectOne("kategories","name",$kategorie_name);
        $kategorie_id = $data['kategorie_id'][0]['id'];
      }else{
        Message::set("Please fill the form!","error");
        $this->index();
      }
    }else{
      //choose album
      if($_POST['album_name']!=''){
        $album_name=$_POST['album_name'];
        //get album id
        $data['album_id'] = $this->_model->selectOne("albums","name",$album_name);
        $album_id = $data['album_id'][0]['id'];
      }else{
        Message::set("Please fill the form!","error");
        $this->index();
      }
    }
    if(isset($_FILES["images"])){
      $filename = $_FILES["images"]["name"];
      for($i=0; $i<count($filename); $i++) {
        $tmpFilePath = $_FILES["images"]['tmp_name'][$i];
        if ($tmpFilePath != ""){
          $date = date('d-m-Y');
          $newfolder = getcwd()."/assets/collections/".$date;
          if(!is_dir($newfolder)){
            mkdir($newfolder, 0777, true);
            chmod($newfolder,0777);
          }
          $newFilePath = $newfolder ."/". $filename[$i];
          /*$upload = move_uploaded_file($tmpFilePath, $newFilePath);
          if($upload){
            echo "success uploaded";
          }else{
            echo "failed uploaded";
          }*/
        }
      }
    }else{
      echo "no images";
    }
  }
}
