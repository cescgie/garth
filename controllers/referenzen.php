<?php

class Referenzen extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'REFERENZEN';
      $data['subtitle'] = 'REFERENZEN';
      $data['menu_active'] = 'referenzen';

      $clause = "WHERE slug = 'referenzen1'";
      $data['referenzen1'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      $clause = "WHERE slug = 'referenzen2'";
      $data['referenzen2'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      //meta tag
      $description = 'Profil astrid-garth.de';
      $data['meta_keywords'] = SITETITLE.', profil, astrid-garth.de';
      $data['meta_description'] = $description;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/referenzen', $data);
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
