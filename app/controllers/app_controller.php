<?php


class app_controller{
  
  function __construct(){
    
  }
  
  function home($f3,$params){
    echo View::instance()->render('main.html');
  }
  
  function getUsers($f3,$params){
    $users=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
    $data=$users->find(array('promo=?',$params['promo']));
    $f3->set('users',$data);
    echo View::instance()->render('main.html');
  }
  
  function getUser($f3,$params){
    $user=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
    $one=$user->load(array('id=?',$params['id']));
    $f3->set('one',$one);
    echo View::instance()->render('main.html');
  }
  
  
  
}

?>