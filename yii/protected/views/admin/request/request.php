<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
?>
<?php $this->renderPartial($details ? 'request/partials/_Details' : 'request/partials/_List', array('request'=>$request, 'group_request'=>$group_request)); ?>
<div class="clearfix"></div>
