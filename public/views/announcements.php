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
    <link rel="stylesheet" type="text/css" href="public/css/aside-button.css">
    <link rel="stylesheet" type="text/css" href="public/css/property.css">
    <link rel="stylesheet" type="text/css" href="public/css/property-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/announcements.css">
    <link rel="stylesheet" type="text/css" href="public/css/announcements-mobile.css">

    <link rel="stylesheet" type="text/css" href="public/css/map.css">
    <script type="text/javascript" src="./map-config.js"></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>

    <script type="text/javascript" src="./public/js/announcements.js" defer></script>
    <script type="text/javascript" src="./public/js/mobile_back.js" defer></script>
    <script type="text/javascript" src="./public/js/navigation.js" defer></script>
    <script type="text/javascript" src="./public/js/message_popup.js" defer></script>
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
            <?php include('user-profile.php') ?>
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
                        echo '</div>';                                                  //CLOSE ann div
                        //$i++;
                    }
                ?>
            </div>
           
        </aside>
        
        <main class="main">
            <header>
                <button id="back-button">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="edit-button">
                    <i class="far fa-edit"></i>
                    <p>edit</p>
                </button>
                <button id="delete-button">
                    <i class="far fa-trash-alt"></i>
                    <p>delete</p>
                </button>
            </header>
            <div id="properties"></div>
        </main>
        <?php include "nav.php"; ?>
    </div>
    <?php
    include "messages.php";
    ?>
</body>

<template id="announcement-properties">
    <div class="property">
        <h1>
            Title
        </h1>
    </div>

    <div class="property">
        <h3>image</h3>
        <div class="image-container">
            <img>
        </div>
    </div>

    <div class="property">
        <h3>description</h3>
        <p id="description">
            Description
        </p>
    </div>

    <div class="property">
        <h3>location</h3>
        <div id="map">

        </div>
    </div>

    <div class="property">
        <h3>range</h3>
        <p id="range">
            rangename
        </p>
    </div>

</template>

<template id="loader">
    <div class="loader"></div>
</template>


</html>