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
    <link rel="stylesheet" type="text/css" href="public/css/map.css">
    <script type="text/javascript" src="./map-config.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script type="text/javascript" src="./public/js/navigation.js" defer></script>
    <script type="text/javascript" src="./public/js/simple_back.js" defer></script>
    <script type="text/javascript" src="./public/js/message_popup.js" defer></script>
    <script type="text/javascript" src="./public/js/edit_map.js" defer></script>
    <title>Little Places - Your Announcements</title>
</head>
<body>
    <div class="base-container">
        <form class="main" action=<?php echo $imageRequired?'"new_announcement"':'"edit_announcement"'; ?> method="POST" enctype="multipart/form-data">
            <header>
                <button type="button">
                    <i class="fas fa-chevron-left"></i>
                    <p>cancel</p>
                </button>
                <button type="submit">
                    <i class="fas fa-check"></i>
                    <p>save</p>
                </button>
            </header>
            <div>
                <?php
                if(isset($id))
                {
                    echo '<input type="hidden" name="id" value="'.$id.'">';
                }
                ?>
                <div class="property">
                    <div>
                        <h3>title</h3>
                        <textarea class="title" name="title" cols="500" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php if(isset($ann)) echo $ann->getTitle(); ?></textarea>
                    </div>
                </div>

                <div class="property">
                    <h3>image</h3>
                    <div class="image-container">
                        <?php if(isset($ann)) echo '<img src="public/uploads/'.$ann->getImages().'">'; ?>
                        <div class="new_upload">
                            <span><p><?php echo $imageRequired?"upload image (required)":"replace previous image"; ?></p></span>
                            <input type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="property">
                    <h3>description</h3>
                    <textarea class="description" name="description" cols="500" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php if(isset($ann)) echo $ann->getDescription(); ?></textarea>
                </div>

                <div class="property">
                    <h3>location</h3>
                    <textarea class="location" name="location" cols="100"><?php if(isset($ann)) echo $ann->getLocation(); ?></textarea>
                    <div id="map">

                    </div>
                </div>
            </div>
        </form>
        <?php include "nav.php"; ?>
    </div>
    <?php include "messages.php"; ?>
</body>
</html>