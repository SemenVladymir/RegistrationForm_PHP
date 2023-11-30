<?php
if (isset($_POST)){
    include_once("functions.php");
    switch ($_POST["submit"]){
        case "Login":
            register($_POST["username"], $_POST["userpass"], "", "",false);

            break;
        case "Registration":
            if ($_POST["userpass"] == $_POST["userpassagain"])
                register($_POST["username"], $_POST["userpass"], $_POST["useremail"], $_POST["userbirthday"],true);
            break;
        default:
            echo "<h3/><span style='color:red;'>Bad Request! 400</span><h3/>";
    }
}
