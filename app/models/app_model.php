<?php

class app_model{
  
var $dB;
  
 function __construct(){
   $this->dB=new DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=wtfay','root','');
 } 
 
 function getUsers($params){
   $users=new DB\SQL\Mapper($this->dB,'wifiloc');
   return $users->find(array('promo=?',$params['promo']));
 }
 
 function getUser($params){
   $user=new DB\SQL\Mapper($this->dB,'wifiloc');
   return $user->load(array('id=?',$params['id']));
 }
  
}

?>