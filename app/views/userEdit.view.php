<?php require('partials/head.php'); ?>
<form method="POST" actiion="<?=currentUrl()?>">
    Name : <input name="name" value="<?=$user->name?>"><br>
    Username : <input name="username" value="<?=$user->username?>"><br>
    Password : <input type="password" name="password"><br>
    <input type="submit">
    <a href="<?=previousUrl()?>"><input type="button" value="Back"></a>
</form>
<?php require('partials/footer.php'); ?>
