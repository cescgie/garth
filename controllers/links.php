<?php

class Links extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'LINKS';
      $data['subtitle'] = 'LINKS';

      $this->_view->render('header', $data);
      $this->_view->render('partials/partials_header', $data);
      $this->_view->render('partials/links', $data);
      $this->_view->render('partials/partials_footer', $data);
      $this->_view->render('footer');
   }
}
