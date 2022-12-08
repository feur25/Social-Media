<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

<body>
    <div class="home">
        <div class="nav">
                <div class="profil_picture">
                </div>
                <div class="link">
                    <p> Main </p>
                </div>
                <div class="link">
                    <p>Friends</p>
                    </div>
                <div class="link">
                    <p>Messages</p>
                    </div>
                <div class="link">
                    <p>Contact</p>
                </div>
        </div>
        <div class="content">
            
            <div class="friends">
                <p>bouh</p>
                <p>bouh</p>
            
            </div>
            <div class="post">
                
                <div class="top-bost"> 
                    <p>bouh</p>
                </div>
                <div class="rod">
                </div>      
                <div class="post-content">
                    <p>bouh</p>
                </div>
            </div>
        
        </div>
    </div>
</body>



<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>