<?php

class Portfolio extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'PORTFOLIO';
      $data['subtitle'] = 'PORTFOLIO';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/portfolio/submenu', $data);
      $this->_view->render('partials/portfolio/index', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
   public function oberkategorie($name){
      $data['title'] = strtoupper($name).' | PORTFOLIO';
      $data['subtitle'] = strtoupper($name);
      //get kategorie id
      $data['kategorie_id'] = $this->_model->selectOne("kategorie","name",$name);
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
   public function album($name){
      $data['title'] = strtoupper($name).' | PORTFOLIO';
      $data['subtitle'] = strtoupper($name);
      //get album id
      $data['album_id'] = $this->_model->selectOne("albums","name",$name);
      $album_id = $data['album_id'][0]['id'];
      print_r($album_id);
}
