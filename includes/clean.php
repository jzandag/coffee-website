<?php

shell_exec("sudo python /var/www/html/script/clean.py");

header("Location: ../smart-coffee/View/viewUsers.php?success=cleaningSuccess");
exit();
?>
