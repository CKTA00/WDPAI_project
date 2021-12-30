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
    <title>Little Places - Your Announcements</title>
</head>
<body>
    <div class="base-container">
        <aside>
            <span class="user-profile">
                <img src="public/img/blank-profile-picture.svg">
                <h2> Name Surname </h2>
            </span>
            <button>
                <i class="fas fa-plus-circle"></i>
                <p>new announcement</p>
            </button>
            <h3>Your announcements:</h3>
            <div>
                <div class="announcement" id="ann1">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
    
                <div class="announcement" id="ann2">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
    
                <div class="announcement active-ann" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="announcement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="announcement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="announcement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>

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
            <div>
                <div class="property">
                    <h1>
                        <?php
                        if(isset($anns))
                            print $anns[0]->getTitle();
                        else
                            print "Title";
                        ?>
                    </h1>
                </div>
    
                <div class="property">
                    <h3>photos</h3>
                    <div class="image-container">
                        <?php
                        if(isset($anns))
                        {
                            $fileName = $anns[0]->getImageUrl();
                            print "<img src=public/uploads/".$fileName.">";
                        }

                        else
                            print '<img src="public/img/hehe.png"><img src="public/img/he.png">';
                        ?>
                        <button type="button"><i class="far fa-plus-square"></i></button>
                    </div>
                </div>
    
                <div class="property">
                    <h3>description</h3>
                    <p>
                        <?php
                        if(isset($anns))
                            print $anns[0]->getDescription();
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
                                print Announcement::getRangeName($anns[0]->getRange());
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
</html>