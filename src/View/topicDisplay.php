<?php
// ob_start();
?>
<?php
if(!(isset($_GET['idTopic']))){
    foreach($topics as $topic){
    ?>
        <tr>
            <td>
                <a href="topic.php?idTopic=<?= $topic->id; ?>">
                    <?= $topic->title; ?>
                </a>
            </td>
            <td>
                <p><?= $topic->text; ?></p>
            </td>
        </tr>
    <?php
    }
}else{
    foreach($idTopic as $id){
    ?>
        <p><?=$id->title ?></p>
        <p><?=$id->text ?></p>
        <p><?=$id->id ?></p>
        <p><?=$id->ownerId ?></p>
    <?php
    }
}   

// $page_contents = ob_get_clean();
// require(__DIR__.'/page-layout.php');

?>