<?php
/* @var $this TeknikController */
/* @var $model Teknik */

$this->breadcrumbs=array(
	'Tekniks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teknik', 'url'=>array('index')),
	array('label'=>'Manage Teknik', 'url'=>array('admin')),
);
?>

<h1>Create Teknik</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'parents'=>$parents)); ?>