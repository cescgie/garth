<?php

class Vita extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'VITA';
      $data['subtitle'] = 'VITA';
      $data['menu_active'] = 'vita';

      $clause = "WHERE slug = 'vita1'";
      $data['vita1'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      $clause = "WHERE slug = 'vita2'";
      $data['vita2'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      $clause = "WHERE slug = 'vita3'";
      $data['vita3'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      //meta tag
      $description = 'Vita astrid-garth.de';
      $data['meta_keywords'] = SITETITLE.', vita, astrid-garth.de';
      $data['meta_description'] = $description;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/vita', $data);
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

   public function upload(){
     if(SESSION::get('admin')){
       if(isset($_FILES['image'])){
          $errors= array();
      		$file_name = $_FILES['image']['name'];
      		$file_size =$_FILES['image']['size'];
      		$file_tmp =$_FILES['image']['tmp_name'];
      		$file_type=$_FILES['image']['type'];
      		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      		$expensions= array("jpeg","jpg","png","pdf");
      		if(in_array($file_ext,$expensions)=== false){
      			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
      		}
      		if($file_size > 2097152){
      		$errors[]='File size must be excately 2 MB';
      		}
      		if(empty($errors)==true){
            $id = $_POST['id_content3'];

            $clause = "WHERE id = $id";
            $old_data = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);
            $old_data_picture = $old_data[0]['content'];
            if (file_exists($old_data_picture)) {
              unlink($old_data_picture);
            }

            $new_data_picture = "assets/vita/".$file_name;
      			move_uploaded_file($file_tmp,$new_data_picture);

            $data['content'] = $new_data_picture;
            $update = $this->_model->update("text",$data,"id=$id");

            return print_r("Success");
      		}else{
            return print_r("Error");
      		}
      	}else{
          return print_r("No File");
        }
      }
   }
}
