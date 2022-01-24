<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/51295bd71e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/common.css">
    <link rel="stylesheet" type="text/css" href="public/css/common-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/property.css">
    <link rel="stylesheet" type="text/css" href="public/css/property-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/announcements.css">
    <link rel="stylesheet" type="text/css" href="public/css/announcements-mobile.css">
    <script type="text/javascript" src="./public/js/announcements.js" defer></script>
    <title>Little Places - Your Announcements</title>
    <?php
        if(!isset($anns)) //TODO: probably better to do it in JS
        {
            echo "<style>";
            echo ".property,header{display: none}\n";
            echo "</style>";
        }
    ?>
</head>
<body>
    <div class="base-container">
        <aside>
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
            <button id="new-button">
                <i class="fas fa-plus-circle"></i>
                <p>new announcement</p>
            </button>
            <?php
            if($anns!=null) //TODO: probably better to do it in JS
            {
                echo "<h3>Your announcements:</h3>";
            }

            echo '<h6 class="hidden" id="focusId">'.$focusId."</h6>";
            ?>
            <div>
                <?php
                    //$i = 0;
                    if(isset($anns)) foreach ($anns as $ann)
                    {
                        echo '<div class="announcement';                                //OPEN ann div
                            if($ann->getId() == $focusId)
                                echo ' active-ann';
                            echo '" id="'.$ann->getId().'">';
//                        echo '<h6 class="hidden">'.$ann->getId().'<h6>';
                            echo '<div>';                                               //OPEN image and title div
                                $mainImg = $ann->getImages();
                                //$mainImg = $ann->getImages()[0]; //TODO: uncomment when implemented
                                if($mainImg!=null)
                                    echo '<img src="public/uploads/'.$mainImg.'">';
                                echo '<h4>'.$ann->getTitle().'</h4>';
                            echo '</div>';                                              //CLOSE image and title div
                            //TODO: get location name from mapbox api (add 2 spaces)
                            echo '<p><i class="fas fa-map-marker-alt"></i>  Kraków</p>';
                            echo '<h4>Followers:</h4>';
                            // TODO: get followers from db
                        echo '</div>';                                                  //CLOSE ann div
                        //$i++;
                    }
                ?>
            </div>
           
        </aside>
        
        <main class="main">
            <header>
                <button>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button>
                    <i class="far fa-edit"></i>
                    <p>edit</p>
                </button>
                <button>
                    <i class="far fa-clone"></i>
                    <p>copy</p>
                </button>
                <button>
                    <i class="far fa-trash-alt"></i>
                    <p>delete</p>
                </button>
            </header>
            <div> <?php
                foreach ($messages as $msg)
                {
                    print '<div class="message"><p>';

                    print $msg.'</p></div>';
                }
                ?>
                <div class="property">
                    <h1>
                        <?php

                        if(isset($anns))
                            print $anns[$focusAnnIndex]->getTitle();
                        else
                            print "Title";
                        ?>
                    </h1>
                </div>
    
                <div class="property">
                    <h3>images</h3>
                    <div class="image-container">
                        <?php
                        $ann = $anns[$focusAnnIndex];
                        if($ann!=null)
                        {
                            //$imgJSON = $ann->getImages(); //TODO: Show all images from json
                            $fileName = $ann->getImages();
                            print "<img src=public/uploads/".$fileName.">";
                        }
                        else{
                            echo '<p>No images</p>';
                        }
                        ?>
                    </div>
                </div>
    
                <div class="property">
                    <h3>description</h3>
                    <p>
                        <?php
                        if(isset($anns))
                            print $anns[$focusAnnIndex]->getDescription();
                        else
                            print "Description";
                        ?>
                    </p>
                </div>
    
                <div class="property">
                    <div>
                        <h3>location</h3>
                        <div>
                            TODO: add map
                        </div>
                    </div>
                </div>
    
                <div class="property">
                    <div>
                        <h3>range</h3>
                        <p>
                            <?php
                            if(isset($anns))
                                print Announcement::getRangeName($anns[$focusAnnIndex]->getRange());
                            else
                                print Announcement::getRangeName(4);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </main>


        <nav>
            <div class="main-buttons">
                <button>
                    <i class="fas fa-map-marked-alt"></i>
                </button>
                <button>
                    <i class="fas fa-comments"></i>
                </button>
                <button id="active-tab">
                    <i class="fas fa-clipboard-list" id="active-tab"></i>
                </button>
            </div>
            <button>
                <i class="fas fa-cog"></i>
            </button>
        </nav>
    </div>
</body>

<template id="announcement-properties">
    <div class="property">
        <h1>
            Title
        </h1>
    </div>

    <div class="property">
        <h3>images</h3>
        <div class="image-container">
            <!--
            <img src=public/uploads/">
            -->
            <p>No images</p>
        </div>
    </div>

    <div class="property">
        <h3>description</h3>
        <p>
            Description
        </p>
    </div>

    <div class="property">
        <div>
            <h3>location</h3>
            <div>
                TODO: add map
            </div>
        </div>
    </div>

    <div class="property">
        <div>
            <h3>range</h3>
            <p>
                rangename
            </p>
        </div>
    </div>

</template>



</html>