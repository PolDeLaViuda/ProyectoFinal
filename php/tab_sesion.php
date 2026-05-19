<?php
$_nuevo_login = !empty($_SESSION['nuevo_login']);
if ($_nuevo_login) unset($_SESSION['nuevo_login']);
?>
<script>
(function () {
    <?php if ($_nuevo_login): ?>
    sessionStorage.setItem('sz_tab', '1');
    <?php else: ?>
    if (!sessionStorage.getItem('sz_tab')) {
        window.location.replace('php/cerrar_sesion.php');
    } else {
        sessionStorage.setItem('sz_tab', '1');
    }
    <?php endif; ?>
})();
</script>
