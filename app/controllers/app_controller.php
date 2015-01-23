<?php

namespace APP\CONTROLLERS;

class app_controller{
  
  private $tpl;
  private $model;
  
  function __construct(){
    $this->tpl='main.html';
    $this->model=new \APP\MODELS\app_model();
  }
  
  public function home($f3,$params){
    
  }
  
  public function getUsers($f3,$params){
    $f3->set('users',$this->model->getUsers($params));
  }
  
  public function getUser($f3,$params){
    $f3->set('one',$this->model->getUser($params));
  }
  
  public function search($f3){
    $f3->set('users',$this->model->search($f3->get('POST.name')));
  }
  
  public function afterroute(){
    echo \View::instance()->render($this->tpl);
  }
  

  
  
}

?>