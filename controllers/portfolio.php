<?php

class Portfolio extends Controller {

   public function __construct() {
      parent::__construct();
   }
   /**
   * Show portfolio #index
   */
   public function index() {
      $data['title'] = 'PORTFOLIO';
      $data['subtitle'] = 'portfolio';
      $data['menu_active'] = 'portfolio';

      //get all kategories
      $orderby = 'ORDER BY reihenfolge';
      $data['kategories'] = $this->_model->selectClauseOrderBy("kategories",null,$orderby);

      //get all albums
      $data['albums'] = $this->_model->selectAll("albums");
      //meta tag
	    $data['meta_keywords'] = "Astrid Garth, Photoreport, Fotoreport, Kaiser - Friedrich - Ring 25, Wiesbaden.";

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
      if(SESSION::get('admin')){
        //$this->_view->render('partials/portfolio/upload_form', $data);
      }
      $this->_view->render('partials/portfolio/index', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
   /**
   * Show single #kategorie
   * @param $id
   */
   public function kategorie($slug){

      //get kategorie id
      $data['kategorie_id'] = $this->_model->selectOne("kategories","slug",$slug);
      $name = $data['kategorie_id'][0]['name'];
      $id = $data['kategorie_id'][0]['id'];
      $description = $data['kategorie_id'][0]['description'];

      $data['title'] = 'PORTFOLIO | '.strtoupper($name);
      $data['subtitle'] = 'portfolio';
      $data['kategorie_slug'] = $slug;
      $data['kategorie'] = str_replace('_',' ',$name);
      $data['menu_active'] = 'portfolio';
      //$data['sub_menu_active'] = $name;
      $data['kategorie_name'] = $name;

      //meta tag
      $data['meta_keywords'] = SITETITLE.','.$data['kategorie'];
      $data['meta_description'] = $data['kategorie'].', '.$description;

      //get kategorie id
      $data['kategorie_id'] = $this->_model->selectOne("kategories","name",$name);
      $kategorie_id = $data['kategorie_id'][0]['id'];
	    $data['cat_id'] = $kategorie_id;

      //get all albums from one kategorie
      $orderby = "ORDER BY reihenfolge";
      $where = "WHERE kategorie_id = $id";
      $data['albums'] = $this->_model->selectClauseOrderBy("albums",$where,$orderby,null);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/kategorie', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }

   /**
   * Show single #album
   * @param $id
   */
   public function album($slug){
      //get album id
      $album = $this->_model->selectOne("albums","slug",$slug);
      $album_id =$id= $album[0]['id'];
      $album_name = $album[0]['name'];
      $kategorie_id = $album[0]['kategorie_id'];
      $data['id_album'] = $album_id;
      $data['album_slug'] = $album[0]['slug'];
      $description = $album[0]['description'];

      $kategorie = $this->_model->selectOne("kategories","id",$kategorie_id);
      $kategorie_name = $kategorie[0]['name'];
      $data['id_kategorie'] = $kategorie_id;
      $data['kategorie_slug'] = $kategorie[0]['slug'];

      // $name = $_GET['album'];
      // $kategorie = $_GET['kategorie'];
      $data['title'] = 'PORTFOLIO | '.strtoupper(str_replace('_',' ',$kategorie_name)).' | '.str_replace('_',' ',strtoupper($album_name));
      $data['subtitle'] = 'portfolio';
      $data['kategorie'] = str_replace('_',' ',$kategorie_name);
      $data['album'] = str_replace('_',' ',$album_name);
      $data['menu_active'] = 'portfolio';
      //$data['sub_menu_active'] = $kategorie;
      $data['album_name'] = $album_name;

      //meta tag
      $data['meta_keywords'] = SITETITLE.', astrid-garth.de, '.strtolower($data['kategorie']).', '.strtolower($data['album']);
      $data['meta_description'] = $data['album'].', '.$description;

      //get album id
      $album = $this->_model->selectOne("albums","name",$album_name);
      $album_id = $album[0]['id'];
      $data['id_album'] = $album_id;

      //get all images from one album
      $orderby = "ORDER BY reihenfolge";
      $where = "WHERE album_id = $album_id";
      $data['images'] = $this->_model->selectClauseOrderBy("images",$where,$orderby,null);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/album', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }

   /**
   * Show single image #show
   */
   public function show(){
     $album_id = $_GET['album_id'];
     $reihenfolge = $_GET['reihenfolge'];
     $kategorie_id = $_GET['kategorie_id'];

     //get album's name
     $albums = $this->_model->selectOne("albums","id",$album_id);
     $album_name = $albums[0]['name'];
     $data['album'] = $album_name;

     //get kategorie's name
     $kategories = $this->_model->selectOne("kategories","id",$kategorie_id);
     $kategorie_name = $kategories[0]['name'];
     $data['kategorie'] = $kategorie_name;

     $data['title'] = 'PORTFOLIO | '.strtoupper($kategorie_name).' | '.strtoupper($album_name);
     $data['subtitle'] = 'portfolio';
     $data['kategorie_id'] = $kategorie_id;
     $data['album_id'] = $album_id;
     $data['menu_active'] = 'portfolio';
     //$data['sub_menu_active'] = $kategorie_name;
     $data['album_name'] = $album_name;
     $clause = "WHERE album_id = $album_id";
     $data['count_images'] = $this->_model->count("images", $clause);
     $total = $data['count_images'][0]['total'];
     $data['first_image'] = $this->_model->selectRow("images","album_id",$album_id,"reihenfolge","ASC",1);
     $first_image = $data['first_image'][0]['reihenfolge'];

     //if reihenfolge as much as toal image, means the last images in row but total image not 1
     if($reihenfolge == $total && $total != 1 ){
       $next_id = $first_image;
       $prev_id = $total - 1;
     //if reihenfolge same with first image and total images is not 1, means the first image in a row
     }elseif($reihenfolge == $first_image && $total != 1){
       $next_id = $first_image + 1;
       $prev_id = $total;
     //if reihenfolge same with total imags and total image is only 1, means the only one image in album
     }elseif($reihenfolge == $total && $total == 1){
       $next_id = 1;
       $prev_id = 1;
     }else{
       $next_id = $reihenfolge + 1;
       $prev_id = $reihenfolge - 1;
     }

     $data['next_photo_id'] = $next_id;
     $data['prev_photo_id'] = $prev_id;

     //get selected image
     $data['show_foto'] = $this->_model->selectOne3Clauses("images","album_id",$album_id,"kategorie_id",$kategorie_id,"reihenfolge",$reihenfolge);
     $foto_name = $data['show_foto'][0]['name'];
     $data['foto_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $foto_name);
     //get keywords
     $data['keywords'] = $data['show_foto'][0]['keywords'];

     //meta tag
     $data['meta_keywords'] = SITETITLE.','.$data['kategorie'].','.$data['album'].','.$data['foto_name'].','.$data['keywords'];

     $this->_view->render('header', $data);
     $this->_view->render('partials/partials_header', $data);
     //$this->_view->render('partials/portfolio/submenu', $data);
     $this->_view->render('partials/portfolio/image', $data);
     $this->_view->render('partials/partials_footer', $data);
     $this->_view->render('footer');
   }
  /**
    * #Image Functions :
    * 1. upload
    * 2. insert
    * 3. delete
    * 4. edit
    */
    #upload
    public function upload(){
      if(SESSION::get('admin')){
        if(isset($_POST['newalbum']) && $_POST['newalbum']=='on'){
          //create new album
          if(isset($_POST['new_album_name']) && $_POST['new_album_name'] != ''){
            $new_album_name = filter_var($_POST['new_album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $new_album_name = $new_album_name;

            //album name for create new album
            $create['name'] = $new_album_name;
          }else{
            Message::set("Geben Sie bitte einen Name f&uumlr die neue Kategorie","error");
            URL::REDIRECT("portfolio");
          }
          if($_POST['kategorie_name'] != ''){
            $kategorie_name = filter_var($_POST['kategorie_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            //get kategorie id
            $kategorie = $this->_model->selectOne("kategories","name",$kategorie_name);
            $kategorie_id = $kategorie[0]['id'];

            //kategorie id for upload new image(s)
            $upload['kategorie_id'] = $kategorie_id;

            //kategorie id for create new album
            $create['kategorie_id'] = $kategorie_id;
          }else{
            Message::set("Bitte eine Oberkategorie ausw&aumlhlen","error");
            URL::REDIRECT("portfolio");
          }
          //check if album already exists
          $check = $this->_model->check_exist("albums","name",$new_album_name);
          if($check[0]['count'] != 1){

            //create new album
            $create_new_album = $this->_model->create("albums",$create);

            //get new album id
            $album = $this->_model->selectOne("albums","name",$new_album_name);
            $album_id = $album[0]['id'];

            //album id for upload new image(s)
            $upload['album_id'] = $album_id;
          }
        }else{
          //choose album
          if($_POST['album_name']!=''){
            $album_name = filter_var($_POST['album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            //get album id
            $album = $this->_model->selectOne("albums","name",$album_name);
            $album_id = $album[0]['id'];

            //album id for upload new image(s)
            $upload['album_id'] = $album_id;

            //get kategorie_id
            $kategorie = $this->_model->selectOne("albums","name",$album_name);
            $kategorie_id = $kategorie[0]['kategorie_id'];

            //kategorie id for upload new image(s)
            $upload['kategorie_id'] = $kategorie_id;
          }else{
            Message::set("Bitte eine Kategorie ausw&aumlhlen","error");
            URL::REDIRECT("portfolio");
          }
        }

        if (!empty($_FILES)) {
          $total_upload = count($_FILES["images"]["name"]);
          $alb = $upload['album_id'];
          $clause = "WHERE album_id = $alb";
          $count_current_in_album = $this->_model->count("images",$clause);
          $total_current_in_album = $count_current_in_album[0]['total'];

          for($i=0; $i<count($_FILES["images"]["name"]); $i++) {
            $next_reihenfolge = $total_current_in_album + $i + 1;
            $tmpFilePath = $_FILES["images"]['tmp_name'];
            //$upload['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES["images"]["name"][$i]);

            if ($tmpFilePath != ""){
              $date = date('d-m-Y');
              $newfolder = getcwd()."/assets/collections/".$date;
              if(!is_dir($newfolder)){
                mkdir($newfolder, 0777, true);
                chmod($newfolder,0777);
              }
        $newfolderCover = getcwd()."/assets/collections/".$date."/cover";
              if(!is_dir($newfolderCover)){
                mkdir($newfolderCover, 0777, true);
                chmod($newfolderCover,0777);
              }
              $size = $_FILES["images"]["size"][$i];
              $newFilePath = 'assets/collections/'.$date.'/'.$_FILES["images"]["name"][$i];
              $newFilePathCover = "assets/collections/".$date."/cover/".$_FILES["images"]["name"][$i];
              $foto_name = $_FILES["images"]["name"][$i];
              $upload['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $foto_name);
              $uploads = move_uploaded_file($tmpFilePath[$i], $newFilePath);
              //insert to database
              $save = $this->insert($_FILES["images"]["name"][$i],$newFilePath,$newFilePathCover,$upload['album_id'],$upload['kategorie_id'],$upload['title'],$size, $next_reihenfolge);
              //resize file
              $file = $newFilePath;
              //indicate the path and name for the new resized file
              $resizedFile = $newFilePathCover;
              //call the function (when passing path to pic)
              //$img = $this->smart_resize_image($file , null, '230' , '150' , false , $resizedFile , false , false ,100 );
              $img = $this->compress($file , $resizedFile , 50 );
              if($uploads){
                Message::set("Upload success",'success');
              }else{
                Message::set("Upload fail",'error');
              }
            }else{
              Message::set('W&aumlhlen Sie mindestens ein Bild aus','error');
            }
          }
          URL::REDIRECT("portfolio");
        }
      }else{
        Message::set("You don't have authorization to use this function",'error');
        URL::REDIRECT("portfolio");
      }
   }

   #insert
   public function insert($filename,$newFilePath,$newFilePathCover,$album_id,$kategorie_id,$title,$size,$bild_form,$reihenfolge){
     $image['reihenfolge'] = $reihenfolge;
     $image['name'] = $filename;
     $image['title'] = $title;
     $image['path'] = $newFilePath;
     $image['cover'] = $newFilePathCover;
     $image['album_id'] = $album_id;
     $image['kategorie_id'] = $kategorie_id;
     $image['size'] = $size;
     $image['bild_form'] = $bild_form;
     $image['created_at'] = date("Y-m-d H:i:s");
     if(SESSION::get('admin')){
       //save to database
       $save = $this->_model->create("images",$image);
     }
     return $save;
   }

   #delete
   public function delete(){
     $id = $_POST['id'];
     $album_id = $_POST['album_id'];
     $image = $this->_model->selectOne("images","id",$id);
     $image_to_delete_reihenfolge = $image[0]['reihenfolge'];
     $images = $this->_model->selectOne("images","album_id",$album_id);

     if(SESSION::get('admin')){
       //update reihenfolge
       foreach ($images as $keys => $val) {
            if ($val['reihenfolge']>$image_to_delete_reihenfolge) {
              $new_reihenfolge = $val['reihenfolge']-1;
            }else{
              $new_reihenfolge = $val['reihenfolge'];
            }
            $ids = $val['id'];
            $datas['reihenfolge']=$new_reihenfolge;
            $this->_model->update("images",$datas,"id=$ids");
       }

       $delete = $this->_model->delete("images","id=$id");
       if (file_exists($image[0]['path'])) {
         unlink($image[0]['path']);
       }
       if (file_exists($image[0]['cover'])) {
         unlink($image[0]['cover']);
       }
     }
     echo json_encode($images);
   }
   #edit
   public function edit(){
     $edit['id'] = $_POST['id'];
     $edit['title'] = str_replace(' ','_',$_POST['title']);
     $edit['keywords'] = filter_var($_POST['keywords'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
     $edit['edited_at'] = date("Y-m-d H:i:s");
     $edit['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

     if(SESSION::get('admin')){
       $id = $_POST['id'];
       $this->_model->update("images",$edit,"id=$id");
     }
     echo json_encode($edit);
   }


    /**
    * #Kategorie
    * Function:
    * 1. createKategorie
    * 2. editKategorie
    * 3. deleteKategorie
    */
    #createKategorie
    public function createKategorie($cat_id){
      $name = filter_var($_POST['new_album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
      $create['name'] = $name;
      $create['kategorie_id'] = $cat_id;

      $clause = "WHERE kategorie_id = $cat_id";
      $count_current_album_in_kategorie = $this->_model->count("albums", $clause);
      $total_current_album_in_kategorie = $count_current_album_in_kategorie[0]['total'];

      $create['reihenfolge'] = $total_current_album_in_kategorie+1;

      $ober_kategorie_name = $_POST['ober_kategorie_name'];

      //slug
      $slugname = $this->toASCII($_POST['new_album_name']);
      $slugname = trim(str_replace(str_split('\\/:*?"<>|,.#'), ' ', $slugname));
      $slug = str_replace('--','-',str_replace(' ','-',strtolower($slugname)));
      //check if slug kategorie already exists
      $check = $this->_model->check_exist("albums","slug",$slug);
      if($check[0]['count'] == 1){
        $create['slug'] = $slug.'s';
      }else{
        $create['slug'] = $slug;
      }

      if(SESSION::get('admin')){
        $save = $this->_model->create("albums",$create);
      }
      Message::set('Neue Kategorie erstellt!','success');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    #editKategorie
    public function editKategorie($id){
      $edit['id'] = $id;
      //get info from one kategorie
      $kategorie = $this->_model->selectOne("albums","id",$id);
      //get oberkategorie
      $oberkategorie_id = $kategorie[0]['kategorie_id'];
      $oberkategorie =$this->_model->selectOne("kategories","id",$oberkategorie_id);
      if(SESSION::get('admin')){
        //set name
        if(isset($_POST['name']) && $_POST['name']!=''){
  		    // $name= filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
          $edit['name'] = $_POST['name'];
        }else{
          $edit['name'] = $kategorie[0]['name'];
        }

        $edit['description']  = filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        //set cover
        if(isset($_POST['newcover'.$id]) && $_POST['newcover'.$id]=='on'){
          if(!empty($_FILES['kategorie_cover'.$id]['name'])){
            $nama = $_FILES['kategorie_cover'.$id]['name'];
            //get file extention
            $ext = pathinfo($nama, PATHINFO_EXTENSION);
            //temporary path
            $tmp_name = $_FILES['kategorie_cover'.$id]['tmp_name'];
  		  //rename file with date
            $file_name = $oberkategorie[0]['name'].'_'.$kategorie[0]['name'].'_'.date("Y-m-d_H:i:s").'.'.$ext;
  		  //path for new file
            $newFilePath = 'assets/kategorie/'.$file_name;
            $edit['image'] = $newFilePath;
            $edit['updated_at'] = date("Y-m-d H:i:s");
            //remove old image from path
            if (file_exists($kategorie[0]['image'])) {
              unlink($kategorie[0]['image']);
            }
            //upload new image to path
            $uploads = move_uploaded_file($tmp_name, $newFilePath);
  		      //resize file
            $file = $newFilePath;
            //indicate the path and name for the new resized file
            $resizedFile = $newFilePath;
            $size = $_FILES['kategorie_cover'.$id]['size'];

  	        list($width, $height) = getimagesize($newFilePath);

            $ratio = $width/$height;

            if($width>2500 || $height>2500){
              $convertpercentage = 0.10;
            }else{
              $convertpercentage = 0.30;
            }

            $tenpercentwidth = $convertpercentage * $width;
            $tenpercentheight = $convertpercentage * $height;
            $target_width = $tenpercentheight * $ratio;
            $target_height = $tenpercentwidth / $ratio;

  		      if($width<$height){
                $edit['image_form'] = 1;
            }else{
                $edit['image_form'] = 2;
            }

            //call the function (when passing path to pic)
            $img = $this->smart_resize_image($file , null, $target_width , $target_height , false , $resizedFile , false , false ,100 );

  	 	 //$img = $this->compress($file , $resizedFile , $convert_percentage );
          }else{
            //"no image";
            $edit['image'] = $kategorie[0]['image'];
          }
        }else{
          $edit['image'] = $kategorie[0]['image'];
        }
        //update database
        $this->_model->update("albums",$edit,"id=$id");
        Message::set('Kategorie aktualisiert!','success');
      }else{
        Message::set('Sie haben kein Recht!','info');
      }
      URL::REDIRECT("portfolio/kategorie/".$oberkategorie[0]['slug']);
    }

    #deleteKategorie
    public function deleteKategorie($id){
      $album_id = $id;
      $image = $this->_model->selectOne("images","album_id",$album_id);
      $kategorie = $this->_model->selectOne("albums","id",$album_id);
      if(SESSION::get('admin')){
        if (file_exists($kategorie[0]['image'])) {
          unlink($kategorie[0]['image']);
        }
        foreach ($image as $key => $value) {
          if (file_exists($value['path'])) {
            $unlink1 = unlink($value['path']);
          }
          if (file_exists($value['cover'])) {
            $unlink2 = unlink($value['cover']);
          }
          if($unlink1 || $unlink2){
            $delete = $this->_model->delete("images","id='".$value['id']."'");
          }
        }
        $album = $this->_model->delete("albums","id=$album_id");
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
    * #OberKategorie
    * Functions:
    * 1. createOberKategorie
    * 2. editOberKategorie
    * 3. deleteOberKategorie
    */
   #createOberkategorie
   public function createOberkategorie(){
      $name = filter_var($_POST['ober_kategorie_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
      $create['name'] = $name;

      //reihenfolde
      $count_current_in_kategorie = $this->_model->count("kategories",null);
      $total_current_in_kategorie = $count_current_in_kategorie[0]['total'];
      $create['reihenfolge'] = $total_current_in_kategorie+1;
      //slug
      $slugname = $this->toASCII($_POST['ober_kategorie_name']);
      $slugname = trim(str_replace(str_split('\\/:*?"<>|,.#'), ' ', $slugname));
      $slug = str_replace('--','-',str_replace(' ','-',strtolower($slugname)));
      //check if slugkategorie already exists
      $check = $this->_model->check_exist("kategories","slug",$slug);
      if($check[0]['count'] == 1){
        $create['slug'] = $slug.'s';
      }else{
        $create['slug'] = $slug;
      }

      if(SESSION::get('admin')){
        $save = $this->_model->create("kategories",$create);
      }
      Message::set("Neue Oberkategorie '$name' erstellt!",'success');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   #editOberkategorie
   public function editOberkategorie($id){
     $edit['id'] = $id;

     //get info from one kategorie
     // $kategorie = $this->_model->selectOne("albums","id",$id);
     //get oberkategorie
     $oberkategorie =$this->_model->selectOne("kategories","id",$id);
     $oberkategorie_id = $kategorie[0]['kategorie_id'];
     if(SESSION::get('admin')){
       //set name
       if(isset($_POST['name']) && $_POST['name']!=''){
 		    //$name= filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
         $edit['name'] = $_POST['name'];
       }else{
         $edit['name'] = $oberkategorie[0]['name'];
       }
       $edit['description']  = filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

       //set cover
       if(isset($_POST['newcover'.$id]) && $_POST['newcover'.$id]=='on'){
         if(!empty($_FILES['Oberkategorie_cover'.$id]['name'])){
           $nama = $_FILES['Oberkategorie_cover'.$id]['name'];
           //get file extention
           $ext = pathinfo($nama, PATHINFO_EXTENSION);
           //temporary path
           $tmp_name = $_FILES['Oberkategorie_cover'.$id]['tmp_name'];
 		  //rename file with date
           $file_name = $oberkategorie[0]['name'].'_'.date("Y-m-d_H:i:s").'.'.$ext;
 		  //path for new file
           $newFilePath = 'assets/oberkategorie/'.$file_name;
           $edit['image'] = $newFilePath;
           $edit['updated_at'] = date("Y-m-d H:i:s");
           //remove old image from path
           if (file_exists($oberkategorie[0]['image'])) {
             unlink($oberkategorie[0]['image']);
           }
           //upload new image to path
           $uploads = move_uploaded_file($tmp_name, $newFilePath);
 		      //resize file
           $file = $newFilePath;
           //indicate the path and name for the new resized file
           $resizedFile = $newFilePath;
           $size = $_FILES['Oberkategorie_cover'.$id]['size'];
 	        list($width, $height) = getimagesize($newFilePath);

           $ratio = $width/$height;

           if($width>2500 || $height>2500){
             $convertpercentage = 0.10;
           }else{
             $convertpercentage = 0.30;
           }

           $tenpercentwidth = $convertpercentage * $width;
           $tenpercentheight = $convertpercentage * $height;
           $target_width = $tenpercentheight * $ratio;
           $target_height = $tenpercentwidth / $ratio;

 		      if($width<$height){
               $edit['image_form'] = 1;
           }else{
               $edit['image_form'] = 2;
           }

           //call the function (when passing path to pic)
           $img = $this->smart_resize_image($file , null, $target_width , $target_height , false , $resizedFile , false , false ,100 );

         }else{
           //"no image";
           $edit['image'] = $oberkategorie[0]['image'];
         }
       }else{
         $edit['image'] = $oberkategorie[0]['image'];
       }
       //update database
       $this->_model->update("kategories",$edit,"id=$id");
       Message::set('Oberkategorie aktualisiert!','success');
     }else{
       Message::set('Sie haben kein Recht!','info');
     }
     URL::REDIRECT("portfolio");
   }

   #deleteOberkategorie
   public function deleteOberkategorie($id){
       $kategorie_id = $id;
       $oberkategorie = $this->_model->selectOne("kategories","id",$kategorie_id);
       $kategorie_to_delete_reihenfolge = $oberkategorie[0]["reihenfolge"];
       $image = $this->_model->selectOne("images","kategorie_id",$kategorie_id);
       $kategorie = $this->_model->selectOne("albums","kategorie_id",$kategorie_id);
       $kats = $this->_model->selectAll("kategories");
       if(SESSION::get('admin')){
         //update reihenfolge
         foreach ($kats as $keys => $val) {
              if ($val['reihenfolge']>$kategorie_to_delete_reihenfolge) {
                $new_reihenfolge = $val['reihenfolge']-1;
              }else{
                $new_reihenfolge = $val['reihenfolge'];
              }
              $ids = $val['id'];
              $datas['reihenfolge']=$new_reihenfolge;
              $this->_model->update("kategories",$datas,"id=$ids");
         }

         foreach ($kategorie as $key => $value1) {
           if (file_exists($value1['image'])) {
             unlink($value1['image']);
           }
           $album_id = $value1['id'];
           $this->_model->delete("albums","id=$album_id");
         }
         foreach ($image as $key => $value2) {
           if (file_exists($value2['path'])) {
             $unlink1 = unlink($value2['path']);
           }
           if (file_exists($value2['cover'])) {
             $unlink2 = unlink($value2['cover']);
           }
           if($unlink1 || $unlink2){
             $delete = $this->_model->delete("images","id='".$value2['id']."'");
           }
         }
         if (file_exists($oberkategorie[0]['image'])) {
           unlink($oberkategorie[0]['image']);
         }
         $album = $this->_model->delete("kategories","id=$kategorie_id");
       }
       $oberkategorie_name = $oberkategorie[0]['name'];
       Message::set("Oberkategorie '$oberkategorie_name' gelöscht!",'success');
       header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   /*
    * Extra Functions
    * 1. update_reihenfolge (general)
    * 2. shows (inaktiv)
    * 3. uploadBilder
    * 4. smart_resize_image
    * 5. compress
    * 6. toASCII
    */

    #update_reihenfolge
    public function update_reihenfolge(){
      $id = $_POST['id'];
      $table = $_POST['table'];
      $reihen['reihenfolge'] = $_POST['reihenfolge'];
      if(SESSION::get('admin')){
        $this->_model->update($table,$reihen,"id=$id");
      }
    }

    #shows
    public function shows(){
      $album_id = $_POST['album_id'];
      $kategorie_id = $_POST['kategorie_id'];

      $shows = $this->_model->selectOne2Clauses("images","album_id",$album_id,"kategorie_id",$kategorie_id);

      echo json_encode($shows);
    }

    #uploadBilder
  public function uploadBilder(){
    if(SESSION::get('admin')){
      $album_id = $_POST['album_id'];
      $data['albums'] = $this->_model->selectOne("albums","id",$album_id);
      $album_name = $data['albums'][0]['name'];
      $album_slug = $data['albums'][0]['slug'];
      $kategorie_id = $data['albums'][0]['kategorie_id'];

      $upload['kategorie_id'] = $kategorie_id ;
      $upload['album_id'] = $album_id;

      $kategorie = $this->_model->selectOne("kategories","id",$kategorie_id);
      $kategorie_name = $kategorie[0]['name'];
      $kategorie_slug = $kategorie[0]['slug'];

      if (!empty($_FILES)) {
        $total_upload = count($_FILES["images"]["name"]);
        $clause = "WHERE album_id =$album_id";
        $count_current_in_album = $this->_model->count("images",$clause);
        $total_current_in_album = $count_current_in_album[0]['total'];

        for($i=0; $i<count($_FILES["images"]["name"]); $i++) {
          $next_reihenfolge = $total_current_in_album + $i + 1;
          $tmpFilePath = $_FILES["images"]['tmp_name'];
          //$upload['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES["images"]["name"][$i]);

          if ($tmpFilePath != ""){
            $date = date('Y-m-d');
            $newfolder = getcwd()."/assets/collections/".$kategorie_slug."/".$album_slug;
            if(!is_dir($newfolder)){
              mkdir($newfolder, 0777, true);
              chmod($newfolder,0777);
            }
            $newfolderCover = getcwd()."/assets/collections/".$kategorie_slug."/".$album_slug."/cover";
            if(!is_dir($newfolderCover)){
              mkdir($newfolderCover, 0777, true);
              chmod($newfolderCover,0777);
            }
            $size = $_FILES["images"]["size"][$i];
            $newFile = $_FILES["images"]["name"][$i];
            $newFilePath = 'assets/collections/'.$kategorie_slug."/".$album_slug.'/'.$newFile;
            $newFilePathCover = "assets/collections/".$kategorie_slug."/".$album_slug."/cover/".$newFile;
            $foto_name = $_FILES["images"]["name"][$i];
            //$upload['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $foto_name);
            $upload['title'] = NULL;

            $uploads = move_uploaded_file($tmpFilePath[$i], $newFilePath);

		        list($width, $height) = getimagesize($newFilePath);
            $ratio = $width/$height;

            if($width>2500 || $height>2500){
              $convertpercentage = 0.10;
            }else{
              $convertpercentage = 0.30;
            }

            $tenpercentwidth = $convertpercentage * $width;
            $tenpercentheight = $convertpercentage * $height;
            $target_width = $tenpercentheight * $ratio;
            $target_height = $tenpercentwidth / $ratio;

            if($width<$height){
              $bild_form = 1;
            }else{
              $bild_form = 2;
            }

			      //insert to database
            $save = $this->insert($_FILES["images"]["name"][$i],$newFilePath,$newFilePathCover,$upload['album_id'],$upload['kategorie_id'],$upload['title'],$size,$bild_form, $next_reihenfolge);

            //resize file
            $file = $newFilePath;

            //indicate the path and name for the new resized file
            $resizedFile = $newFilePathCover;

            //call the function (when passing path to pic)
            $img = $this->smart_resize_image($file , null, $target_width , $target_height , false , $resizedFile , false , false ,100 );
            //$img = $this->compress($file , $resizedFile , $convert_percentage );
            if($img){
              Message::set("Upload success",'success');
            }else{
              Message::set("Upload fail",'error');
            }
          }else{
            Message::set('Please choose at least one image to upload','error');
          }
        }
      }else{
        Message::set("Upload fail",'error');
      }
    }else{
      Message::set("Do not have authorization",'error');
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  #compress
  public function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
  }

  #smart_resize_image
  public function smart_resize_image($file,
                              $string             = null,
                              $width              = 0,
                              $height             = 0,
                              $proportional       = false,
                              $output             = 'file',
                              $delete_original    = true,
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {

    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;

    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;

	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }

    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }


    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);

      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }

    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }

    return true;
  }

  function toASCII( $str )
  {
    return strtr(utf8_decode($str),
            utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
            'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
  }
}
