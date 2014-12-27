<?php

/**
 * This is the model class for table "sold_item".
 *
 * The followings are the available columns in table 'sold_item':
 * @property integer $id
 * @property string $category
 * @property string $trx_date
 * @property integer $qty_in
 * @property integer $qty_sold
 * @property string $shop_code
 */
class SoldItem extends CActiveRecord
{	
	public $start=0;
	public $size=10;
	public $total;
	public $start_date;
	public $end_date;
	public $sortBy='category';
	public $sortType='ASC';
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sold_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, trx_date, qty_in, qty_sold, shop_code', 'required'),
			array('qty_in, qty_sold', 'numerical', 'integerOnly'=>true),
			array('category, shop_code', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('category, start_date, end_date, sortBy, sortType', 'safe', 'on'=>'search'),
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
			'category' => 'Kelompok Barang',
			'trx_date' => 'Periode',
			'qty_in' => 'Qty In',
			'qty_sold' => 'Qty Sold',
			'shop_code' => 'Shop Code',
			'sortType' => 'Urutkan Dari',
			'sortBy' => 'Urut Berdasarkan'
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('trx_date',$this->trx_date,true);
		$criteria->compare('qty_in',$this->qty_in);
		$criteria->compare('qty_sold',$this->qty_sold);
		$criteria->compare('shop_code',$this->shop_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SoldItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getAllSortOptions()
	{
		return array(
				'category'=>'Kelompok Barang',
				'qty_sold'=>'Quantity',				
		);
	}
	
	public static function getAllSortTypeOptions()
	{
		return array(
				'ASC'=>'Kecil ke Besar',
				'DESC'=>'Besar ke Kecil'
		);
	}
	
	/**
	 * Find last synchronized data
	 * @param Array $param
	 * @return CActiveRecord
	 */
	public function findLastSyncDate($param)
	{
		$sql='SELECT * FROM sold_item WHERE shop_code = :shop ORDER BY trx_date DESC';
		return self::model()->findBySql($sql, $param);
	}
	
	public function findAllUniqueItemCategory()
	{
		$sql='SELECT category, SUM(qty_sold) AS qty_sold FROM sold_item';
		$condition=array();
		$param=array();
		
		if(!empty($this->category))
		{
			$condition[]='category = :cat';
			$param[':cat']=$this->category;
		}
		
		if(!empty($this->start_date))
		{
			$condition[]='trx_date >= :start';
			$param[':start']=$this->start_date;
		}
		
		if(!empty($this->end_date))
		{
			$condition[] = 'trx_date <= :end';
			$param[':end']=$this->end_date;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		$sql .= ' GROUP BY category ORDER BY '.$this->sortBy.' '.$this->sortType;
		$sql .= ' LIMIT '.$this->start.','.$this->size;		
		
				
		return self::model()->findAllBySql($sql,$param);
	}
	
	public function countAllUniqueItemCategory()
	{
		$sql='SELECT DISTINCT category FROM sold_item';
		$condition=array();
		$param=array();
		if(!empty($this->category))
		{
			$condition[]='category = :cat';
			$param[':cat']=$this->category;
		}
		
		if(!empty($this->start_date))
		{
			$condition[]='trx_date >= :start';
			$param[':start']=$this->start_date;
		}
		
		if(!empty($this->end_date))
		{
			$condition[] = 'trx_date <= :end';
			$param[':end']=$this->end_date;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);	
			
		
		$sql = 'SELECT COUNT(*) FROM ('.$sql.') t';
		
		return self::model()->countBySql($sql,$param);
	}
	
	public function findAllStoreQtySold($p)
	{
		$sql='SELECT shop_code, SUM(qty_sold) AS qty_sold FROM sold_item';
		$condition=array();
		$param=array();
		
		if(!empty($this->category))
		{
			$condition[]='category = :cat';
			$param[':cat']=$this->category;
		}
		else 
		{
			$condition[]='category = :cat';
			$param[':cat']=$p['category'];
		}
		
		if(!empty($p['shop_code']))
		{
			$condition[]='shop_code = :shop';
			$param[':shop']=$p['shop_code'];
		}
		
		if(!empty($this->start_date))
		{
			$condition[]='trx_date >= :start';
			$param[':start']=$this->start_date;
		}
		
		if(!empty($this->end_date))
		{
			$condition[] = 'trx_date <= :end';
			$param[':end']=$this->end_date;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);

		$sql .= ' GROUP BY shop_code';
		
		return self::model()->findBySql($sql,$param);
	}

	public function sumAllQ()
	{
		$sql='SELECT SUM(qty_sold) AS total FROM sold_item';
		$condition=array();
		$param=array();
		if(!empty($this->category))
		{
			$condition[]='category = :cat';
			$param[':cat']=$this->category;
		}
		
		if(!empty($this->start_date))
		{
			$condition[]='trx_date >= :start';
			$param[':start']=$this->start_date;
		}
		
		if(!empty($this->end_date))
		{
			$condition[] = 'trx_date <= :end';
			$param[':end']=$this->end_date;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		return self::model()->findBySql($sql,$param);
	}
	
	public function getStartDate()
	{
		$month=array('','Januari','Februari','Maret','April','Mei','Juni','Juli',
				'Agustus','September','Oktober','November','Desember'
		);
		if(!empty($this->start_date))
		{
			$tmp = explode('-', $this->start_date);
			return $tmp[2].' '.$month[intval($tmp[1])].' '.$tmp[0];	
		}
		else return 'Awal';
	}
	
	public function getEndDate()
	{
		$month=array('','Januari','Februari','Maret','April','Mei','Juni','Juli',
				'Agustus','September','Oktober','November','Desember'
		);
		if(!empty($this->end_date))
		{
			$tmp = explode('-', $this->end_date);
			return $tmp[2].' '.$month[intval($tmp[1])].' '.$tmp[0];
		}
		else return 'Akhir';
	}
	
	public function summaryAllItemCateogry($shop)
	{
		$sql='SELECT SUM(qty_sold) AS total FROM sold_item';
		$condition=array();
		$param=array();	

		if(!empty($shop))
		{
			$condition[]='shop_code = :shop';
			$param[':shop']=$shop;
		}
		
		if(!empty($this->start_date))
		{
			$condition[]='trx_date >= :start';
			$param[':start']=$this->start_date;
		}		
		
		if(!empty($this->end_date))
		{
			$condition[] = 'trx_date <= :end';
			$param[':end']=$this->end_date;
		}
		
		if(!empty($condition))
			$sql .= ' WHERE '.implode(' AND ', $condition);
		
		return self::model()->findBySql($sql,$param);	}
}
