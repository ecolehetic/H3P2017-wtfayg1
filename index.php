<?php
$f3=require('lib/base.php');
$f3->set('UI','templates/');

$f3->route('GET /',function($f3){
  echo View::instance()->render('main.html');
});

$f3->route('GET /users/@promo',function($f3,$params){
  $datas=array(
    'h1'=>array(
      array('firstname'=>'Jean Claude','lastname'=>'Dus','id'=>1),
      array('firstname'=>'Benjamin','lastname'=>'Corsini','id'=>2),
      array('firstname'=>'Robin','lastname'=>'Michet','id'=>3)
    ),
    'h2'=>array(
      array('firstname'=>'Sylvester','lastname'=>'Stallone','id'=>4),
      array('firstname'=>'Benjamin','lastname'=>'Pumir','id'=>5),
      array('firstname'=>'Robin','lastname'=>'Rua','id'=>6)
    ),
    'h3'=>array(
      array('firstname'=>'Jean-Christophe','lastname'=>'Beaux','id'=>7),
      array('firstname'=>'Francois','lastname'=>'Pumir','id'=>8),
      array('firstname'=>'Super','lastname'=>'Man','id'=>9)
    )
  );
  if($datas[$params['promo']]){
    $f3->set('datas',$datas[$params['promo']]);
  }
  echo View::instance()->render('main.html');
});












$f3->run();
?>