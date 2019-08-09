<?php

shell_exec("sudo python /var/www/html/script/cup.py");

header("Location: ../View/viewUsers.php?success=cupTestSuccess");
exit();
?>
