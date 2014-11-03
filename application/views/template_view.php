<!DOCTYPE html>
<html>
<head>
    <?php include 'application/views/'.$files['header']['file']; ?>
</head>
<body>

<!--Фон для всех страничек сайта-->
<div id="ac_background" class="ac_background">
    <div class="ac_overlay"></div>
</div>

<?php include 'application/views/'.$files['menu']['file']; ?>
<?php include 'application/views/'.$content_view; ?>
</body>
</html>