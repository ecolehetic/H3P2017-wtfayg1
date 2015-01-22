<?php
$f3=require('lib/base.php');
$f3->set('UI','templates/');
$f3->set('DEBUG',2);

$f3->route('GET /',function($f3){
  echo View::instance()->render('main.html');
});

$f3->route('GET /users/@promo',function($f3,$params){
  $dB=new DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=wtfay','root','');
  //$f3->set('data',$dB->exec('SELECT * FROM wifiloc WHERE promo=?',array(1=>$params['promo'])));
  $users=new DB\SQL\Mapper($dB,'wifiloc');
  $data=$users->find(array('promo=?',$params['promo']));
  $f3->set('data',$data);
  echo View::instance()->render('main.html');
});












$f3->run();
?>