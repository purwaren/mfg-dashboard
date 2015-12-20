<?php

/**
 * Created by PhpStorm.
 * User: purwa
 * Date: 20/12/15
 * Time: 7:48
 */
class SaleItemsWeekly extends CFormModel
{
    public $start_date;
    public $end_date;
    public $store_code;
    private $month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','Septermber',
        'Oktober','November','Desember');
    public $current_page=1;
    public $page_size=10;

    public function rules()
    {
        return array(
            array('start_date, end_date','required')
        );
    }

    public function attributeLabels() {
        return array(
            'start_date'=>'Tanggal Mulai',
            'end_date'=>'Tanggal Berakhir',
        );
    }

    public function getAllCategoryWithReport() {
        $category = $this->getAllCategory();

        $data = array();
        if(!empty($category)) {
            foreach($category as $cat) {
                $data[] = array(
                    'cat_code'=>$cat->cat_code,
                    'cat_name'=>$cat->cat_name,
                    'data'=> $this->getReportDataByCategory($cat->cat_code)
                );
            }
        }

        return $data;
    }

    private function getAllCategory() {
        $criteria = new CDbCriteria();
        $criteria->select = 'cat_code, cat_name';
        $criteria->order = 'cat_code';
        $criteria->limit = $this->page_size;
        $criteria->offset = ($this->current_page-1)*$this->page_size;

        return Category::model()->findAll($criteria);
    }

    public function getPagination() {
        $criteria=new CDbCriteria();

        $count = Category::model()->count($criteria);
        $pagination = new CPagination(intval($count));
        $pagination->pageSize = $this->page_size;

        return $pagination;
    }

    public function getItemCount() {
        return Category::model()->count();
    }

    public function getSummaryText() {
        return 'Menampilkan '.($this->page_size*($this->current_page-1) + 1).' - '.($this->page_size*$this->current_page).
            ' dari '.$this->getItemCount().' hasil';
    }

    public function getWeeklyHeader() {
        $tmp = explode('-',$this->start_date);
        $start = mktime(0,0,0,intval($tmp[1]),$tmp[2],$tmp[0]);
        $tmp = explode('-',$this->end_date);
        $end = mktime(0,0,0,intval($tmp[1]),$tmp[2],$tmp[0]);
        $header = array();
        while($start <= $end) {
            $header[] = date('d/m',$start);
            $start += 86400;
        }
        return $header;
    }

    private function getReportDataByCategory($cat) {
        $criteria = new CDbCriteria();
        $criteria->select='DATE_FORMAT(trx_date,\'%d/%m\') AS trx_date, SUM(qty_sold) AS qty_sold';
        $criteria->addCondition('trx_date >= :start AND trx_date <= :end');
        $criteria->params = array(
            ':start' => $this->start_date,
            ':end'=>$this->end_date
        );
        $criteria->compare('category',$cat);
        $criteria->group = 'category, trx_date';
        $criteria->order = 'trx_date';

        $model = SoldItem::model()->findAll($criteria);
        $header = $this->getWeeklyHeader();
        //initialize data
        $data=array();
        foreach($header as $row) {
            $data[$row] = 0;
        }
        if(!empty($model)) {
            foreach($model as $row) {
                $data[$row->trx_date] = $row->qty_sold;
            }
        }
        return $data;
    }

    public function getStartDate() {
        $str = 'Awal';
        if(!empty($this->start_date)) {
            $tmp = explode('-',$this->start_date);
            $str = $tmp[2].' '.$this->month[intval($tmp[1])].' '.$tmp[0];
        }
        return $str;
    }

    public function getEndDate() {
        $str = 'Akhir';
        if(!empty($this->end_date)) {
            $tmp = explode('-',$this->end_date);
            $str = $tmp[2].' '.$this->month[intval($tmp[1])].' '.$tmp[0];
        }
        return $str;
    }
}