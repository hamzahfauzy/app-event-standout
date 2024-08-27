<?php load_templates('layouts/top') ?>
    <style>
    .selected {
        stroke:red;
        stroke-width:2px;
    }
    .denah svg {
        width: 100%;
    }

    <?=$pic_style?> {
        stroke:red;
        stroke-width:2px;
    }
    </style>
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h1><?=$event->name?></h1>
                    </div>
                </div>
            </div>
            <div class="row row-projects">
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-body p-2 denah">
                            <h3 class="text-center">Denah Event</h3>
                            <?=file_get_contents($event->pic_url)?>
                            <div id="selected_stand"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <?php foreach($stands as $stand): ?>
                    <div class="card d-none <?=$stand->transaction ? 'sold' : ''?>" id="<?=$stand->pic_id?>">
                        <div class="p-2">
                            <img src="<?=asset($stand->thumb_url)?>" alt="" width="100%">
                        </div>
                        <div class="card-body pt-2 text-center">
                            <h4 class="mb-1 fw-bold"><?=$stand->name?></h4>
                            <p class="text-muted small mb-2">Rp. <?=number_format($stand->price)?></p>
                            <?php if(auth() && isset(auth()->user)): ?>
                            <a href="<?=routeTo('default/checkout',['id'=>$stand->id])?>" class="btn btn-primary btn-block">Checkout</a>
                            <?php else: ?>
                            <a href="<?=routeTo('auth/login')?>" class="btn btn-primary btn-block">Login untuk melanjutkan</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.querySelectorAll('path').forEach(el => {
        el.onclick = function(){
            document.querySelectorAll('path').forEach(e => {
                e.classList.remove('selected')
                if(e.id)
                {
                    document.querySelector('.card#'+e.id).classList.add('d-none')
                }
            })
            if(document.querySelector('.card#'+el.id).classList.contains('sold')) return
            
            el.classList.add('selected')
            if(el.id)
            {
                document.querySelector('#selected_stand').innerHTML = ""
                document.querySelector('.card#'+el.id).classList.remove('d-none')
            }
            else
            {
                document.querySelector('#selected_stand').innerHTML = "<i>Stand yang dipilih tidak valid</i>";
            }
        }
    })
    </script>
<?php load_templates('layouts/bottom') ?>