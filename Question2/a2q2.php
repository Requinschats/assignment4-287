<html>
<head>
    <title>PHP Test</title>
</head>
<body>

<?php
session_start();

if (htmlspecialchars($_POST['reset']) == 'yes') {
    session_unset();
    session_destroy();
} else {
    if (!isset($_POST['username'])) {
        $_SESSION["username"] = htmlspecialchars($_POST['username']);
        $_SESSION["nVisits"] = 0;
    } else {
        $_SESSION["nVisits"]++;
    }
}

if ($_SESSION["nVisits"] != 0) {
    echo "<h1>Hello " . htmlspecialchars($_POST['username']) . "!!</h1>" .
        "<h3>You have been here " . $_SESSION['nVisits'] . " times </h3>" .
        "<form method=\"POST\" action=\"a2q2.php\" accept-charset=\"utf-8\">
    <input type='submit' value='RESET'/>
    <input type='hidden' name='reset' value='yes'/>
</form>";

} else {
    echo "<form method=\"POST\" action=\"a2q2.php\" accept-charset=\"utf-8\">
    <input placeholder=\"Username\" id=\"email\" type=\"text\" name=\"username\" />
    <input type=\"submit\" value=\"SEND\"/>
</form>";
}
?>

</body>
</html>


