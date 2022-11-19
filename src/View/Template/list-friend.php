<?php 
foreach($friends as $friend){
    if($friend[0] != null){
    ?>
        <p><?= $friend[0] ?></p>
<?php 
    }
}
?>