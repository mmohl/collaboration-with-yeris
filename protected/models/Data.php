<?php

class Data extends CFormModel 
{
	public $data;
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('data', 'required'),
				array('data', 'safe'),
				array('data', 'file', 'types'=>'csv'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
				'data' => 'Data'
		);
	}
}