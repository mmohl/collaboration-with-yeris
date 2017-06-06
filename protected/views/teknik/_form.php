<?php
/* @var $this TeknikController */
/* @var $model Teknik */
/* @var $form CActiveForm */
// var_dump($parents);die;
?>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?> 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teknik-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_teknik'); ?>
		<?php echo $form->textField($model,'nama_teknik',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama_teknik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->dropDownList($model, 'parent', CHtml::listData($parents, 'id', 'nama_teknik'), 
				['prompt'=>'Pilih Teknik']);?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kode'); ?>
		<?php echo $form->textField($model,'kode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php 
	$url = Yii::app()->baseUrl.'/index.php?r=teknik/autoChildren';
	$script = "
		$(document).ready(function(){
				
			$('#Teknik_parent').on('change', function(){
				id = $('#Teknik_parent').val();
				//console.log(id);
				if (id != null) {
				$.ajax({
					url : '".$url."',
					data : {id: id},
					type : 'GET',
					success : function(data, status) {
						//console.log(data);
						$('#Teknik_kode').val(data);
					},
					error : function(data, status) {
						alert(status);
					}
				});
				}
			});
			
		});
	";
	echo CHtml::script($script);
	?>

<?php $this->endWidget(); ?>

</div><!-- form -->