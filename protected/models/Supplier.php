<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property integer $id
 * @property string $sup_code
 * @property string $sup_name
 * @property string $sup_address
 * @property string $sup_phone
 * @property string $sup_type
 * @property integer $op_code
 * @property string $entry_date
 */
class Supplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplier the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sup_code, sup_name, sup_address, sup_phone, sup_type, op_code, entry_date', 'required'),
			array('op_code', 'numerical', 'integerOnly'=>true),
			array('sup_code, sup_name, sup_address, sup_phone', 'length', 'max'=>128),
			array('sup_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sup_code, sup_name, sup_address, sup_phone, sup_type, op_code, entry_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sup_code' => 'Sup Code',
			'sup_name' => 'Sup Name',
			'sup_address' => 'Sup Address',
			'sup_phone' => 'Sup Phone',
			'sup_type' => 'Sup Type',
			'op_code' => 'Op Code',
			'entry_date' => 'Entry Date',
		);
	}
	
	public function scopes()
	{
		return array(
			'sortByName'=> array(
				'order'=>'sup_name'
			)
		);	
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('sup_code',$this->sup_code,true);
		$criteria->compare('sup_name',$this->sup_name,true);
		$criteria->compare('sup_address',$this->sup_address,true);
		$criteria->compare('sup_phone',$this->sup_phone,true);
		$criteria->compare('sup_type',$this->sup_type,true);
		$criteria->compare('op_code',$this->op_code);
		$criteria->compare('entry_date',$this->entry_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getAllOptions()
	{
		$model = self::model()->sortByName()->findAll();
		$option=array();
		foreach ($model as $row)
		{
			$option[$row->sup_code]=ucwords($row->sup_name);
		}
		return $option;
	}
}