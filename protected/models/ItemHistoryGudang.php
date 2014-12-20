<?php

/**
 * This is the model class for table "item_history_gudang".
 *
 * The followings are the available columns in table 'item_history_gudang':
 * @property integer $id
 * @property string $item_code
 * @property string $name
 * @property string $supplier
 * @property string $capital_price
 * @property string $offer_price
 * @property string $date_in
 * @property string $date_bon
 * @property string $date_out
 * @property integer $qty_in
 * @property integer $qty_stock
 * @property integer $qty_dist
 */
class ItemHistoryGudang extends CActiveRecord
{
	public $sortBy='item_code';
	public $sortType='ASC';
	public $start=0;
	public $size=10;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ItemHistoryGudang the static model class
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
		return 'item_history_gudang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_code, name, supplier, capital_price, date_in, date_bon, qty_in, qty_stock', 'required'),
			array('qty_in, qty_stock, qty_dist', 'numerical', 'integerOnly'=>true),
			array('item_code', 'length', 'max'=>15),
			array('name', 'length', 'max'=>128),
			array('supplier', 'length', 'max'=>8),
			array('capital_price, offer_price', 'length', 'max'=>12),
			array('date_out', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_code, name, supplier, capital_price, offer_price, date_in, date_bon, date_out, qty_in, qty_stock, qty_dist, sortType, sortBy', 'safe', 'on'=>'search'),
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
			'item_code' => 'Kode Barang',
			'name' => 'Nama',
			'supplier' => 'Supplier',
			'capital_price' => 'HM',
			'offer_price' => 'HJ',
			'date_in' => 'Tgl Input',
			'date_bon' => 'Tgl Faktur',
			'date_out' => 'Tgl Cetak',
			'qty_in' => 'M',
			'qty_stock' => 'S',
			'qty_dist' => 'D',
			'sortBy'=>'Urut Berdasarkan',
			'sortType'=>'Urutkan Dari'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('supplier',$this->supplier,true);
		$criteria->compare('capital_price',$this->capital_price,true);
		$criteria->compare('offer_price',$this->offer_price,true);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('date_bon',$this->date_bon,true);
		$criteria->compare('date_out',$this->date_out,true);
		$criteria->compare('qty_in',$this->qty_in);
		$criteria->compare('qty_stock',$this->qty_stock);
		$criteria->compare('qty_dist',$this->qty_dist);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchHistory()
	{
		$sql = 'SELECT * FROM item_history_gudang';
		$condition=array();
		$param=array();
		
		if(!empty($this->item_code))
		{
			$condition[]='item_code LIKE :item_code';
			$param[':item_code']=$this->item_code.'%';		
		}
		
		if(!empty($this->supplier))
		{
			$condition[]='supplier LIKE :supplier';
			$param[':supplier']=$this->supplier.'%';
		}
		
		if(!empty($this->date_in))
		{
			$condition[]='date_in LIKE :date_in';
			$param[':date_in']=$this->date_in.'%';
		}
		
		if(!empty($this->date_out))
		{
			$condition[]='date_out LIKE :date_out';
			$param[':date_out']=$this->date_out.'%';
		}
		
		if(!empty($this->date_bon))
		{
			$condition[]='date_bon LIKE :date_bon';
			$param[':date_bon']=$this->date_bon.'%';
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		$sql .= ' ORDER BY '.$this->sortBy.' '.$this->sortType.'
				LIMIT '.$this->start.', '.$this->size;
		
		
		return self::model()->findAllBySql($sql,$param);
		
		
	}	
	
	public function countItemHistory()
	{
		$sql = 'SELECT count(*) FROM item_history_gudang';
		$condition=array();
		$param=array();
	
		if(!empty($this->item_code))
		{
			$condition[]='item_code LIKE :item_code';
			$param[':item_code']=$this->item_code.'%';
		}
	
		if(!empty($this->supplier))
		{
			$condition[]='supplier LIKE :supplier';
			$param[':supplier']=$this->supplier.'%';
		}
	
		if(!empty($this->date_in))
		{
			$condition[]='date_in LIKE :date_in';
			$param[':date_in']=$this->date_in.'%';
		}
	
		if(!empty($this->date_out))
		{
			$condition[]='date_out LIKE :date_out';
			$param[':date_out']=$this->date_out.'%';
		}
	
		if(!empty($this->date_bon))
		{
			$condition[]='date_bon LIKE :date_bon';
			$param[':date_bon']=$this->date_bon.'%';
		}
	
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
	
		return self::model()->countBySql($sql,$param);	
	}
	
	
	public static function getAllSortOptions()
	{
		return array(
			'item_code' => 'Kode Barang',
			'name' => 'Nama',
			'supplier' => 'Supplier',
			'capital_price' => 'HM',
			'offer_price' => 'HJ',
		);
	}
}