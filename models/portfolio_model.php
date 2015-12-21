<?php

class Portfolio_Model extends Model {

   public function __construct(){
      parent::__construct();
   }

   /**
   * Show last 20 items in database
   */
   public function selectAll($table){
     return $this->_db->select('SELECT * FROM '.$table.' ORDER BY id DESC LIMIT 0, 20');
   }

   public function selectOne($table,$col,$val){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col.' = "'.$val.'"');
   }
}
