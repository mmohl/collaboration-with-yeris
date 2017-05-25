<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'prediksi-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>


<?php $this->endWidget(); ?>

<?php if(!empty($sources)): ?>
<?php $this->renderPartial('tabel', array('sources'=>$sources)); ?>
<?php endif;?>