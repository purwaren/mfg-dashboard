<?php

/**
 * This is the model class for table "store_ip".
 *
 * The followings are the available columns in table 'store_ip':
 * @property integer $id
 * @property string $store_code
 * @property string $name
 * @property string $current_ip
 * @property integer $last_updated
 */
class StoreIp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StoreIp the static model class
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
		return 'store_ip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, name, current_ip, last_updated', 'required'),
			array('last_updated', 'numerical', 'integerOnly'=>true),
			array('store_code', 'length', 'max'=>16),
			array('name', 'length', 'max'=>128),
			array('current_ip', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, name, current_ip, last_updated', 'safe', 'on'=>'search'),
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
			'store_code' => 'Store Code',
			'name' => 'Name',
			'current_ip' => 'Current Ip',
			'last_updated' => 'Last Updated',
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
		$criteria->compare('store_code',$this->store_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('current_ip',$this->current_ip,true);
		$criteria->compare('last_updated',$this->last_updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}