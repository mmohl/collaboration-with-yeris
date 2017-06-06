<?php

/**
 * This is the model class for table "teknik_penjualan".
 *
 * The followings are the available columns in table 'teknik_penjualan':
 * @property integer $id
 * @property string $nama_teknik
 * @property string $parent
 * @property string $kode
 *
 * The followings are the available model relations:
 * @property Penjualan[] $penjualans
 */
class Teknik extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teknik_penjualan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_teknik', 'required'),
			array('nama_teknik', 'length', 'max'=>100),
			array('parent', 'length', 'max'=>10),
			array('kode', 'length', 'max'=>5),
			['kode, nama_teknik', 'unique'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_teknik, parent, kode', 'safe', 'on'=>'search'),
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
			'penjualans' => array(self::HAS_MANY, 'Penjualan', 'id_teknik'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama_teknik' => 'Nama Teknik',
			'parent' => 'Parent',
			'kode' => 'Kode',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nama_teknik',$this->nama_teknik,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('kode',$this->kode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Teknik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getKodes($dropdown = false) 
	{
		// initialize empty array
		$parentMap = [];
		// find all teknik both parent & child
		$parents = Teknik::model()->findAll();
		// take only the kode

		if ($dropdown) {
			return $parents;
		}

		foreach ($parents as $parent) {
// 			var_dump($parent->id);die;
			$parentMap[$parent->id] = $parent->kode;
		}
		//return values
		return $parentMap;
	}
}
