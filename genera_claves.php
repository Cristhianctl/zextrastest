#!/usr/bin/php
<?php
# Script de generación aleatoria de contraseñas de las cuentas de zimbra
# Copyrigth 2024 Clever Flores
# clever@aulautil.com
$servidor="zextras";
if (is_dir("/opt/zextras")){
    $servidor="zextras";
}
 
exec("/opt/$servidor/bin/zmprov -l gaa | egrep -v '(admin@|ham.|virus.|spam.|galsync.)'",$users);
foreach($users as $user){
        $user = trim(chop($user));
        $puser = randomPassword();
        exec("/opt/$servidor/bin/zmprov sp $user $puser");
        echo "$user,$puser\n";
}
 
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $npass = implode($pass).'.1';
    return $npass; //turn the array into a string
}
?>
