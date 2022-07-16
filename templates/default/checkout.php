<?php load_templates('layouts/top') ?>
    <style>
    ul.event-nav-lists {
        padding:0;
        margin:0;
        margin-bottom:20px;
    }
    ul.event-nav-lists li {
        list-style-type: none;
        display:inline-block;
    }
    ul.event-nav-lists li a.active {
        color:#FFF;
        background: #1572e8!important;
        border-color: #1572e8!important;
    }
    .selected {
        stroke:red;
        stroke-width:2px;
    }
    </style>
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
            <div class="row row-projects">
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <div class="card-body p-2">
                            <form action="" method="post">
                                <input type="hidden" name="stand_id" value="<?=$stand->id?>">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">No. WA</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Metode Pembayaran</label>
                                    <select name="pg_request[method]" id="" class="form-control">
                                        <option value="">- Pilih Metode Pembayaran -</option>
                                        <option value="transfer">Transfer Bank (Manual)</option>
                                        <option value="tripay">Tripay</option>
                                    </select>
                                </div>
                                <div class="form-group tripay" style="display:none">
                                    <label for="">Pembayaran</label>
                                    <select name="pg_request[type]" class="form-control">
                                        <option value="" selected>- Pilih -</option>
                                        <?php foreach($channels['data'] as $channel): ?>
                                            <option value="<?=$channel['code']?>"><?=$channel['name']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Place Order</button>
                                    <a href="<?=routeTo('default/event-detail',['id' => $stand->event_id])?>" class="btn btn-warning">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="p-2">
                            <img src="<?=asset($stand->thumb_url)?>" alt="" width="100%">
                        </div>
                        <div class="card-body pt-2 text-center">
                            <h4 class="mb-1 fw-bold"><?=$stand->name?></h4>
                            <p class="text-muted small mb-2">Rp. <?=number_format($stand->price)?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.querySelectorAll('rect').forEach(el => {
        el.onclick = function(){
            document.querySelectorAll('rect').forEach(e => {
                e.classList.remove('selected')
                if(e.id)
                {
                    document.querySelector('#'+e.id).classList.add('d-none')
                }
            })
            el.classList.add('selected')
            if(el.id)
            {
                document.querySelector('#selected_stand').innerHTML = ""
                document.querySelector('#'+el.id).classList.remove('d-none')
            }
            else
            {
                document.querySelector('#selected_stand').innerHTML = "<i>Stand yang dipilih tidak valid</i>";
            }
            // var id = document.querySelector('input[name="stands[pic_id]"]').value
            // if(el.id && el.id != id) return;
            // event.target.id = id
        }
    })

    document.querySelector("[name='pg_request[method]']").addEventListener("change", e => {
        if(e.target.value == 'tripay')
        {
            document.querySelector('.tripay').style.display = "block";
        }
        else
        {
            document.querySelector('.tripay').style.display = "none";
        }
    })
    </script>
<?php load_templates('layouts/bottom') ?>