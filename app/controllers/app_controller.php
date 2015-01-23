<?php

class app_controller{
  
  private $tpl;
  private $model;
  
  function __construct(){
    $this->tpl='main.html';
    $this->model=new app_model();
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
    $users=$this->model->search($f3->get('POST.name'));
    $f3->set('users',$users);
  }
  
  public function afterroute(){
    echo View::instance()->render($this->tpl);
  }
  

  
  
}

?>