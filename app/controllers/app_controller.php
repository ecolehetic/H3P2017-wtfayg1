<?php

namespace APP\CONTROLLERS;

class app_controller{
  
  private $tpl;
  private $model;
  
  function __construct(){
    $this->tpl=array(
      'sync'=>'main.html',
      'async'=>'');
    $this->model=new \APP\MODELS\app_model();
  }
  
  public function home($f3,$params){
    
  }
  
  public function getUsers($f3,$params){
    $f3->set('users',$this->model->getUsers($params));
    $this->tpl['async']='partials/users.html';
  }
  
  public function getUser($f3,$params){
    $f3->set('one',$this->model->getUser($params));
  }
  
  public function search($f3){
    $f3->set('users',$this->model->search($f3->get('POST.name')));
  }
  
  public function afterroute($f3){
    $tpl=$f3->get('AJAX')?$this->tpl['async']:$this->tpl['sync'];
    echo \View::instance()->render($tpl);
  }
  

  
  
}











?>