<?php

class Kontakt extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'KONTAKT';
      $data['subtitle'] = 'KONTAKT';
      $data['menu_active'] = 'kontakt';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/kontakt', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
}
