--TEST--
Test redirection in web server with baisc functionality - pdo_mysql
--SKIPIF--
<?php 
    require_once('skipif_server.inc');
    require_once('skipif_pdo.inc');
?>
--CONFLICTS--
server
--FILE--
<?php
include 'server.inc';
$host = cli_server_start();

// start testing
echo "*** Testing pdo_mysql in web server: basic functionality ***\n";

$url = "http://"."{$host}/server_basic_pdo_testcase.php";

$fp = fopen($url, 'r');
if(!$fp) {
    echo "[000] request url failed \n";
    die();
}
while (!feof($fp)) {
    echo fgets($fp, 4096);
}

fclose($fp);
?>
===DONE===
--EXPECTF--
*** Testing pdo_mysql in web server: basic functionality ***
step1: redirect enabled, non-persistent connection 
mysqlnd_azure.enableRedirect: preferred
%s
0
step2: redirect enabled, persistent connection 
mysqlnd_azure.enableRedirect: preferred
%s
0
step3: redirect disabled, non-persistent connection 
mysqlnd_azure.enableRedirect: off
%s
1
step4: redirect disabled, persistent connection 
mysqlnd_azure.enableRedirect: off
%s
0
===DONE===