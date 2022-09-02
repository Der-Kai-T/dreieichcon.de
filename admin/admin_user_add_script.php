<?php

/*
Array
(
    [admin_user_name] => Kai
    [admin_user_mail] => info@conservices.de
    [admin_user_admin] => on
    [admin_user_active] => on
)

*/

include("include/pepper.php");


$password                               = generate_password();
$secret                                 = generate_secret();

$password_hash                          = password_hash($password.PEPPER, PASSWORD_DEFAULT);

$data['admin_user_password']             	= $password_hash;
$data['admin_user_name']	            	= $_POST['admin_user_name'];
$data['admin_user_mail']            		= $_POST['admin_user_mail'];
$data['admin_user_secret']                 = $secret;

if(isset($_POST['admin_user_admin'])){
    $data['admin_user_admin'] = 1;
}

if(isset($_POST['admin_user_active'])){
    $data['admin_user_active'] = 1;
}


$data['admin_user_modify_id']            		= $_SESSION['admin_user_id'];
$data['admin_user_modify_ts']            		= time();


$query		= "Benutzer anlegen";
$db_result 	= db_insert("adminuser", $data);



if($db_result['result'] == "ok"){			
//if user inserted, send mail

    $name           = $_POST['admin_user_name'];
    $email          = $_POST['admin_user_mail'];

    $link_href      = $global_domain . "admin/login_set_password.php?user_name=$email&user_secret=$secret";

    $link           = "<a href='$link_href'>$link_href</a>";


    $subject        = "Dein Benutzerkonto bei der Con-Tafelrunde";

    $body           = "<p>Hallo $name,<br> f&uuml;r Dich wurde ein Konto bei der Con-Tafelrunde angelegt. Klicke auf den nachfolgenden Link (oder kopiere ihn vollst&auml;ndig in deinen Browser) um das Passwort festzulegen:</p>
    
    <p>$link</p>

    <p>Alternativ besuche verwende den unten stehenden Sicherheitscode um &uuml;ber die Anmeldemaske das Passwort zu &auml;ndern:<br><pre>$secret</pre></p>
    
    <p>Viele Gr&uuml;&szlig;e<br>
    <i>Con-Tafelrunde Administration</i></p>";
    

    $rec            = array();

    $rec1['mail']   = $email;
    $rec1['name']   = $name;

    array_push($rec, $rec1);


    $mail = phpmailer_send_mail($rec, $subject, $body);

}



include("admin_user.php");



?>
