<?php
/* @var $this TeknikController */
/* @var $model Teknik */

$this->breadcrumbs=array(
	'Tekniks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Teknik', 'url'=>array('index')),
	array('label'=>'Create Teknik', 'url'=>array('create')),
	array('label'=>'View Teknik', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Teknik', 'url'=>array('admin')),
);
?>

<h1>Update Teknik <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'parents'=>$parents)); ?>