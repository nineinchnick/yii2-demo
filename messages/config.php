<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
$basePath = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
array_pop($basePath);
$basePath = implode(DIRECTORY_SEPARATOR, $basePath).DIRECTORY_SEPARATOR;
return array(
	'sourcePath'=>$basePath,
	'messagePath'=>$basePath.'messages',
	'languages'=>array('pl'),
	'fileTypes'=>array('php'),
    'overwrite'=>true,
	'filter' => function($path)use($basePath){
		$exceptions = [
			'.svn',
			'.git',
			'/config',
			'/data',
			'/messages',
			'/migrations',
			'/modules',
			'/extensions',
			'/runtime',
			'/web',
			'/vendor',
			'/tests',
		];
		$p = substr($path,strlen($basePath));
		return []===array_filter($exceptions, function($exception)use($p){
			return $exception[0]==='/' ? strpos($p,substr($exception,1))===0 : strpos($p,$exception)!==false;
		}); 
	},
);
