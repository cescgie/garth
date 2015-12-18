<?php

class Referenzen extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'REFERENZEN';
      $data['subtitle'] = 'REFERENZEN';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/referenzen', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
}