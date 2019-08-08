<?php

shell_exec("sudo python /var/www/html/script/cup.py");

header("Location: ../smart-coffee/View/viewUsers.php?success=cupTestSuccess");
exit();
?>
