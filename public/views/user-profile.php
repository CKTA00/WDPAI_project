<span class="user-profile">
     <?php
     if(isset($profileImage))
     {
         echo '<img src="public/uploads/'.$profileImage.'">';
     }
     else
         echo '<img src="public/img/blank-profile-picture.svg">';

     if(isset($username))
     {
         echo'<h2> '.$username.'</h2>';
     }
     else
         echo '<h2>username missing</h2>';

     ?>
</span>
