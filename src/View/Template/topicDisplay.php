<?php
ob_start();
?>


<?php

    if (isset($topic)) {
        
        ?>

            <tr>
                <div class="topic">
                    <td>
                        <p><?= $topic->title ?></p>
                        <p><?= $topic->content ?></p>
                        <p><?= $topic->id ?></p>
                        <p><?= $topic->ownerId ?></p>
                    </td>
                </div>
        <?php
        if (isset($responses)) {
            foreach($responses as $response){

                ?>

                    <div class="response">
                        <td>
                            <p><?=$response->content ?></p>
                        </td>
                    </div>

                <?php
            }
        }
        ?>

            <!-- <input name="Button"
                type="button"
                id="submit"
                value="Button" />
            </tr>
            <?php 
            if(isset($_POST['Button'])){
            ?>
            <form class="topic-response" method="post" action="">
                <input type="text" id="response_content" name="response_content"/>
                <button id="envoyer">Submit</button>         
            </form>
            <?php 
            }
            ?> -->

        <?php

    }

    if(isset($topics)) {
        foreach($topics as $topic){
            ?>
                <div class="topic-preview">
                    <td>
                        <a href="topic.php?id=<?= $topic->id; ?>">
                            <?= $topic->title; ?>
                        </a>
                    </td>
                    <td>
                        <p><?= $topic->content; ?></p>
                    </td>
                </div>
            <?php
        }
    }

$page_contents = ob_get_clean();
// require(__DIR__.'/Template/page-layout.php');

?>