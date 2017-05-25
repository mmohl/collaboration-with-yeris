<?php
/* @var $this PenjualanController */
/* @var $model Penjualan */

$this->breadcrumbs=array(
	'Penjualans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Penjualan', 'url'=>array('index')),
	array('label'=>'Manage Penjualan', 'url'=>array('admin')),
);
?>

<h1>Create Penjualan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>