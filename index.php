<?php
$f3=require('lib/base.php');
$f3->set('UI','templates/');
$f3->set('DEBUG',2);
$f3->set('dB',new DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=wtfay','root',''));


$f3->route('GET /',function($f3){
  echo View::instance()->render('main.html');
});

$f3->route('GET /users/@promo',function($f3,$params){
  $users=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
  $data=$users->find(array('promo=?',$params['promo']));
  $f3->set('users',$data);
  echo View::instance()->render('main.html');
});

$f3->route('GET /user/@id',function($f3,$params){
  $user=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
  $one=$user->load(array('id=?',$params['id']));
  $f3->set('one',$one);
  echo View::instance()->render('main.html');
});














$f3->run();
?>