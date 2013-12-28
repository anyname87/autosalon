<?php if($model): ?>
<div class="detail-block">
	<div class="detail-img">
		<img src="<?=$model->full_img?>" alt="<?=$model->title?>">
	</div>
	<div class="detail-gallery-two-coll">
		<ul class="two-coll">
			<li>
				<a href="/assets/auto/gallery/1/1/1.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/1.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/2.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/2.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/3.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/3.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/4.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/4.jpg" alt="<?=$model->title?>">
				</a>
			</li>
		</ul>
		
		<ul class="two-coll">
			<li>
				<a href="/assets/auto/gallery/1/1/1.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/1.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/2.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/2.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/3.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/3.jpg" alt="<?=$model->title?>">
				</a>
			</li>
			<li>
				<a href="/assets/auto/gallery/1/1/4.jpg" title="<?=$model->title?>" rel="photo_group">
					<img src="/assets/auto/gallery/1/1/4.jpg" alt="<?=$model->title?>">
				</a>
			</li>
		</ul>
		
	</div>
	<h1><?=$model->price?> руб.</h1>
	<div class="clearfix"></div>
	<div class="text-block">
		<div class="paragraph">
            <h2><?=$model->title?></h2>
			<p>
				<?=$model->description?>
			</p>
            <h3>Комплектации:</h3>
            <div class="accordion" id="accordion2">
			  <div class="accordion-group">
			    <div class="accordion-heading">
			    	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
			        	1.3 МТ (75 л.с.)
			    	</a>
			    </div>
			    <div id="collapse1" class="accordion-body collapse">
			    	<div class="accordion-inner">
				        Мощ. двигателя: 300 л.с.<br />
						Коробка передач: автомат<br />
						Макс. скорость: 220 км/ч<br />
			    	</div>
			    </div>
			  </div>
			  <div class="accordion-group">
			    <div class="accordion-heading">
			      	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
			    		1.5 МТ (103 л.с.)
			      	</a>
			    </div>
			    <div id="collapse2" class="accordion-body collapse">
			    	<div class="accordion-inner">
			        	Мощ. двигателя: 300 л.с.<br />
						Коробка передач: автомат<br />
						Макс. скорость: 220 км/ч<br />
			    	</div>
			    </div>
			  </div>
			</div>

		</div>
	</div>
</div>
<?php endif; ?>