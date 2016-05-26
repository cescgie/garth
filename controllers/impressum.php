<?php

class Impressum extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'IMPRESSUM';
      $data['subtitle'] = 'IMPRESSUM';
      $data['menu_active'] = 'impressum';

      $clause = "WHERE slug = 'impressum'";
      $data['impressum'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      //meta tag
      $description = 'Impressum astrid-garth.de';
      $data['meta_keywords'] = SITETITLE.', impressum, astrid-garth.de';
      $data['meta_description'] = $description;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/impressum', $data);
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
}
