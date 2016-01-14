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
      //meta tag
      $data['meta'] = SITETITLE;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
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
      //$data['sub_menu_active'] = $name;
      $data['kategorie_name'] = $name;

      //meta tag
      $data['meta'] = SITETITLE.','.$data['kategorie'];

      //get kategorie id
      $data['kategorie_id'] = $this->_model->selectOne("kategories","name",$name);
      $kategorie_id = $data['kategorie_id'][0]['id'];

      //get all albums from one kategorie
      $data['albums'] = $this->_model->selectOne("albums","kategorie_id",$kategorie_id);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
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
      //$data['sub_menu_active'] = $kategorie;
      $data['album_name'] = $name;

      //meta tag
      $data['meta'] = SITETITLE.','.$data['kategorie'].','.$data['album'];

      //get album id
      $album = $this->_model->selectOne("albums","name",$name);
      $album_id = $album[0]['id'];

      //get all images from one album
      $data['images'] = $this->_model->selectOneRei("images","album_id",$album_id);

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      //$this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/album', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
  }

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

    $data['count_images'] = $this->_model->count("images",'album_id',$album_id);
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
    $data['meta'] = SITETITLE.','.$data['kategorie'].','.$data['album'].','.$data['foto_name'].','.$data['keywords'];

    $this->_view->render('header', $data);
    $this->_view->render('partials/partials_header', $data);
    //$this->_view->render('partials/portfolio/submenu', $data);
    $this->_view->render('partials/portfolio/image', $data);
    $this->_view->render('partials/partials_footer', $data);
    $this->_view->render('footer');
  }

  public function upload(){
    if(SESSION::get('admin')){
      if(isset($_POST['newalbum']) && $_POST['newalbum']=='on'){
        //create new album
        if(isset($_POST['new_album_name']) && $_POST['new_album_name'] != ''){
          $new_album_name = filter_var($_POST['new_album_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
          $new_album_name = strtolower($new_album_name);

          //album name for create new album
          $create['name'] = $new_album_name;
        }else{
          Message::set("Please choose a name for new album!","error");
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
          Message::set("Please choose a kategorie!","error");
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
          Message::set("Please chosse an album!","error");
          URL::REDIRECT("portfolio");
        }
      }

      if (!empty($_FILES)) {
        $total_upload = count($_FILES["images"]["name"]);
        $count_current_in_album = $this->_model->count("images",'album_id',$upload['album_id']);
        $total_current_in_album = $count_current_in_album[0]['total'];

        for($i=0; $i<count($_FILES["images"]["name"]); $i++) {
          $next_reihenfolge = $total_current_in_album + $i + 1;
          $tmpFilePath = $_FILES["images"]['tmp_name'];
          //$upload['title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES["images"]["name"][$i]);

          if ($tmpFilePath != ""){
            $date = date('Y-m-d');
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
            $img = $this->smart_resize_image($file , null, '230' , '150' , false , $resizedFile , false , false ,100 );
            if($img){
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
    }else{
      Message::set("You don't have authorization to use this function",'error');
      URL::REDIRECT("portfolio");
    }
  }

  public function insert($filename,$newFilePath,$newFilePathCover,$album_id,$kategorie_id,$title,$size,$reihenfolge){
    $image['reihenfolge'] = $reihenfolge;
    $image['name'] = $filename;
    $image['title'] = $title;
    $image['path'] = $newFilePath;
    $image['cover'] = $newFilePathCover;
    $image['album_id'] = $album_id;
    $image['kategorie_id'] = $kategorie_id;
    $image['size'] = $size;
    $image['created_at'] = date("Y-m-d H:i:s");
    //save to database
    $save = $this->_model->create("images",$image);
    return $save;
  }

  public function delete(){
    $id = $_POST['id'];
    $album_id = $_POST['album_id'];
    $image = $this->_model->selectOne("images","id",$id);

    if(SESSION::get('admin')){
      $delete = $this->_model->delete("images","id=$id");
      unlink($image[0]['path']);

      //get all images from one album
      $images = $this->_model->selectOne("images","album_id",$album_id);
      $i = 1;
      foreach ($images as $key => $value) {
        #update reihenfolge
        $data['reihenfolge'] = $i;
        $id = $value['id'];
        $this->_model->update("images",$data,"id=$id");
        $i++;
      }
    }
    echo json_encode($images);
  }

  public function edit(){
    $edit['id'] = $_POST['id'];
    $edit['title'] = $_POST['title'];
    $edit['keywords'] = filter_var($_POST['keywords'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $edit['edited_at'] = date("Y-m-d H:i:s");
    $edit['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    if(SESSION::get('admin')){
      $id = $_POST['id'];
      $this->_model->update("images",$edit,"id=$id");
    }
    echo json_encode($edit);
  }

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
        $edit['name'] = strtolower(filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
      }else{
        $edit['name'] = $kategorie[0]['name'];
      }

      //set cover
      if(isset($_POST['newcover'.$id]) && $_POST['newcover'.$id]=='on'){
        if(!empty($_FILES['kategorie_cover'.$id]['name'])){
          $nama = $_FILES['kategorie_cover'.$id]['name'];
          //get file extention
          $ext = pathinfo($nama, PATHINFO_EXTENSION);
          //temporary path
          $tmp_name = $_FILES['kategorie_cover'.$id]['tmp_name'];
          $newFilePath = 'assets/kategorie/'.$edit['name'].'.'.$ext;
          $edit['image'] = DIR.$newFilePath;
          //remove old image from path
          unlink(getcwd().'/assets/kategorie/'.$kategorie[0]['name'].'.'.$ext);
          //upload new image to path
          $uploads = move_uploaded_file($tmp_name, $newFilePath);
          //resize file
          $file = $newFilePath;
          //indicate the path and name for the new resized file
          $resizedFile = $newFilePath;
          //call the function (when passing path to pic)
          $img = $this->smart_resize_image($file , null, '230' , '150' , false , $resizedFile , false , false ,100 );
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
    URL::REDIRECT("portfolio/kategorie/".$oberkategorie[0]['name']);
  }

  public function shows(){
    $album_id = $_POST['album_id'];
    $kategorie_id = $_POST['kategorie_id'];

    $shows = $this->_model->selectOne2Clauses("images","album_id",$album_id,"kategorie_id",$kategorie_id);

    echo json_encode($shows);
  }

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

  public function update_reihenfolge(){
    $id = $_POST['id'];
    $reihen['reihenfolge'] = $_POST['reihenfolge'];
    if(SESSION::get('admin')){
      $this->_model->update("images",$reihen,"id=$id");
    }
  }
}
