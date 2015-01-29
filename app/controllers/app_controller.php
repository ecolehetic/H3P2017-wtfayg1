<?php

namespace APP\CONTROLLERS;

class app_controller{
  
  private $tpl;
  private $model;
  private $dataset;
  
  function __construct(){
    $this->tpl=array(
      'sync'=>'main.html',
      'async'=>'');
    $this->model=new \APP\MODELS\app_model();
  }
  
  public function home($f3,$params){
    
  }
  
  public function getUsers($f3,$params){
    $this->dataset=$this->model->getUsers($params);
    $f3->set('users',$this->dataset);
    $this->tpl['async']='partials/users.html';
  }
  
  public function getUser($f3,$params){
    $f3->set('one',$this->model->getUser($params));
  }
  
  public function search($f3){
    $f3->set('users',$this->model->search($f3->get('POST.name')));
    $this->tpl['async']='partials/users.html';
  }
  
  
  public function upload($f3){
    \Web::instance()->receive(function($file){
      print_r($file);
    },true,true);
  }
  
  public function afterroute($f3){
    if(isset($_GET['format'])&&$_GET['format']=='json'){
      $this->dataset=array_map(function($data){return $data->cast();},$this->dataset);
      header('Content-Type: application/json');
      echo json_encode($this->dataset);
    }
    else{
      $tpl=$f3->get('AJAX')?$this->tpl['async']:$this->tpl['sync'];
      echo \View::instance()->render($tpl);
    }
    
  }
  

  
  
}











?>