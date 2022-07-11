<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= asset('assets/img/user-placeholder.png')?>" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <?php if(auth() && isset(auth()->user)): ?>
                    <a href="">
                        <span>
                            <?=auth()->user->name?>
                            <span class="user-level" style="text-transform:capitalize;"><?=get_role(auth()->user->id)->name?></span>
                        </span>
                    </a>
                    <?php else: ?> 
                    <a href="">
                        <span>
                            Guest
                            <span class="user-level" style="text-transform:capitalize;">Guest</span>
                        </span>
                    </a>
                    <?php endif ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <?= generated_menu(auth() && isset(auth()->user) ? auth()->user->id : 'guest') ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->