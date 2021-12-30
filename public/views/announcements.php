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
                <p>new annoucement</p>
            </button>
            <h3>Your announcements:</h3>
            <div>
                <div class="annoucement" id="ann1">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
    
                <div class="annoucement" id="ann2">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
    
                <div class="annoucement active-ann" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="annoucement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="annoucement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>
                <div class="annoucement" id="ann3">
                    <div>
                        <img src="public/img/he.png">
                        <h4>title</h4>
                    </div>
                    <p><i class="fas fa-map-marker-alt"></i> location name</p>
                    <h4>Followers:</h4>
                </div>

            </div>
           
        </aside>

        
        
        <main>
            <header>
                <button>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button>
                    <i class="far fa-trash-alt"></i>
                    <p>delete</p>
                </button>
                <button>
                    <i class="far fa-clone"></i>
                    <p>copy</p>
                </button>
            </header>
            <div>
                <div class="property">
                    <div>
                        <h1>title</h1>
                    </div>
                    <button>
                        <i class="far fa-edit"></i><p>edit</p>
                    </button>
                </div>
    
                <div class="property">
                    <div>
                        <h3>photos</h3>
                        <div>
                            <img src="public/img/hehe.png">
                            <img src="public/img/he.png">
                            <button><i class="far fa-plus-square"></i></button>
                        </div>
                    </div>
                    <button>
                        <i class="far fa-edit"></i><p>edit</p>
                    </button>
                </div>
    
                <div class="property">
                    <div>
                        <h3>description</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <button>
                        <i class="far fa-edit"></i><p>edit</p>
                    </button>
                </div>
    
                <div class="property">
                    <div>
                        <h3>localistaion</h3>
                        <div>
                            TODO: add map
                        </div>
                    </div>
                    <button>
                        <i class="far fa-edit"></i><p>edit</p>
                    </button>
                </div>
    
                <div class="property">
                    <div>
                        <h3>range</h3>
                        <div>
                            <select name="range" class="range-dropdown">
                                <option value="huge">Biggest (2km)</option>
                                <option value="big">Big (1km)</option>
                                <option value="medium">Medium (500m)</option>
                                <option value="small">Small (300m)</option>
                            </select>
                        </div>
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