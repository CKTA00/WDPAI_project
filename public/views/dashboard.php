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
                <h3> <?php echo $header_message; ?> </h3>
                <div>
                <?php
                $i = 0;
                if(is_array($anns)) foreach ($anns as $ann)
                {
                    echo '<div class="announcement" id="'.$ann->getId().'">';
                    $mainImg = $ann->getImages();
                    if($mainImg!=null)
                        echo '<img src="public/uploads/'.$mainImg.'">';
                    echo '<h4>'.$ann->getTitle().'</h4>';
                    echo '<label class="hidden">'.$ann->getLocation().'</label>';
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
            <div id="full-map">

            </div>
        </main>
        <?php include "nav.php"; ?>
    </div>
</body>

<template id="announcement-details">
    <div class="ann-detail">
        <img>
        <h2>title</h2>
        <p id="time"><i class="fas fa-clock"></i>  time of post</p>
        <p id="location"><i class="fas fa-map-marker-alt"></i>&nbsp;loading...</p>
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
        <h3 class="bio">bio</h3>
    </div>
</template>

<template id="loader">
    <div class="loader"></div>
</template>