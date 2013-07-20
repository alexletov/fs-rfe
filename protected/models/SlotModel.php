<?php
/**
 * @file SlotModel.php
 * 
 * @autor Alex Letov
 * 
 * Slot model.
 */

class SlotModel extends CActiveRecord
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
         return 'slot';
    }
    
    public function relations()
    {
        return array(
            'airport' => array(self::BELONGS_TO, 'AirportModel', 'airportid'),
            'book' => array(self::HAS_ONE, 'SlotreserveModel', 'slotid'),
        );
    }
}
?>