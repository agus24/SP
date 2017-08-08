<?php require('partials/head.php'); ?>
<?php if(!auth()->guest()): ?>
<table border="1px" width="100%">
<thead>
    <th>No.</th>
    <th>Nama</th>
    <th>Username</th>
    <th>#</th>
</thead>
<tbody>
<?php foreach ($users as $key => $user) : ?>
    <tr>
        <td><?= $key+1 ?>.</td>
        <td><?= $user->name; ?></td>
        <td><?= $user->username; ?></td>
        <td>
            <a href="<?= makeUrl('user/'.$user->id.'/edit') ?>"><button>Edit</button></a>
            <a href="<?= makeUrl('user/'.$user->id.'/delete') ?>"><button>Delete</button></a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>

<h1>User Your Name</h1>
<form method="POST" action="<?=makeUrl('user')?>">
    Name : <input name="name"></input><?= isset($error['name'])? $error['name'] : ''?><br>
    Username : <input type="username" name="username"></input><br>
    Password : <input type="password" name="password"></input><br>
    <button type="submit">Submit</button>
</form>
<?php require('partials/footer.php'); ?>
