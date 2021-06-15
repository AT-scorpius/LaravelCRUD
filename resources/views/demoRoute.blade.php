<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href={{route('link.id.branch',["id"=>1, "branchId" =>1 ])}}>Link 1</a></li>|
        <li><a href={{route('link.id.branch',["id"=>2, "branchId" =>100 ])}}>Link 2</a></li>|
        <li><a href={{route('link.id.branch',["id"=>3, "branchId" =>111 ])}}>Link 3</a></li>|
        <li><a href={{route('link.id.branch',["id"=>4, "branchId" =>1112 ])}}>Link 4</a></li>|
        <li><a href={{route('link.id.branch',["id"=>5, "branchId" =>1117])}}>Link 5</a></li>|
    </ul>
</body>
</html>