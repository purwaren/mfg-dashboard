<?php

/**
 * This is the model class for table "item_distribution".
 *
 * The followings are the available columns in table 'item_distribution':
 * @property integer $id
 * @property string $store_code
 * @property string $dist_code
 * @property string $item_code
 * @property string $dist_date
 * @property integer $qty
 * @property integer $status
 */
class ItemDistribution extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemDistribution the static model class
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
		return 'item_distribution';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, dist_code, item_code, dist_date, qty, status', 'required'),
			array('qty, status', 'numerical', 'integerOnly'=>true),
			array('store_code, dist_code, item_code', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, dist_code, item_code, dist_date, qty, status', 'safe', 'on'=>'search'),
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
			'dist_code' => 'Dist Code',
			'item_code' => 'Item Code',
			'dist_date' => 'Dist Date',
			'qty' => 'Qty',
			'status' => 'Status',
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
		$criteria->compare('dist_code',$this->dist_code,true);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('dist_date',$this->dist_date,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}