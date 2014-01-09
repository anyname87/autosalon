<!-- Средний блок включает текстовую часть со списком и правый бар с банерами -->
<div class="middle-block">
    <?php if(!empty($page)): ?>
    <div class="text-block">
        <?php foreach ($page as $pkey => $p) { ?> 
    	<div class="paragraph">
            <?=$p->text?>
    	</div>
        <?php } ?>
	</div>
    <?php endif; ?>
	<div class="right-bar">
    	<div class="banners-block">
            <img src="/assets/banners/Audi4auto.jpg" alt="Авто">
            <br />
            <div class="clearfix"></div>
            <br />
            <img src="/assets/banners/Audi4auto.jpg" alt="Авто">		
    	</div>
	</div>
    
</div>
<!-- Средний блок конец -->