<?php

/**
 * This is the model class for table "store".
 *
 * The followings are the available columns in table 'store':
 * @property integer $id
 * @property string $code
 * @property string $alias
 * @property string $name
 * @property string $addres
 * @property string $phone
 * @property string $supervisor
 * @property string $cat
 * @property integer $deleted
 */
class Store extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Store the static model class
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
		return 'store';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, alias, name, addres, phone, supervisor, cat, deleted', 'required'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('code, alias', 'length', 'max'=>11),
			array('name, supervisor, cat', 'length', 'max'=>128),
			array('phone', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, alias, name, addres, phone, supervisor, cat, deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function scopes()
	{
		return array(
			'sortByName'=>array('order'=>'name ASC')
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
			'alias' => 'Alias',
			'name' => 'Name',
			'addres' => 'Addres',
			'phone' => 'Phone',
			'supervisor' => 'Supervisor',
			'cat' => 'Cat',
			'deleted' => 'Deleted',
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
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('addres',$this->addres,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('supervisor',$this->supervisor,true);
		$criteria->compare('cat',$this->cat,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public static function getAllStoreOptions()
	{
		$model = self::model()->sortByName()->findAll();
		$options=array();
		if($model)
		{			
			foreach($model as $row)
			{
				$options[$row->code]=$row->name;
			}
		}
		return $options;
	}
	
	public function getAllStoreByGroup()
	{
		$sql='SELECT DISTINCT koalisi FROM store ORDER BY koalisi';
		$sql2='SELECT * FROM store WHERE koalisi = :group AND deleted=0 ORDER BY urutan';
		$cmd = Yii::app()->db->createCommand($sql);
		$cmd2 = Yii::app()->db->createCommand($sql2);
		$group = $cmd->queryAll(true);
		$data=array();
		foreach($group as $g)
		{
			$data[$g['koalisi']]=$cmd2->queryAll(true,array(
				':group'=>$g['koalisi']
			));		
		}
		return $data;
	}
}