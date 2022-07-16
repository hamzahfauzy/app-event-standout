<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Transaksi anda</h2>
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
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <th>Kustomer</th>
                                            <th>Invoice</th>
                                            <th>Stand</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($transactions as $index => $transaction): ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <td><?=$transaction->customer?$transaction->customer->name:'-'?></td>
                                            <td><a href="<?=routeTo('transactions/view',['id'=>$transaction->id])?>"><?=$transaction->invoice_code?></a></td>
                                            <td>
                                                <?=$transaction->stand->name?><br>
                                                <i><a href="<?=routeTo('default/event-detail',['id'=>$transaction->stand->event_id])?>"><?=$transaction->stand->event->name?></a></i>
                                            </td>
                                            <td><?=number_format($transaction->amount)?></td>
                                            <td><?=$transaction->status?></td>
                                            <td>
                                                <?php if($transaction->status == 'checkout'): ?>
                                                <a href="<?=routeTo('transactions/confirm',['id'=>$transaction->id])?>" onclick="if(confirm('Apakah anda yakin akan mengkonfirmasi pembayaran ini ?')){return true}else{return false}" class="btn btn-success btn-sm">Konfirmasi</a>
                                                <a href="<?=routeTo('transactions/decline',['id'=>$transaction->id])?>" onclick="if(confirm('Apakah anda yakin akan menolak pembayaran ini ?')){return true}else{return false}" class="btn btn-danger btn-sm">Tolak</a>
                                                <?php elseif($transaction->status == 'UNPAID') : ?>
                                                <i>Menunggu Pembayaran</i>
                                                <?php else : ?>
                                                <i>Selesai</i>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>