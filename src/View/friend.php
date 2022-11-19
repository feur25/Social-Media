<?php 
    ob_start();
?>
    <form action="" method="post">
        <input type="submit" name="request" value="Reçu">
        <input type="submit" name="receive" value="Tes Demandes en Attente">
        <input type="submit" name="friend" value="Amis">
    </form>
    <form action="" method="get">
        <input  type="text" name="sendRequest" placeholder="name or email to send" />
        <input type="submit">
    </form>
<?php
    $page_contents = ob_get_clean();
    require(__DIR__.'/Template/page-layout.php');
?>