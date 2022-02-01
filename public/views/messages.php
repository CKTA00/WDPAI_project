<?php
if(is_array($messages) && count($messages)>0)
{
    echo '<div class="messages">';
    foreach ($messages as $msg)
    {
        print '<p>'.$msg.'</p>';
    }
    echo '</div>';
}

//if(isset($messages))
//{
//    foreach ($messages as $msg)
//    {
//        echo "<div class='property warning'>";
//        echo "<p><i class='fas fa-exclamation-circle'></i> ".$msg."</p>";
//        echo "</div>";
//    }
//}
