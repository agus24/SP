<!DOCTYPE html>
<html>
<head>
    <title><?=$errlvl?></title>
    <style>
        body{
            background-color:#d2d2d2;
        }
        .wrapper{
            margin-left:5%;
            margin-right:5%;
            background-color:white;
            padding-right:1%;
            font-family:calibri;
        }
        .fill{
            margin-left:1%;
        }
        .container{
            width=100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><h1><?=$errlvl?></h1></center>
        <center><h1>SHUTDOWN</h1></center>
        <div class="wrapper">
            <div class="fill">
                <b style="font-size:20px;"><?=$message?></i></b><br>
            </div>
        </div>
    </div>
</body>
</html>
