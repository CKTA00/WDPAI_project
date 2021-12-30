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
    <title>Little Places - Your Announcements</title>
</head>
<body>
    <div class="base-container">
        <form class="main" action="new_announcement" method="POST" enctype="multipart/form-data">
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
                <div class="property">
                    <?php
                    if(isset($messages))
                    {
                        foreach ($messages as $msg)
                        {
                            echo "<p>".$msg."</p>";
                        }
                    }
                    ?>
                    <div>
                        <h3>title</h3>
                        <textarea class="title" name="title" cols="500" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>title</textarea>
                    </div>
                </div>

                <div class="property">
                    <h3>photos</h3>
                    <div class="image-container">

                        <img src="public/img/he.png">
                        <div class="new_upload">
                            <span>chose your file:</span>
                            <input type="file" name="file">
                        </div>
                        <button type="button"><i class="far fa-plus-square"></i></button>
                    </div>
                </div>

                <div class="property">
                    <h3>description</h3>
                    <textarea class="description" name="description" cols="500" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                </div>

                <div class="property">
                    <h3>location</h3>
                    <div>
                        TODO: add map
                    </div>
                </div>

                <div class="property">
                    <h3>range</h3>
                    <div>
                        <select name="range" class="range-dropdown">
                            <?php
                            for($i = 1; $i<=4; $i++)
                            {
                                echo "<option value=".$i.">".Announcement::getRangeName($i)."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

        </form>


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