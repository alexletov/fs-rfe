<?php
/**
 * @file AdminModel.php
 * 
 * @autor Alex Letov
 * 
 * Admin model.
 */

class AdminModel extends CActiveRecord
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
         return 'admin';
    }
}
?>
