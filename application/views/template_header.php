<title>Bootstrap</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--/////////////////////////////////////////////////////////////////////
//////////////////// Константные файлы, для всех страниц    /////////////-->
<link href="/myFirstSite/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!--// ПОЧЕМУ НЕ РАБОТАЕТ С css/bootstrap.min.css при запросе http://localhost/myFirstSite/content/index-->
<script src="/myFirstSite/js/jquery-2.1.1.js"></script>
<script src="/myFirstSite/js/bootstrap.min.js"></script>
<link href="/myFirstSite/css/all_style.css" rel="stylesheet" media="screen">
<!--/////////////////////////////////////////////////////////////////////
///// Данные файлы добавляются динамически из контроллера-->
<?php foreach($files['header']['css'] as $css_file_name): ?>
    <link href="/myFirstSite/css/<?=$css_file_name ?>" rel="stylesheet" media="screen">
<?php endforeach; ?>

<?php foreach($files['header']['js'] as $js_file_name): ?>
    <script src="/myFirstSite/js/<?=$js_file_name ?>"></script>
<?php endforeach; ?>
