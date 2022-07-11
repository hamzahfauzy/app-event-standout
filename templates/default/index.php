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
    </style>
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h1>Events</h1>
                    </div>
                    <!-- <ul class="event-nav-lists">
                        <li>
                            <a href="<?=routeTo('default/index')?>" class="btn active">All Events</a>
                        </li>
                        <li>
                            <a href="<?=routeTo('default/upcoming')?>" class="btn">Upcoming Events</a>
                        </li>
                    </ul> -->
                </div>
            </div>
            <div class="row row-projects">
                <?php foreach($events as $event): ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="p-2">
                            <img class="card-img-top rounded" src="<?=asset($event->thumb_url)?>" alt="Product 1">
                        </div>
                        <div class="card-body pt-2">
                            <h4 class="mb-1 fw-bold"><?=$event->name?></h4>
                            <p class="text-muted small mb-2">Last updated: <?=$event->created_at?></p>
                            <a href="<?=routeTo('default/event-detail',['id'=>$event->id])?>" class="btn btn-primary btn-block">Lihat Event</a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>