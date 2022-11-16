<?php
ob_start();
?>

<p class="header_titre">Social-Media</p>

<form class="create-task-form" method="get" action="task/create">
    
    <input type="text" id="description" name="description"/>
    <input type="number" id="priority" name="priority" value="1" min="1" max="3">
    <button id="envoyer">Créer</button>
    
</form>

<a id="download-button" href="/download">Télécharger la liste des tâches</a>

<div>

    <!-- <table>
        <?php
            foreach ($tasks as $task) { 
                ?>
                    <tr>
                        <div class="task">
                            <td>
                                <h1 class="<?= ($task->priority == 1 ? 'vert' : ($task->priority == 2 ? 'jaune' : 'rouge')); ?>" >
                                    <?= $task->description; ?>
                                </h1>
                            </td>
                            <td>
                                <p><?= $task->priority; ?></p>
                            </td>
                            <td>
                                <a href="task/delete?id=<?= $task->id; ?>" class="rouge warning">X</a>
                            </td>
                        </div>
                    </tr>
                <?php
            }
        ?>
    </table> -->

</div>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>