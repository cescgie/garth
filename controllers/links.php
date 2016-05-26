<?php

class Links extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'LINKS';
      $data['subtitle'] = 'LINKS';
      $data['menu_active'] = 'links';

      $clause = "WHERE slug = 'links'";
      $data['links'] = $this->_model->selectAllClauseOrderBy("text",$clause,null,null);

      //meta tag
      $description = 'Link astrid-garth.de';
      $data['meta_keywords'] = SITETITLE.', link, astrid-garth.de';
      $data['meta_description'] = $description;

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/links', $data);
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
