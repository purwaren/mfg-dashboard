<?php

/**
 * This is the model class for table "item_distribution".
 *
 * The followings are the available columns in table 'item_distribution':
 * @property integer $id
 * @property string $item_code
 * @property string $shop_code
 * @property string $date_dist
 * @property integer $qty_total
 */
class ItemDistribution extends CActiveRecord
{
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
			array('item_code, shop_code, date_dist, qty_total', 'required'),
			array('qty_total', 'numerical', 'integerOnly'=>true),
			array('item_code', 'length', 'max'=>10),
			array('shop_code', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_code, shop_code, date_dist, qty_total', 'safe', 'on'=>'search'),
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
			'date_dist' => 'Date Dist',
			'qty_total' => 'Qty Total',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('shop_code',$this->shop_code,true);
		$criteria->compare('date_dist',$this->date_dist,true);
		$criteria->compare('qty_total',$this->qty_total);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemDistribution the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function findLastSyncDate()
	{
		$sql='SELECT * FROM item_distribution ORDER BY date_dist DESC, id DESC';
		return self::model()->findBySql($sql);
	}
}
