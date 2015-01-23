<?php


class app_model{
  
var $dB;
  
 function __construct(){
   $f3=Base::instance();
   $this->dB=new \DB\SQL('mysql:host='.$f3->get('db_host').';port='.$f3->get('db_port').';dbname='.$f3->get('db_name'),
   $f3->get('db_login'),$f3->get('db_password'));
 } 
 
 public function getUsers($params){
   return $this->getMapper()->find(array('promo=?',$params['promo']));
 }
 
 public function getUser($params){
   return $this->getMapper()->load(array('id=?',$params['id']));
 }
 
 public function search($name){
   return $this->getMapper()->find(
     array('firstname LIKE :name or lastname LIKE :name',':name'=>'%'.$name.'%'),
     array('order'=>'lastname'));
 }
 
 private function getMapper($table='wifiloc'){
   return new DB\SQL\Mapper($this->dB,$table);
 }
  
}














?>