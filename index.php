<?php

use Core\Libs\Route;

spl_autoload_register(static function($className){

	$arr =  explode('\\',$className);
	$count = count($arr);
	for ($i = 0; $i < $count-1; $i++) {
		$arr[$i] = lcfirst($arr[$i] );
	}
	$className = implode('/',$arr);
	require_once $className.'.php';
});

Route::start();



// $n = new \Core\Classes\File('core/classes/text.txt');
// $n->getName();
// $n->getPath();
// $n->getDir();
// $n->getExt();
// $n->getSize();
// $n->getText();
// $n->setText('fgdf');
// $n->appendText('wdqwasddop');
// $n->copy('core\controllers');
//$n->copy('./');
//$n->delete();
//$n->rename('texted');
//$n->replace('copyFolder');
//
//echo '<pre>'.print_r($n,true).'</pre>';
//echo '<hr>';




