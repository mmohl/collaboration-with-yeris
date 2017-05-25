<?php

class Prediksi extends CFormModel 
{
	public $year;
		
	public function rules() 
	{
		return [
				['year', 'required'],
				['year', 'onlyPlusOne']
		];
	}
	
	public function attributeLabels()
	{
		return ['year'=>'Tahun'];
	}
	
	public function onlyPlusOne($attribute, $params) {
		$nextYear = $this->latestYear() + 1;
		
		if ($this->year > $nextYear) {
			$this->addError($attribute, 'maksimal tahun prediksi adalah ' . $nextYear);
		}
	}
	
	private function latestYear() {
		$c = new CDbCriteria;
		$c->order = 'tahun DESC';
		$c->limit = 1;
		
		$val = Penjualan::model()->find($c);
		return intval($val->tahun);
	}

}