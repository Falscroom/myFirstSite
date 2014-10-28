<title>Bootstrap</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/all_style.css" rel="stylesheet" media="screen">

<?php foreach($data['header']['css'] as $css_file_name): ?>
    <link href="css/<?=$css_file_name ?>" rel="stylesheet" media="screen">
<?php endforeach; ?>

<?php foreach($data['header']['js'] as $js_file_name): ?>
    <script src="js/<?=$js_file_name ?>"></script>
<?php endforeach; ?>
