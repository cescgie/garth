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

   public function count($table,$col,$val){
     return $this->_db->select('SELECT count(*) as total FROM '.$table.' WHERE '.$col.' = "'.$val.'"');
   }

   public function selectRow($table,$col,$val,$group_by,$row,$limit){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col.' = "'.$val.'" GROUP BY '.$group_by.' ' .$row.' LIMIT '.$limit.'');
   }

   public function selectOne3Clauses($table,$col1,$val1,$col2,$val2,$col3,$val3){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col1.' = "'.$val1.'" AND '.$col2.' = "'.$val2.'" AND '.$col3.' = "'.$val3.'" ');
   }

   public function selectOne2Clauses($table,$col1,$val1,$col2,$val2){
     return $this->_db->select('SELECT title as title, path as href FROM '.$table.' WHERE '.$col1.' = "'.$val1.'" AND '.$col2.' = "'.$val2.'" ');
   }

   public function check_exist($table,$col,$val){
     return $this->_db->select('SELECT count(*) as count FROM '.$table.' WHERE '.$col.' = "'.$val.'"');
   }

   public function delete($table,$clause){
     return $this->_db->delete($table,$clause);
   }

   public function update($table,$data,$where){
     return $this->_db->update($table,$data,$where);
   }

   public function selectOneRei($table,$col,$val){
     return $this->_db->select('SELECT * FROM '.$table.' WHERE '.$col.' = "'.$val.'" ORDER BY reihenfolge ASC');
   }
}
