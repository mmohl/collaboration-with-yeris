<?php

/**
 * This is the model class for table "penjualan".
 *
 * The followings are the available columns in table 'penjualan':
 * @property string $id
 * @property integer $id_teknik
 * @property string $tahun
 * @property string $bulan
 * @property integer $jumlah
 *
 * The followings are the available model relations:
 * @property TeknikPenjualan $idTeknik
 */
class Penjualan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'penjualan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_teknik, tahun, bulan, jumlah', 'required'),
			array('id_teknik, jumlah', 'numerical', 'integerOnly'=>true),
			array('tahun', 'length', 'max'=>10),
			array('bulan', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_teknik, tahun, bulan, jumlah', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idTeknik' => array(self::BELONGS_TO, 'TeknikPenjualan', 'id_teknik'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_teknik' => 'Id Teknik',
			'tahun' => 'Tahun',
			'bulan' => 'Bulan',
			'jumlah' => 'Jumlah',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_teknik',$this->id_teknik);
		$criteria->compare('tahun',$this->tahun,true);
		$criteria->compare('bulan',$this->bulan,true);
		$criteria->compare('jumlah',$this->jumlah);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Penjualan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function all($c = null) {
		return Penjualan::model()->findAll($c);
	}
	
	public static function years() {
		$c = new CDbCriteria;
		$c->select = "DISTINCT tahun";
		
		$models = Penjualan::model()->findAll($c);
		
		$years = array_map(function($model){
			return $model->tahun;
		}, $models);
				
		return $years;
	}
	
	public static function getSources($year) {
		$c = new CDbCriteria;
		
		$c->condition = 'tahun < :tahun';
		
		$c->params = ['tahun'=>$year];
		
		$val = Penjualan::model()->findAll($c);
		
		return Penjualan::group($val);
		
	}
	
	private static function group(array $collection) {
		$map = [];
		$years = Penjualan::years();
		$kodes = Teknik::getKodes();
		$months = Penjualan::getMonths();
		
		foreach ($years as $year) 
		{
			foreach ($months as $month) 
			{
				$tmp[$year][$month] = [];
				foreach ($kodes as $id => $kode) 
				{
					foreach ($collection as $data)
					{
						if ($data->id_teknik == $id && $data->tahun == $year && $data->bulan == $month) {
							$map[$year][$month][$kode] = intval($data->jumlah);
						}
					}
					
				}
			}
		}
		
		return $map;
	}
	
	public static function getMonths() {
		return [
				'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
		];
	}
	
}
