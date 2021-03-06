<?php if(!empty($action)): ?>
<!-- Верхний блок включает каталог товаров -->
<div class="top-block">
    <table class="item-table">
    	<thead></thead>
    	<tbody>
    		<tr>
                <?php foreach ($action as $akey => $a) { ?>
                    <?php $model= $a->model; ?>
                    <td>
                        <div class="item-block">
                            <div class="item-block-new">Новинка</div>
                            <div class="item-block-img">
                                <img src="<?=$model->full_img?>" alt="<?=$model->title?>">
                                <?=CHtml::link($model->title, array('site/detail', 'id'=>$model->id, 'language'=>Yii::app()->language))?>
                            </div>
                            <div class="item-block-config">
                                <p>
                                    Мощ. двигателя: 300 л.с.<br>
                                    Коробка передач: автомат<br>
                                    Макс. скорость: 220 км/ч<br>
                                </p>
                            </div>
                            <div class="item-block-price">
                                от <strong><?=$model->price?></strong>
                            </div>
                            <div class="item-block-control">
                                <a class="any-button credit-online" href="#">Online-кредит</a>
                            </div>
                        </div
                    </td>
                <?php } ?>
	    	</tr>
    	</tbody>
      	<tfoot></tfoot>
    </table>
</div>
<!-- Верхний блок конец. -->
<?php endif; ?>