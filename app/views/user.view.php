<?php if(!auth()->guest()): ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>
                <div class="panel-body">
                    <table class="table table-responsive">
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
                                    <a href="<?= makeUrl('user/'.$user->id.'/edit') ?>"><button class="btn btn-primary">Edit</button></a>
                                    <a href="<?= makeUrl('user/'.$user->id.'/delete') ?>"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Insert New User</div>
                <div class="panel-body">
                    <form method="POST" action="<?=makeUrl('user')?>">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
