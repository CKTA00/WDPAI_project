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
    <title>Little Places - Map</title>
</head>
<body>
    <div class="base-container">
        <main>
            <h2>TO-DO: add map here.</h2>
            <h1> Ogłoszenia w twojej okolicy:</h1>
            <div>
                <?php foreach($notices as $item): ?>
                <p> <?= $item->getTitle(); ?> </p>
                <img src=<?= $item->getImageUrl()?>>
                <?php endforeach; ?>
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