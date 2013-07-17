<?php
/**
 * @file BookModel.php
 * 
 * @autor Alex Letov
 * 
 * Book model.
 */

class BookModel extends CActiveRecord
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
         return 'book';
    }
}
?>
