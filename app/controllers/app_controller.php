<?php

namespace APP\CONTROLLERS;

class app_controller{
  
  private $tpl;
  private $model;
  private $dataset;
  
  function __construct(){
    $f3=\Base::instance();
    if($f3->get('PATTERN')!='/signin'&&!$f3->get('SESSION.id')){
      $f3->reroute('/signin');
    }
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
    $this->dataset=$this->model->getUser($params);
    $f3->set('one',$this->dataset);
  }
  
  public function search($f3){
    $f3->set('users',$this->model->search($f3->get('POST.name')));
    $this->tpl['async']='partials/users.html';
  }
  
  public function signin($f3){
    $this->tpl['sync']='signin.html';
    if($f3->get('VERB')=='POST'){
      $auth=$this->model->signin($f3->get('POST'));
      if($auth){
        $user=array(
          'id'=>$auth->id,
          'firstname'=>$auth->firstname,
          'lastname'=>$auth->lastname
        );
        $f3->set('SESSION',$user);
        $f3->reroute('/');
      }else{
        $f3->set('errorMsg','Vous n\'avez pas les credentials nécessaires.');
      }
    }
  }
  
  public function signout($f3){
    session_destroy();
    $f3->reroute('/signin');
  }
  
  
  public function request($f3){
    $options=array(
      'header' => array(
        'Authorization: token c05569a93130fe8a817455c703d109218eccc1c5'
      )
    );
    $response=\Web::instance()->request('https://api.github.com/repos/fpumir/wtfay/issues',$options);
    print_r(json_decode($response['body']));
    exit;
  }
  
  public function upload($f3){
    \Web::instance()->receive(function($file){
      print_r($file);
    },true,true);
  }
  
  public function afterroute($f3){
    if(isset($_GET['format'])&&$_GET['format']=='json'){
      if(is_array($this->dataset)){
        $this->dataset=array_map(function($data){return $data->cast();},$this->dataset);
      }
      elseif(is_object($this->dataset)){
        $this->dataset=$this->dataset->cast();
      }
      else{
        $this->dataset=array('error'=>'no dataset');
      }
      if(isset($_GET['callback'])){
        header('Content-Type: application/javascript');
        echo $_GET['callback'].'('.json_encode($this->dataset).')';
      }else{
        header('Content-Type: application/json');
        echo json_encode($this->dataset);
      }
      
    }
    else{
      $tpl=$f3->get('AJAX')?$this->tpl['async']:$this->tpl['sync'];
      echo \View::instance()->render($tpl);
    }
    
  }
  

  
  
}











?>