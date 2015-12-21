<?php

class Home extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'HOME';
      $data['subtitle'] = 'HOME';

      $this->_view->render('header', $data);
      $this->_view->render('home/carousel', $data);
      //$this->_view->render('home/paralax', $data);
      $this->_view->render('home/line', $data);
      $this->_view->render('home/paralax2', $data);
      $this->_view->render('home/footer');
   }
}
