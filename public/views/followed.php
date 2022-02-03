<!DOCTYPE html>
<html>
<?php
$header_message = "Announcements you are following:";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $header_message ?></title>

    <script src="https://kit.fontawesome.com/51295bd71e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">
    <link rel="stylesheet" type="text/css" href="public/css/common.css">
    <link rel="stylesheet" type="text/css" href="public/css/common-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/aside-button.css">
    <link rel="stylesheet" type="text/css" href="public/css/dashboard.css">

    <link rel="stylesheet" type="text/css" href="public/css/map.css">
    <script type="text/javascript" src="./map-config.js" defer></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>

    <script type="text/javascript" src="./public/js/navigation.js" defer></script>
    <script type="text/javascript" src="./public/js/dashboard.js" defer></script>
</head>

<?php
include "dashboard.php";
?>

</html>