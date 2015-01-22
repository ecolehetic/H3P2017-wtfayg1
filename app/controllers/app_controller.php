<?php

class app_controller{
  
  function __construct(){
    
  }
  
  function home($f3,$params){
    echo View::instance()->render('main.html');
  }
  
  function getUsers($f3,$params){
    $model=new app_model();
    $data=$model->getUsers($params);
    $f3->set('users',$data);
    echo View::instance()->render('main.html');
  }
  
  function getUser($f3,$params){
    $model=new app_model();
    $data=$model->getUser($params);
    $f3->set('one',$data);
    echo View::instance()->render('main.html');
  }
  

  
  
}

?>