<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<form method="POST" action="" accept-charset="utf-8">
    <input placeholder="Name" id="email" type="text" name="name" />
    <input placeholder="Phone (ddd)-ddd-dddd" type="text" id="phone" name="phone"/>
    <input type="submit" value="Register Informations" />
</form>
<?php

function isPhoneValid($phone) {
    return preg_match("/[(][0-9]{3}[)]-[0-9]{3}-[0-9]{4}/", $phone);
}

function isNameValid($fname) {
    return preg_match("/[A-Z][a-z][a-z0-9_-]{0,28}$/", $fname);
}

$validPhone = false;
$validName = false;

if(!isNameValid($_POST['name']) || empty($_POST['name'])){
    echo 'Invalid name ';
}else{
    $validName = true;
}


if(!isPhoneValid($_POST['phone']) || empty($_POST['phone'])){
    echo 'Invalid phone number ';
}else{
    $validPhone = true;
}

if($validPhone && $validName){
    echo 'Form was submitted correctly';
}


?>
</body>
</html>