<?php

/**
 * This is the model class for table "store_revenue".
 *
 * The followings are the available columns in table 'store_revenue':
 * @property integer $id
 * @property string $store_code
 * @property string $date
 * @property double $current_revenue
 * @property integer $last_updated
 */
class StoreRevenue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StoreRevenue the static model class
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
		return 'store_revenue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, date, current_revenue, last_updated', 'required'),
			array('last_updated', 'numerical', 'integerOnly'=>true),
			array('current_revenue', 'numerical'),
			array('store_code', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, date, current_revenue, last_updated', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'current_revenue' => 'Current Revenue',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('current_revenue',$this->current_revenue);
		$criteria->compare('last_updated',$this->last_updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Get formatted date with string
	 */
	public function getDate()
	{
		$tmp = explode('-',$this->date);
		return date('F j, Y',mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]));
	}	
	
	/**
	 * Get store name
	 */
	public function getStoreName()
	{
		$model = StoreIp::model()->findByAttributes(array(
			'store_code'=>$this->store_code,
		));
		if($model)
			return $model->name;
		else return 'Unknown';
	}
}