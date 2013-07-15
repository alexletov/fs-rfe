<?php
/**
 * @file EventModel.php
 * 
 * @autor Alex Letov
 * 
 * Event model.
 */

class EventModel extends CActiveRecord
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
         return 'event';
    }
    
    public function relations()
    {
        return array(
            'airports' => array(self::HAS_MANY, 'Airport', 'eventid'),
        );
    }
}
?>
