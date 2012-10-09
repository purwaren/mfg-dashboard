<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $hm
 * @property string $hp
 * @property string $hj
 * @property integer $total
 * @property integer $stock
 * @property string $cat
 * @property string $sup
 * @property integer $sync_time
 */
class Items extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Items the static model class
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
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, hm, hp, hj, total, cat, sup, sync_time', 'required'),
			array('total, stock, sync_time', 'numerical', 'integerOnly'=>true),
			array('code, name', 'length', 'max'=>128),
			array('hm, hp, hj, cat, sup', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name, hm, hp, hj, total, stock, cat, sup, sync_time', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'name' => 'Name',
			'hm' => 'Hm',
			'hp' => 'Hp',
			'hj' => 'Hj',
			'total' => 'Total',
			'stock' => 'Stock',
			'cat' => 'Cat',
			'sup' => 'Sup',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('hm',$this->hm,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('hj',$this->hj,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('cat',$this->cat,true);
		$criteria->compare('sup',$this->sup,true);
		$criteria->compare('sync_time',$this->sync_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}