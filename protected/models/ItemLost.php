<?php

/**
 * This is the model class for table "item_lost".
 *
 * The followings are the available columns in table 'item_lost':
 * @property integer $id
 * @property string $store_code
 * @property string $item_code
 * @property string $date
 * @property string $price
 * @property integer $qty
 */
class ItemLost extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemLost the static model class
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
		return 'item_lost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, item_code, date, price, qty', 'required'),
			array('qty', 'numerical', 'integerOnly'=>true),
			array('store_code, item_code, price', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, item_code, date, price, qty', 'safe', 'on'=>'search'),
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
			'item_code' => 'Item Code',
			'date' => 'Date',
			'price' => 'Price',
			'qty' => 'Qty',
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
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('qty',$this->qty);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}