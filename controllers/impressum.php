<?php

class Impressum extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'IMPRESSUM';
      $data['subtitle'] = 'IMPRESSUM';
      $data['menu_active'] = 'impressum';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/impressum', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
}
