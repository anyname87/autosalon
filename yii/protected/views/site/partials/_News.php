<div class="middle-block">
    <div class="text-block">
        <?php if(is_array($page)): ?>
        <div class="paragraph">
        	<?php foreach ($page as $pkey => $p) { ?>
        		<h3><a href="<?=$this->createUrl('site/news',array('id'=>$p->id, 'language'=>Yii::app()->language))?>"><?=$p->title?></a></h3>
        		<?=$p->preview?> 
                <?=CHtml::link("[Подробнее...]", array('site/news', 'id'=>$p->id, 'language'=>Yii::app()->language), array('class'=>'description'))?>
                <br /><br />
        	<?php } ?>
        </div>
        <?php $this->widget('CLinkPager', array(
            'pages'=>$pages,
            'header'=>'',
            'firstPageLabel'=>'Начало',
            'lastPageLabel'=>'Конец',
            'nextPageLabel'=>'След.',
            'prevPageLabel'=>'Пред.',
            'maxButtonCount'=>1,
          //  'cssFile'=>false
        )) ?>
        <?php else: ?>
        <div class="paragraph">
            <h3><?=$page->title?></h3>
            <?=$page->text?>
        </div>
        <?php endif; ?>
    </div>
    <div class="right-bar">
        <div class="banners-block">
            <?php if(is_array($lastnews)): ?>
            <h3>Последние новости</h3>
            <?php foreach ($lastnews as $lkey => $l)
                    echo CHtml::link($l, array('site/news', 'id'=>$lkey, 'language'=>Yii::app()->language)).'<br />' ?>
            <?php endif; ?>     
        </div>
    </div>
</div>