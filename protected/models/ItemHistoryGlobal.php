<?php
/**
 * Created by PhpStorm.
 * User: purwaren
 * Date: 3/23/18
 * Time: 7:39 PM
 */

class ItemHistoryGlobal extends CFormModel
{
    public $cat_code;
    public $start=0;
    public $size=10;
    public $sortBy='item_code';
    public $sortType = 'ASC';
    public $total;

    public function rules()
    {
        return array(
            array('cat_code', 'required'),
            array('cat_code', 'numerical')
        );
    }

    public function attributeLabels()
    {
        return array(
            'cat_code'=>'Kelompok Barang',
        );
    }

    public function searchUniqueItem()
    {
        $sql = 'SELECT substr(item_code,1,3) AS category, substr(item_code,4,2) AS year, sum(qty_stock) AS qty FROM item_history';
        $param = array();
        if (!empty($this->cat_code))
        {
            $sql .= ' WHERE substr(item_code, 1, 3) = :cat AND length(item_code) = 10';
            $param[':cat'] = $this->cat_code;
        }
        $sql .= ' GROUP BY substr(item_code,1,3), substr(item_code,4,2)';
        $sql .= ' ORDER BY category, year';
//        $sql .= ' LIMIT '.$this->start.', '.$this->size;

//        echo $sql;die();

        $cmd = Yii::app()->db->createCommand($sql);
        return $cmd->queryAll(true, $param);
    }

    public function searchAllItem($year)
    {
        $sql = 'SELECT substr(item_code,1,3) AS category, substr(item_code,4,2) AS year, sum(qty_stock) AS qty, store_code FROM item_history';
        $param = array();
        if (!empty($this->cat_code))
        {
            $sql .= ' WHERE substr(item_code, 1, 3) = :cat AND substr(item_code,4,2) = :year AND length(item_code) = 10';
            $param[':cat'] = $this->cat_code;
            $param[':year'] = $year;
        }
        $sql .= ' GROUP BY store_code, substr(item_code,1,3), substr(item_code,4,2)';
        $sql .= ' ORDER BY category, year';

        $cmd = Yii::app()->db->createCommand($sql);
        $query = $cmd->queryAll(true, $param);
        $data = array();
        foreach ($query as $row)
        {
            $data[$row['store_code']] = $row['qty'];
        }

        return $data;
    }

    public function countUniqueItem()
    {
        $sql = 'SELECT substr(item_code, 4, 2) AS year, count(substr(item_code,1,5)) AS qty FROM item_history';
        $param = array();
        if (!empty($this->cat_code))
        {
            $sql .= ' WHERE substr(item_code, 1, 3) = :cat AND length(item_code) = 10';
            $param[':cat'] = $this->cat_code;
        }
        $sql .= ' GROUP BY substr(item_code, 1, 5)';
        $sql = 'SELECT COUNT(*) FROM ('.$sql.') t1';
        $cmd = Yii::app()->db->createCommand($sql);
        return $cmd->queryScalar($param);
    }

    public function summaryAllItem()
    {
        $sql = 'SELECT substr(i.item_code,1,3) AS category, sum(i.qty_stock) AS qty, s.code 
                FROM store s LEFT JOIN item_history i ON s.code = i.store_code';
        $param = array();
        if (!empty($this->cat_code))
        {
            $sql .= ' WHERE substr(i.item_code, 1, 3) = :cat AND length(item_code) = 10';
            $param[':cat'] = $this->cat_code;
        }
        $sql .= ' GROUP BY store_code';
        $sql .= ' ORDER BY store_code';
        $cmd = Yii::app()->db->createCommand($sql);
        $result = $cmd->queryAll(true, $param);
        $data = array();
        if (!empty($result))
        {
            foreach ($result as $row)
            {
                $data[$row['code']] = $row['qty'];
            }
        }

        return $data;
    }

    public function countAllQ()
    {
        $sql = 'SELECT SUM(qty_stock) FROM item_history WHERE substr(item_code,1,3) = :cat AND length(item_code) = 10';
        $cmd = Yii::app()->db->createCommand($sql);
        return $cmd->queryScalar(array(':cat'=>$this->cat_code));
    }

    public static function getAllCategoryOptions()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'cat_code';
        $model = Category::model()->findAll($criteria);
        $options = array();
        if ($model)
        {
            foreach ($model as $row)
            {
                $options[$row->cat_code] = $row->cat_code.' - '.$row->cat_name;
            }
        }

        return $options;
    }

    public function getTitle()
    {
        $model = Category::model()->findByAttributes(array('cat_code'=>$this->cat_code));
        return $model->cat_code.' - '.strtoupper($model->cat_name);
    }
}