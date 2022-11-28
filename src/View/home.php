<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>


<p class="header_titre">Social-Media</p>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>