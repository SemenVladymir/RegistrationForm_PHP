<?php
$users = 'users.txt';
function register($name, $pass, $email, $birthday, $reg):bool
{
    //data validation block
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    $email=trim(htmlspecialchars($email));
    $birthday=trim(htmlspecialchars($birthday));
    if($name =='' || $pass =='')
    {
        echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
        return false;
    }
    if(strlen($name) < 8 || strlen($name) > 30 ||
    strlen($pass) < 8 || strlen($pass) > 30)
    {
        echo "<h3/><span style='color:red;'>Login And Password Length Must Be Between 8 And 30!</span><h3/>";
        return false;
    }
    //login uniqueness check block
    global $users;
    $file=fopen($users,'a+');
    while($line=fgets($file, 256))
    {
        $readline=substr($line,0,strpos($line,':'));
        if ($reg) {
            if ($readline == $name) {
                echo "<h3/><span style='color:red;'>Such Login Name Is Already Used!</span><h3/>";
                return false;
            }
        }
        elseif ($readline == $name)
        {
            if (str_contains($line, md5($pass))) {
                echo "<h3/><span style='color:green;'>Your login and password confirmed!</span><h3/>";
                return true;
            }
        }
    }
    //new user adding block
    if ($reg) {
        $line = $name . ':' . md5($pass) . ':' . $email . ':' . $birthday ."\r\n";
        fputs($file, $line);
        fclose($file);
        echo "<h3/><span style='color:green;'>New user registered!</span><h3/>";
        return true;
    }
    else
    {
        echo "<h3/><span style='color:red;'>Your login or password is wrong!</span><h3/>";
        return false;
    }
}