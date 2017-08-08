<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<form action="<?=makeUrl('login')?>" method="POST">
    username : <input type="text" name="username">
    password : <input type="password" name="password">
    <button>Login</button>
</form>
</body>
</html>
