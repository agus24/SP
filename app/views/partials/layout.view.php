<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=config('app_name')?></title>
    <link rel="stylesheet" type="text/css" href="<?=asset('css/app.css')?>">
    <style>
        ._title {
            align-items: center;
            display: flex;
            justify-content: center;
            font-family:joker;
        }

        ._title:before {
            content:'';
            display:inline-block;
            height:100%;
            vertical-align:middle;
            width:0px;
        }
    </style>
</head>
<body>
<?php section(${'nav'});?>
<div class="container">
    <?php section(${'content'});?>
</div>
<script src="<?=asset('js/app.js')?>"></script>
<?=script();?>
</body>
</html>
