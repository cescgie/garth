<?php

class Portfolio_Model extends Model {

   public function __construct(){
      parent::__construct();
   }

   /**
   * Show last 20 items in database
   */
   public function selectAll($table){
     return $this->_db->select('SELECT * FROM '.$table.' ORDER BY name ASC LIMIT 0, 20');
   }

   public function selectOne($table,$col,$val){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col.' = "'.$val.'"');
   }

   public function create($table,$data){
     return $this->_db->insert($table, $data);
   }

   public function count($table,$album){
     return $this->_db->select('SELECT count(*) as total FROM '.$table.' WHERE album = "'.$album.'"');
   }

   public function selectRow($table,$col,$val,$group_by,$row,$limit){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col.' = "'.$val.'" GROUP BY '.$group_by.' ' .$row.' LIMIT '.$limit.'');
   }
}
