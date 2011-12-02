<?php

/**
 * This is the model class for table "sales".
 *
 * The followings are the available columns in table 'sales':
 * @property integer $id
 * @property string $store_code
 * @property string $sales_id
 * @property string $amount
 * @property string $disc
 * @property string $cc
 * @property integer $teller_id
 * @property integer $clerk_id
 */
class Sales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sales the static model class
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
		return 'sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('store_code, sales_id, amount, disc, cc, teller_id, clerk_id', 'required'),
			array('teller_id, clerk_id', 'numerical', 'integerOnly'=>true),
			array('store_code, amount, disc', 'length', 'max'=>11),
			array('sales_id', 'length', 'max'=>128),
			array('cc', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, store_code, sales_id, amount, disc, cc, teller_id, clerk_id', 'safe', 'on'=>'search'),
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
			'sales_id' => 'Sales',
			'amount' => 'Amount',
			'disc' => 'Disc',
			'cc' => 'Cc',
			'teller_id' => 'Teller',
			'clerk_id' => 'Clerk',
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
		$criteria->compare('sales_id',$this->sales_id,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('disc',$this->disc,true);
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('teller_id',$this->teller_id);
		$criteria->compare('clerk_id',$this->clerk_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}