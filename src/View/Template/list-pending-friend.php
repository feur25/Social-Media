<?php
foreach($requests as $request){
    if($request->first_user_id == $_SESSION['userId']){

?>
    <p><?=$request->second_user_id ?></p>
        <form  class="friend" method="get" action="">
            <button id="declineRequest" name="declineRequest" value="<?= $request->second_user_id ?>" >Cancel</button>
        <form>
    <br>
<?php 
    }
}
?>