<?php
/* @var $this AdminController */
/* @var $request model */
/* @var $form CActiveForm */
?>
<div class="middle-block">

    <div class="text-block">
		<div class="paragraph">
            <h2>Заявка на автокредит</h2>
			<p>
				Для отправки заявки на автокредит, заполните все обязательные поля, помеченные (*).
			</p>
		</div>
	</div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'request-form',
		'enableAjaxValidation'=>true,
		'clientOptions' => array('validateonsubmit'=>false, 'validateonchange'=>true),
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	    ),
	)); ?>

		<?php echo $form->errorSummary($request); ?>

		<div class="control-group">
			<?php echo $form->labelEx($request,'name', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($request,'name',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Как к Вам обращаться?')); ?>
				<?php echo $form->error($request,'name'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'phone', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($request,'phone',array('size'=>20,'maxlength'=>20, 'placeholder'=>'Контактный телефон')); ?>
				<?php echo $form->error($request,'phone'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'mark_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($request,'mark_id', $mark,
		    									array(
		    										'empty'=>'Выберите марку',
										        	'ajax'=>array(
											            'type'=>'POST',
											            'url'=>CController::createUrl('/ajaxgetmodels'),
											            'data'=>array('id'=>'js:this.value'),
											            'success' => 'function(data){
											            	var obj = $.parseJSON(data);
											            	var select = $("#'.CHtml::activeId($request,'model_id').'");
															var img = $("#request-mark-img");
					                                     	var description = $("#request-mark-description");
											            	select.empty();
											            	select.append($("<option value>Выберите модель</option>"));
											            	for (var i in obj.model){
																select.append($("<option value=\'" + i + "\'>" + obj.model[i] + "</option>"));
															};
															select.removeAttr("disabled");
					                                     	img.attr("src", obj.mark_img);
					                                     	description.text(obj.mark_description);

					                                     	img.fadeIn();
					                                     	description.fadeIn();
					                                    }',
					                                    'error' => 'function(data){
					                                    	alert(data.responseText);
					                                    }',
										        	)
										        )
				); ?>
				<?php echo $form->error($request,'mark_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'model_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($request,'model_id', $model,
		    									array(
		    									//	empty($request->mark_id) ? 'disabled'=>'disabled' : 'empty'=>'Выберите модель',
										        	'ajax'=>array(
											            'type'=>'POST',
											            'url'=>CController::createUrl('/ajaxgetcomplects'),
											            'update'=>'#'.CHtml::activeId($request,'compl'),
											            'data'=>array('id'=>'js:this.value'),
											            'success' => 'function(data){
											            	var obj = $.parseJSON(data);
											            	var select = $("#'.CHtml::activeId($request,'compl').'");
															var img = $("#request-model-img");

											            	select.empty();
											            	select.append($("<option value>Выберите комплектацию</option>"));
											            	for (var i in obj.complect){
																select.append($("<option value=\'" + obj.complect[i] + "\' data-price=\'" + i + "\'>" + obj.complect[i] + "</option>"));
															};
															select.removeAttr("disabled");
					                                     	img.attr("src", obj.model_img);
					                                     	img.fadeIn();
					                                    }',
					                                    'error' => 'function(data){
					                                    	alert(data.responseText);
					                                    }',
										        	)
										        ) 
		    	);?>
				<?php echo $form->error($request,'model_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'compl', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($request,'compl', $compl,
		    									array(
		    										//empty($request->model_id) ? 'disabled'=>'disabled' : 'empty'=>'Выберите комплектацию',
		    										'onChange'=>'SetPrice(this)'
		    										) 
		    	);?>
				<?php echo $form->error($request,'compl'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'city_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($request,'city_id', $city, array('empty'=>'Выберите регион проживания'));?>
				<?php echo $form->error($request,'city_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'work_name', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($request,'work_name',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Где работаете?')); ?>
				<?php echo $form->error($request,'work_name'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($request,'experience', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($request,'experience',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Стаж на последнем месте работы (год(-а), лет)')); ?>
				<?php echo $form->error($request,'experience'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($request->isNewRecord ? 'Отправить заявку' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>

	<?php $this->endWidget(); ?>
	<div class="request-detail">
		<div class="request-mark">
			<img id="request-mark-img" src title="Выбранная марка" />
			<p id="request-mark-description"></p>
		</div>
		<div class="request-model">
			<img id="request-model-img" src title="Выбранная модель" />
			<div class="clearfix"></div>
			<h1 id="request-model-price"></h1>
		</div>
	</div>
	<div class="clearfix"></div>
    <div class="text-block">
		<div class="paragraph">
            <h2>Персональные данные</h2>
			<p>
				Оставляя заявку на сайте компании Автосалон.РФ (далее - Компания), Вы осознано даете свое согласие на использование, хранение и обработку Ваших персональных данных Компанией, а также партнерами Компании с целью получения Вами информации о продуктах и услугах Компании и ее партнеров. Под персональными данными подразумевается любая информация, относящаяся к субъекту персональных данных, т.е. к Вам, относимая Федеральным законом от 27 июля 2006 года № 152-ФЗ «О персональных данных» к категории персональных данных. Для отзыва согласия на обработку моих персональных данных Вами будет отправлено письмо в свободной форме на почтовый адрес Компании. Хранение, обработка и использование моих данных будет производиться в соответствии с политикой конфиденциальности Компании
			</p>
            <h3>Льготный автокредит:</h3>
            <ul>
                <li>автокредит выдается физическим лицам в рублях на новые авто,</li>
                <li>стоимость авто не более 750 тыс. руб.,</li>
                <li>авто ранее не находился на регистрационном учете,</li>
                <li>предоплата не менее 15% от стоимости авто,</li>
                <li>срок действия кредитного договора не более 3-х лет,</li>
                <li>авто приобретен до 1 апреля 2014 года.</li>
            </ul>
		</div>
	</div>

</div>