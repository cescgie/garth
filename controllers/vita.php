<?php

class Vita extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'VITA';
      $data['subtitle'] = 'VITA';
      $data['menu_active'] = 'vita';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/vita', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
}
