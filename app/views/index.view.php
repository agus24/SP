<?php require('partials/head.php'); ?>

<h1>Home</h1>
<ul>

<?php foreach($users as $user) : ?>
<li><?=$user->name?></li>
<?php endforeach; ?>
</ul>

<?php require('partials/footer.php'); ?>
