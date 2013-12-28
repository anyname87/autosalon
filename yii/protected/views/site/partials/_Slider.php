<?php if(!empty($mark)): ?>
<!-- Главный слайдер -->
<div class="slider-block">
	<div id="main-slider" class="carousel slide">
		<div class="carousel-inner">
			<?php foreach ($mark as $mkey => $m) { ?>
				<?php $model=$m->model ?>
				<?php if(!empty($model)): ?>
					<div class="item <?php if($mkey == 0): ?>active<?php endif; ?>">
						<img class="current-photo" src="<?=$model[0]->getAttribute('full_img')?>" alt="">
						<div class="carousel-caption">
							<div class="marks">
								<h4><?=$m->title?></h4>
								<div class="clearfix"></div>
								<img src="<?=$m->small_img?>" alt="<?=$m->title?>">
							</div>
							<ul>
								<?php foreach ($model as $modkey => $mod) { ?>
									<li><a <?php if($modkey == 0): ?>class="current-img"<?php endif; ?> href="#" data-img="<?=$mod->full_img?>"><?=$mod->title?></a></li>
								<?php } ?>
							</ul>
						</div>
						<div class="carousel-title"><?=$model[0]->getAttribute('title')?></div>
					</div>
				<?php endif; ?>
			<?php } ?>

		</div>
		<a class="left carousel-control" href="#main-slider" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#main-slider" data-slide="next">›</a>
	</div>
</div>
<!-- Главный слайдер конец. -->
<?php endif; ?>