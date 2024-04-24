#!/usr/bin/php
<?php
# Script de provisión masiva de usuarios con clases de servicio para Carbonio
# Copyrigth 2024 Clever Flores
# clever@aulautil.com
 
// Obteniendo los COS del sistema y sus Ids 
exec("/opt/zextras/bin/zmprov gac",$arrcos);
$cos = array();
foreach($arrcos as $cos_name){
       $cos_name  = chop ($cos_name);
       $cosid=`/opt/zextras/bin/zmprov gc $cos_name | grep ^zimbraId:`;
       $cosid = trim(str_replace("zimbraId: ","",$cosid));
       $cos[$cos_name]=$cosid;
}
 
//print_r($cos); 
// Leyendo los archivos de Usuarios 
$userfile=file("usuarios.txt");
// Recorriendo array de usuarios y creando las cuentas 
foreach($userfile as $userline){
       $userline=trim(chop($userline));
       if(!empty($userline)){
            $user = explode(",",$userline);
            echo("ca $user[0] $user[1] displayName '$user[2]' zimbraPrefIdentityName '$user[2]' zimbraCOSId ".$cos[$user[3]]."\n"); 
       }
}
?>
