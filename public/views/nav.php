<nav>
    <div class="main-buttons">
        <button <?php if($activeTab==1) echo 'id="active-tab"'?>>
            <i class="fas fa-map-marked-alt" <?php if($activeTab==1) echo 'id="active-tab"'?>></i>
        </button>
        <button <?php if($activeTab==2) echo 'id="active-tab"'?>>
            <i class="far fa-eye" <?php if($activeTab==2) echo 'id="active-tab"'?>></i>
        </button>
        <button <?php if($activeTab==3) echo 'id="active-tab"'?>>
            <i class="fas fa-id-badge" <?php if($activeTab==3) echo 'id="active-tab"'?>></i>
        </button>
    </div>
    <button <?php if($activeTab==4) echo 'id="active-tab"'?>>
        <i class="fas fa-cog" <?php if($activeTab==4) echo 'id="active-tab"'?>></i>
    </button>
</nav>