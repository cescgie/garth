<?php

class Portfolio extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'PORTFOLIO';
      $data['subtitle'] = 'portfolio';
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
      $data['subtitle'] = 'portfolio';
      $data['kategorie'] = $name;
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
      $data['subtitle'] = 'portfolio';
      $data['kategorie'] = $kategorie;
      $data['album'] = $name;
      $data['menu_active'] = 'portfolio';
      $data['sub_menu_active'] = $kategorie;
      $data['album_name'] = $name;

      //get all images from one album
      $data['images'] = $this->_model->selectOne("images","album",$name);

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
      if(isset($_POST['new_album_name']) && $_POST['new_album_name'] != ''){
        $new_album_name = filter_var($_POST['new_album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $new_album_name = strtolower($new_album_name);
        $album['name'] = $new_album_name;
      }else{
        Message::set("Please choose a name for new album!","error");
        URL::REDIRECT("portfolio");
      }
      if($_POST['kategorie_name'] != ''){
        $kategorie_name = filter_var($_POST['kategorie_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        //get kategorie id
        $data['kategorie_id'] = $this->_model->selectOne("kategories","name",$kategorie_name);
        $kategorie_id = $data['kategorie_id'][0]['id'];
        $album['kategorie_id'] = $kategorie_id;
      }else{
        Message::set("Please choose a kategorie!","error");
        URL::REDIRECT("portfolio");
      }
      $check = $this->_model->check_exist("albums","name",$new_album_name);
      if($check[0]['count'] != 1){
        $create_new_album = $this->_model->create("albums",$album);
      }
      $data['album'] = $new_album_name;
      $data['kategorie']=$kategorie_name;
    }else{
      //choose album
      if($_POST['album_name']!=''){
        $album_name = filter_var($_POST['album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $data['album']=$album_name;
        //get kategorie_id
        $album = $this->_model->selectOne("albums","name",$album_name);
        $kategorie_id = $album[0]['kategorie_id'];
        //get kategorie name
        $kategorie = $this->_model->selectOne("kategories","id",$kategorie_id);
        $data['kategorie'] = $kategorie[0]['name'];
      }else{
        Message::set("Please chosse an album!","error");
        URL::REDIRECT("portfolio");
      }
    }

    if (!empty($_FILES)) {
      $total_upload = count($_FILES["images"]["name"]);
      $count_current_in_album = $this->_model->count("images",'album',$data['album']);
      $total_current_in_album = $count_current_in_album[0]['total'];

      //echo rand($total_current_in_album + 1, $total_current_in_album + $total_upload);
      for($i=0; $i<count($_FILES["images"]["name"]); $i++) {
        $next_reihenfolge = $total_current_in_album + $i + 1;
        $tmpFilePath = $_FILES["images"]['tmp_name'];
        if ($tmpFilePath != ""){
          $date = date('d-m-Y');
          $newfolder = getcwd()."/assets/collections/".$date;
          if(!is_dir($newfolder)){
            mkdir($newfolder, 0777, true);
            chmod($newfolder,0777);
          }
          $size = $_FILES["images"]["size"][$i];
          $newFilePath = $newfolder ."/". $_FILES["images"]["name"][$i];
          $upload = move_uploaded_file($tmpFilePath[$i], $newFilePath);
          $save = $this->insert($_FILES["images"]["name"][$i],$newFilePath,$data['album'],$data['kategorie'],$size, $next_reihenfolge);
          if($upload){
            Message::set("Upload success",'success');
          }else{
            Message::set("Upload fail",'error');
          }
        }else{
          Message::set('Please choose at least one image to upload','error');
        }
      }
      URL::REDIRECT("portfolio");
    }
  }

  public function insert($filename,$newFilePath,$album,$kategorie,$size,$reihenfolge){
    $image['reihenfolge'] = $reihenfolge;
    $image['name'] = $filename;
    $image['path'] = $newFilePath;
    $image['album'] = $album;
    $image['kategorie'] = $kategorie;
    $image['size'] = $size;
    $image['created_at'] = date("Y-m-d H:i:s");
    //save to database
    $save = $this->_model->create("images",$image);
    return $save;
  }

  public function show(){
    $album = $_GET['album'];
    $reihenfolge = $_GET['reihenfolge'];
    $kategorie = $_GET['kategorie'];
    $data['title'] = 'PORTFOLIO | '.strtoupper($kategorie).' | '.strtoupper($name);
    $data['subtitle'] = 'portfolio';
    $data['kategorie'] = $kategorie;
    $data['album'] = $album;
    $data['menu_active'] = 'portfolio';
    $data['sub_menu_active'] = $kategorie;
    $data['album_name'] = $album;

    $data['count_images'] = $this->_model->count("images",'album',$album);
    $total = $data['count_images'][0]['total'];
    $data['first_image'] = $this->_model->selectRow("images","album",$album,"reihenfolge","ASC",1);
    $first_image = $data['first_image'][0]['reihenfolge'];

    if($reihenfolge == $total && $total != 1 ){
      $next_id = $first_image;
      $prev_id = $total - 1;
    }elseif($reihenfolge == $first_image && $total != 1){
      $next_id = $first_image + 1;
      $prev_id = $total;
    }elseif($reihenfolge == $total && $total == 1){
      $next_id = 1;
      $prev_id = 1;
    }else{
      $next_id = $reihenfolge + 1;
      $prev_id = $reihenfolge - 1;
    }

    $data['next_photo_id'] = $next_id;
    $data['prev_photo_id'] = $prev_id;

    $data['show_foto'] = $this->_model->selectOne3Clauses("images","album",$album,"kategorie",$kategorie,"reihenfolge",$reihenfolge);
    $foto_name = $data['show_foto'][0]['name'];
    $data['foto_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $foto_name);

    $this->_view->render('header', $data);
    $this->_view->render('partials/partials_header', $data);
    $this->_view->render('partials/portfolio/submenu', $data);
    $this->_view->render('partials/portfolio/image', $data);
    $this->_view->render('partials/partials_footer', $data);
    $this->_view->render('footer');
  }
}
