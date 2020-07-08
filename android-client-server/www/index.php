<?php



if ($_SERVER['REQUEST_URI'] == '/'){
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);


if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}


if ($Page == 'index') echo 'Главная страница';
else if ($Page =='api') include('api.php');
else if ($Page =='view') include('./page_view/view.html');
else if ($Page =='adminka') include('./page_admin/adminka.html');
else if ($Page =='actionControl') include('./page_action/actionControl.html');
else if ($Page =='player') include('./page_other/player.html');
else if ($Page =='questionsMaker') include('./page_other/questionsMaker.html');
else if ($Page =='action') include('./page_action/action.html');
else if ($Page =='testHTML') include('./test.html');
else if ($Page =='testPHP') include('./test.php');
?>﻿