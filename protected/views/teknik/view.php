<?php
/* @var $this TeknikController */
/* @var $model Teknik */

$this->breadcrumbs=array(
	'Tekniks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Teknik', 'url'=>array('index')),
	array('label'=>'Create Teknik', 'url'=>array('create')),
	array('label'=>'Update Teknik', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Teknik', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teknik', 'url'=>array('admin')),
);
?>

<h1>View Teknik #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_teknik',
		'parent',
		'kode',
	),
)); ?>
