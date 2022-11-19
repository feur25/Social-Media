<?php
foreach($requests as $request){
    if($request->second_user_id == $_SESSION['userId']){

?>
    <p><?=$request->second_user_id ?></p>
        <form  class="friend" method="get" action="">
            <button id="acceptRequest" name="acceptRequest" value="<?= $request->first_user_id ?>">Accept</button>
            <button id="declineRequest" name="declineRequest" value="<?= $request->first_user_id ?>" >Decline</button>
        <form>
    <br>
<?php 
    }
}
?>