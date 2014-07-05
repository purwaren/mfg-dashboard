<?php

/**
 * This is the model class for table "item_distribution".
 *
 * The followings are the available columns in table 'item_distribution':
 * @property integer $id
 * @property string $item_code
 * @property string $shop_code
 * @property integer $qty_total
 */
class ItemDistribution extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
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
			array('item_code, shop_code, qty_total', 'required'),
			array('qty_total', 'numerical', 'integerOnly'=>true),
			array('item_code', 'length', 'max'=>10),
			array('shop_code', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_code, shop_code, qty_total', 'safe', 'on'=>'search'),
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
			'item_code' => 'Item Code',
			'shop_code' => 'Shop Code',
			'qty_total' => 'Qty Total',
		);
	}
	
	public function scopes()
	{
		return array(
			'shop_desc'=>array(
				'order'=>'shop_code ASC',					
			),
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
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('shop_code',$this->shop_code,true);
		$criteria->compare('qty_total',$this->qty_total);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}