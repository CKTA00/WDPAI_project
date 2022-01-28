<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?= $title2 ?></title> -->
    
    <script src="https://kit.fontawesome.com/51295bd71e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/common.css">
    <link rel="stylesheet" type="text/css" href="public/css/common-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/aside-button.css">
    <link rel="stylesheet" type="text/css" href="public/css/dashboard.css">
    <script type="text/javascript" src="./public/js/navigation.js" defer></script>
    <script type="text/javascript" src="./public/js/dashboard.js" defer></script>
    <title>Little Places - Map</title>
</head>
<body>
    <div class="base-container">
        <aside>

        </aside>
        <main>
            <header>
                <button>
                    <i class="fas fa-map"></i>
                    <p>map view</p>
                </button>
                <button>
                    <i class="fas fa-th-large"></i>
                    <p>grid view</p>
                </button>
            </header>
            <div class="grid-view"> <?php
                if(isset($messages))
                {
                    foreach ($messages as $msg)
                    {
                        print '<div class="message"><p>';

                        print $msg.'</p></div>';
                    }
                }
                ?>
                <h2>TO-DO: add map here.</h2>
                <h3> Ogłoszenia w twojej okolicy:</h3>
                <div>
                <?php
                $i = 0;
                if(isset($anns)) foreach ($anns as $ann)
                {
                    echo '<div class="announcement" id="'.$ann->getId().'">';
                    $mainImg = $ann->getImages();
                    //$mainImg = $ann->getImages()[0]; //TODO: uncomment when implemented
                    if($mainImg!=null)
                        echo '<img src="public/uploads/'.$mainImg.'">';
                    echo '<h4>'.$ann->getTitle().'</h4>';

                    //TODO: get location name from mapbox api (add 2 spaces)
                    echo '<p><i class="fas fa-map-marker-alt"></i>&nbsp;Kraków</p>';
                    $owner = $ann->getOwner();
                    $profileImage = $owner->getImage();
                        echo '<div class="mini-user-profile">';                              //OPEN owner div
                        if(isset($profileImage))
                            echo '<img src="public/uploads/'.$owner->getImage().'">';
                        else
                            echo '<img src="public/img/blank-profile-picture.svg">';
                        echo '<h2>'.$owner->getName().' '.$owner->getSurname().'</h2>';
                        echo '</div>';                                                  //CLOSE owner div
                    echo '</div>';                                                      //CLOSE ann div
                    $i++;
                }
                ?>
                </div>
            </div>
        </main>
        <nav>
            <div class="main-buttons">
                <button id="active-tab">
                    <i class="fas fa-map-marked-alt" id="active-tab"></i>
                </button>
                <button>
                    <i class="fas fa-comments"></i>
                </button>
                <button>
                    <i class="fas fa-clipboard-list"></i>
                </button>
            </div>
            <button>
                <i class="fas fa-cog"></i>
            </button>
        </nav>
    </div>
</body>

<template id="announcement-details">
    <div class="ann-detail">
        <img>
        <h2>title</h2>
        <p id="time"><i class="fas fa-clock"></i>  time of post</p>
        <p id="location"><i class="fas fa-map-marker-alt"></i>  location</p>
        <h6 id="description">description</h6>
    </div>
    <div class="footer">
        <button id="follow"></button>
        <button id="back-to-map">back to map</button>
        <hr>
        <span class="mini-user-profile">
            <img class="owner">
            <h2></h2>
        </span>
        <button id="chat"> send message </button>
    </div>
</template>

<template id="loader">
    <div class="loader"></div>
</template>