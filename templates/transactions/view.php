<?php load_templates('layouts/top') ?>
    <style>
    #<?=$transaction->stand->pic_id?> {
        stroke:red;
        stroke-width:2px;
    }
    </style>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Detail transaksi anda</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data transaksi anda</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-hover table-sales">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <p><?=$transaction->customer->name?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <p><?=$transaction->customer->email?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">No. WA</label>
                                    <p><?=$transaction->customer->phone?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Metode Pembayaran</label>
                                    <p>Cash</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stand</label>
                                    <p><?=$transaction->stand->name?> - Rp. <?=number_format($transaction->stand->price)?></p>
                                    <center>
                                        <?=file_get_contents($transaction->stand->event->pic_url)?>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>