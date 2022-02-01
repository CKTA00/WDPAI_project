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
    <link rel="stylesheet" type="text/css" href="public/css/options.css">
    <link rel="stylesheet" type="text/css" href="public/css/options-mobile.css">
    <script type="text/javascript" src="./public/js/navigation.js" defer></script>
    <script type="text/javascript" src="./public/js/options.js" defer></script>
    <script type="text/javascript" src="./public/js/mobile_back.js" defer></script>
    <title>Little Places - Your Announcements</title>
</head>
<body>
    <div class="base-container">
        <aside>
            <?php include('user-profile.php') ?>
            <hr>
            <button>
                <i class="fas fa-sign-out-alt" style="transform: scaleX(-1);"></i>
                <p>log out</p>
            </button>
            <hr>
            <button>
                <i class="fas fa-user-circle"></i>
                <p>edit profile</p>
            </button>
            <hr>
        </aside>
        <main>
        </main>
        <?php include "nav.php"; ?>
    </div>
</body>

<template id="user-profile-details">
    <!--    TODO: add editing other user data -->
    <header>
        <button id="back-button">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="save-button">
            <i class="fas fa-check"></i>
            <p>save</p>
        </button>
    </header>
    <div id="option-details">
        <form action="changeProfileImage" method="POST" enctype="multipart/form-data">
            <div class="property">
                <h3>profile image</h3>
                <div class="image-container">
                    <div class="new_upload">
                        <span><p>chose your file:</p></span>
                        <input type="file" name="file">
                        <!--TODO: if enough time, add button for just deleting image-->

                    </div>
                    <button id="delete-profile-picture" type="button">
                        <p>delete profile picture</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
</html>

