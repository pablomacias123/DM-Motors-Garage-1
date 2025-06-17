    <?php
session_start();
session_unset(); // Limpia variables de sesión
session_destroy();
header("Location: login_form.html");
exit();
?>

