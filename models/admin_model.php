<?php
class Admin_Model extends Model {

  public function __construct(){
     parent::__construct();
  }

  public function check_admin($col,$value){
    return $this->_db->select("SELECT username,password,state FROM admin WHERE $col = '".$value."' ");
  }

  public function check($column,$value){
     return $this->_db->select('SELECT EXISTS(SELECT 1 FROM admin WHERE '.$column.' ="'.$value.'" LIMIT 1) AS my_check');
  }
}
?>
