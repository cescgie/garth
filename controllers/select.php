<?php

class Select extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'HOME';

      $this->_view->render('header', $data);
      $this->_view->render('partials/portfolio', $data);
      $this->_view->render('footer');
   }

   public function partials($link){
     $data['title'] = strtoupper($link);

     $this->_view->render('header', $data);
     $this->_view->render('partials/'.$link);
     $this->_view->render('footer');
   }

}
