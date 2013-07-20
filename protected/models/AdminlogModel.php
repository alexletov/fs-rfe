<?php
/**
 * @file AdminlogModel.php
 * 
 * @autor Alex Letov
 * 
 * Log for admin actions model.
 */

class AdminlogModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
        
    public function getDbConnection()
    {
        return Yii::app()->db;
    }
 
    public function tableName()
    {
         return 'adminlog';
    }
}
?>
