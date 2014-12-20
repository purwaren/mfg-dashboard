<?php

/**
 * This is the model class for table "sale_items".
 *
 * The followings are the available columns in table 'sale_items':
 * @property string $sale_id
 * @property string $item_code
 * @property integer $qty
 * @property string $disc
 */
class SaleItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SaleItems the static model class
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
		return 'sale_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, item_code, qty, disc', 'required'),
			array('qty,id', 'numerical', 'integerOnly'=>true),
			array('item_code', 'length', 'max'=>128),
			array('disc', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_code, qty, disc', 'safe', 'on'=>'search'),
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
			'id' => 'Sale ID',
			'item_code' => 'Item Code',
			'qty' => 'Qty',
			'disc' => 'Disc',
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

		$criteria->compare('sale_id',$this->sale_id,true);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('disc',$this->disc,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}