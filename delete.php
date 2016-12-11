<?php

$mykey1=$_REQUEST['key1'];
require_once("connect.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection error");
mysqli_query($dbc,"DELETE FROM gallery WHERE ID = $mykey1");
echo "<script>location.href='view.php'</script>"

?> 