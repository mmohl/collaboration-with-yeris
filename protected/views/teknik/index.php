<?php
/* @var $this TeknikController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tekniks',
);

$this->menu=array(
	array('label'=>'Create Teknik', 'url'=>array('create')),
	array('label'=>'Manage Teknik', 'url'=>array('admin')),
);
?>

<h1>Tekniks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
