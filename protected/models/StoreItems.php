<?php

/**
 * This is the model class for table "store_items".
 *
 * The followings are the available columns in table 'store_items':
 * @property integer $id
 * @property string $store_code
 * @property string $item_code
 * @property integer $total
 * @property integer $init_stock
 * @property integer $stock
 * @property integer $opname_stock
 * @property integer $item_in
 * @property integer $item_sold
 * @property string $disc
 * @property integer $total_sold
 * @property integer $sync_time
 */
class StoreItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StoreItems the static model class
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
		return 'store_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, item_code, total, init_stock, stock, opname_stock, item_in, item_sold, disc, total_sold, sync_time', 'required'),
			array('total, init_stock, stock, opname_stock, item_in, item_sold, total_sold, sync_time', 'numerical', 'integerOnly'=>true),
			array('store_code, item_code, disc', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, item_code, total, init_stock, stock, opname_stock, item_in, item_sold, disc, total_sold, sync_time', 'safe', 'on'=>'search'),
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
			'total' => 'Total',
			'init_stock' => 'Init Stock',
			'stock' => 'Stock',
			'opname_stock' => 'Opname Stock',
			'item_in' => 'Item In',
			'item_sold' => 'Item Sold',
			'disc' => 'Disc',
			'total_sold' => 'Total Sold',
			'sync_time' => 'Sync Time',
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
		$criteria->compare('total',$this->total);
		$criteria->compare('init_stock',$this->init_stock);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('opname_stock',$this->opname_stock);
		$criteria->compare('item_in',$this->item_in);
		$criteria->compare('item_sold',$this->item_sold);
		$criteria->compare('disc',$this->disc,true);
		$criteria->compare('total_sold',$this->total_sold);
		$criteria->compare('sync_time',$this->sync_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}