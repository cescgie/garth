<?php

class Vita_Model extends Model {

   public function __construct(){
      parent::__construct();
   }

   public function selectAllClauseOrderBy($table,$clause = null,$order=null,$limit=null){
     return $this->_db->select("SELECT * FROM $table $clause $order $limit");
   }

   public function update($table,$data,$where){
     return $this->_db->update($table,$data,$where);
   }

}
