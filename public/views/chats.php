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
    <link rel="stylesheet" type="text/css" href="public/css/chats.css">
    <link rel="stylesheet" type="text/css" href="public/css/chats-mobile.css">
    <title>Little Places - Your Messages</title>
</head>
<body>
    <div class="base-container">
        <aside>
            <div class="person">
                <div class="user-profile">
                    <img src="public/img/blank-profile-picture.svg">
                    <h2> Name Surname </h2>
                </div>
                
                <h3>User announcements:</h3>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
            </div>

            <div class="person active-person">
                <div class="user-profile">
                    <img src="public/img/blank-profile-picture.svg">
                    <h2> Name Surname </h2>
                </div>
                
                <h3>User announcements:</h3>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
            </div>

            <div class="person">
                <div class="user-profile">
                    <img src="public/img/blank-profile-picture.svg">
                    <h2> Name Surname </h2>
                </div>
                
                <h3>User announcements:</h3>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
            </div>

            <div class="person">
                <div class="user-profile">
                    <img src="public/img/blank-profile-picture.svg">
                    <h2> Name Surname </h2>
                </div>
                
                <h3>User announcements:</h3>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
            </div>

            <div class="person">
                <div class="user-profile">
                    <img src="public/img/blank-profile-picture.svg">
                    <h2> Name Surname </h2>
                </div>
                
                <h3>User announcements:</h3>
                <div class="user-ann">
                    <img src="public/img/he.png">
                    <h4>title</h4>
                </div>
            </div>

            
        </aside>
        
        <main>
            <header>
                <button>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <p>chat with Name Surname</p>
            </header>
            <div class="chatbox">
                <div class="send message">
                    <img src="public/img/blank-profile-picture.svg">
                    <div>ok</div>
                </div>
    
                <div class="separator">
                    <h6> 27th December </h6>
                </div>
    
                <div class="received message">
                    <img src="public/img/blank-profile-picture.svg">
                    <div> message send </div>
                </div>
    
                <div class="received message">
                    <img src="public/img/blank-profile-picture.svg">
                    <div> multiple line test <br> line 2 </div>
                </div>
    
                <div class="separator">
                    <h6> 26th December </h6>
                </div>
    
                <div class="received message">
                    <img src="public/img/blank-profile-picture.svg">
                    <div> wrapping test: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Neque sodales ut etiam sit amet nisl purus in mollis. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. In vitae turpis massa sed elementum. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Consequat interdum varius sit amet mattis vulputate enim nulla aliquet. Arcu vitae elementum curabitur vitae nunc sed velit dignissim. Adipiscing elit pellentesque habitant morbi tristique. Amet mauris commodo quis imperdiet. Auctor urna nunc id cursus metus. Venenatis a condimentum vitae sapien pellentesque habitant. Urna cursus eget nunc scelerisque viverra. Massa massa ultricies mi quis hendrerit dolor. Sed tempus urna et pharetra. </div>
                </div>
            </div>
            <div class="input-line"> 
                <textarea type="text" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                <button>
                    <i class="fas fa-arrow-right"></i>
                </button>
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
</html>