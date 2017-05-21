<?php

class DataController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionImport()
	{
		$parents = Teknik::getParents();
		var_dump($parents);die;
		$objPHPExcel = new PHPExcel();
		// definisi lokasi penyimpanan file.
		$path = __DIR__ . '/../../import_file/';
		// buat objek baru untuk data.
		$model = new Data();
		// definisi variable untuk nama.
		$name = '';
		// check request apakah ada data dengan index "Data"
		if (isset($_POST['Data'])) {
			try {
				$sheet_array = Yii::app()->yexcel->readActiveSheet($path . 'Data Penjualan.csv');
				echo '<pre>';
				var_dump($sheet_array);die;
				
				// memasukan nilai request ke model
				$model->attributes = $_POST['Data'];
				// memasukan data file ke variable data di model.
				$model->data = CUploadedFile::getInstance($model, 'data');
				// mengambil nama file
				$name = $_FILES['Data']['name'];
				// menyimpan file ke direktori yang sudah ditentukan.
				$check = $model->data->saveAs($path . $name['data']);
			} catch (Exception $e) {
				// menampilkan kesalahan jika ada error.
				var_dump($e);
			}
		}
		
		$this->render('import', [
				'model' => $model,
				'parents' => $parents
		]);
	}
	
	private function insertToDb(array $collection) {
		foreach ($collection as $col) {
			
		}
	}
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}