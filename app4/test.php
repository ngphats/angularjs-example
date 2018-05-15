<?php 

$route = (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$parentFolders = trim(preg_replace('/\/[\w]+.php/U', '', $_SERVER['PHP_SELF']), ' /');
$route = preg_replace('/' . preg_quote($parentFolders, '/') . '/u', '', $route);
echo trim($route, ' /');