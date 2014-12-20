<?php

/**
 * This is the model class for table "item_retur".
 *
 * The followings are the available columns in table 'item_retur':
 * @property string $retur_id
 * @property string $store_code
 * @property string $item_code
 * @property integer $qty
 * @property string $date
 * @property integer $status
 */
class ItemRetur extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemRetur the static model class
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
		return 'item_retur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('retur_id, store_code, item_code, qty, date, status', 'required'),
			array('qty, status', 'numerical', 'integerOnly'=>true),
			array('retur_id', 'length', 'max'=>32),
			array('store_code, item_code', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('retur_id, store_code, item_code, qty, date, status', 'safe', 'on'=>'search'),
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
			'retur_id' => 'Retur',
			'store_code' => 'Store Code',
			'item_code' => 'Item Code',
			'qty' => 'Qty',
			'date' => 'Date',
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

		$criteria->compare('retur_id',$this->retur_id,true);
		$criteria->compare('store_code',$this->store_code,true);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}