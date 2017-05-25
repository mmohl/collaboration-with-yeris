<?php

class DataController extends Controller
{
	// attibutes
	private $kodes;
	private $oldRows;
	private $newRows;
	private $pathForFile = __DIR__ . '/../../import_file/';
	private $name = '';
	private $group;
	public $exists = [];
		
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionImport()
	{
		$this->kodes = Teknik::getKodes();
		$this->oldRows = Penjualan::all();
		// buat objek baru untuk data.
		$model = new Data();
		// check request apakah ada data dengan index "Data"
		if (isset($_POST['Data'])) {

			try {				
				// memasukan nilai request ke model
				$model->attributes = $_POST['Data'];
				// memasukan data file ke variable data di model.
				$model->data = CUploadedFile::getInstance($model, 'data');
				// mengambil nama file
				$this->name = $_FILES['Data']['name']['data'];
				// menyimpan file ke direktori yang sudah ditentukan.
				$check = $model->data->saveAs($this->pathForFile . $this->name);
				// membuka file excel yang diubah ke format array;
				$this->setNewRows($this->pathForFile, $this->name);
			} catch (Exception $e) {
				// menampilkan kesalahan jika ada error.
				var_dump($e->getMessage());
			}
			
			// mengelompokan data berdasarkan tahun, bulan, kode
			$this->group($this->newRows);
			// simpan data ke database
			if ($this->insertToDb($this->group)) {
				$this->redirect(['penjualan/admin']);
			}
		}
		
		$this->render('import', ['model' => $model]);
	}
	
	private function insertToDb(array $collection) {
// 		var_dump($collection);die;
		$transaction = Yii::app()->db->beginTransaction();
		
		try 
		{
			foreach ($collection as $year => $months) 
			{
				foreach ($months as $month => $kodes) 
				{
					foreach ($kodes as $kode => $value) 
					{
// 						var_dump($value);die;
						$teknik = Teknik::model()->findByAttributes(['kode'=>$kode]);
// 						var_dump($teknik);die;
						$model = new Penjualan();
						$model->tahun = $year;
						$model->bulan = $month;
						$model->id_teknik = $teknik->id;
						$model->jumlah = intval($value[0]);
						
// 						var_dump($model);die;
						if (!$this->isExist($model)) {
// 							var_dump($model);die;
							$model->save(false);
						}
						
					}
				}
			}
			
			$transaction->commit();
			return true;
		} catch (Exception $e) 
		{
			var_dump($e->getMessage());
			$transaction->rollBack();
			return false;
		}
		
		
	}
	
	private function group(array $rows) {
		$years = [];
		$kodes = [];
		$withValues = [];
		$ascii = 65;
		
		echo "<pre>";
		
		// group kodes
		foreach ($rows[1] as $key => $kode) {
			if (in_array($kode, $this->kodes)) {
			 $kodes[$key] = $kode;
			}
		}
						
		// group years
		foreach ($rows as $row) {
			if (is_float($row['A']) && !in_array($row['A'], $years)) {
				$years[$row['A']] = strval($row['A']);
			}
		}
		
		// group months
		foreach ($years as $year) {
			$months = [];
			foreach ($rows as $row) {
				if (strval($row['A']) == $year) {
					$months[$row['B']] = $row['B'];
				}
			}
			$years[$year] = $months;
		}
		
		// group value
		$vals = [];
		foreach ($years as $year => $months) 
		{
			foreach ($months as $month) 
			{
				foreach ($kodes as $key => $kode) 
				{
					foreach ($rows as $row) 
					{
						if ($row['A'] == $year && $row['B'] == $month && is_float($row[$key])) 
						{
							$vals[$year][$month][$kode][] = $row[$key];
						}
					}	
				}
			}
		}
		
		// join all data
		foreach ($vals as $year => $months) {
			foreach ($months as $month => $kodes) {
				$years[strval($year)][$month] = $kodes;
			}
		}
		
		$this->group = $years;
	}
	
	private function isExist(Penjualan $model) {
		if (empty($this->oldRows)) {
			return false;
		} else {
			foreach ($this->oldRows as $old) {
// 				var_dump($old);die;
				if ($old->tahun == $model->tahun &&
						$model->bulan == $old->bulan &&
						$model->id_teknik == $old->id_teknik
						) {
							$this->exists[] = $model;
							return true;
						}
			}
			return false;
		}
	}
	
	private function setNewRows(string $path, string $name) {
		$this->newRows = Yii::app()->yexcel->readActiveSheet($path . $name);
	}
}