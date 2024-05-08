<?php
session_start();
//bersihkan variabel SES_USER dari variabel
session_unregister("SES_USER");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
?>
