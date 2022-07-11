<?php load_templates('layouts/top') ?>
    <style>
    #<?=$pic_style?> {
        stroke:red;
        stroke-width:2px;
    }
    </style>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat <?=_ucwords($table)?> Baru</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords($table)?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    <a href="<?=routeTo('stands/index',['event_id'=>$event->id])?>" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($error_msg): ?>
                            <div class="alert alert-danger"><?=$error_msg?></div>
                            <?php endif ?>
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="doSubmit();return false;" id="formStand">
                                <input type="hidden" name="stands[event_id]" value="<?=$event->id?>">
                                <input type="hidden" name="stands[pic_id]" value="<?=$pic_id?>">
                                <input type="hidden" name="new_svg_content" value="">
                                <?php 
                                foreach(config('fields')[$table] as $key => $field): 
                                    $label = $field;
                                    $type  = "text";
                                    if(is_array($field))
                                    {
                                        $field_data = $field;
                                        $field = $key;
                                        $label = $field_data['label'];
                                        if(isset($field_data['type']))
                                        $type  = $field_data['type'];
                                    }
                                    $label = _ucwords($label);
                                ?>
                                <div class="form-group">
                                    <label for=""><?=$label?></label>
                                    <?= Form::input($type, $table."[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                                </div>
                                <?php endforeach ?>
                                <div class="form-group">
                                    <label for="">Thumbnail</label>
                                    <input type="file" name="thumb_file" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Stand Position</label>
                                    <?=file_get_contents($event->pic_url)?>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.querySelectorAll('rect').forEach(el => {
        el.onclick = function(){
            var id = document.querySelector('input[name="stands[pic_id]"]').value
            if(el.id && el.id != id) return;
            document.querySelectorAll('rect').forEach(e => {
                if(e.id == id){
                    e.removeAttribute('id')
                }
            })
            if(event.target.id && event.target.id != id) return;
            event.target.id = id
        }
    })
    function doSubmit()
    {
        event.preventDefault();
        document.querySelector('input[name=new_svg_content]').value=document.querySelector('svg').outerHTML;
        document.querySelector('#formStand').submit()
    }
    </script>
<?php load_templates('layouts/bottom') ?>