<?php
/**
 * @file SlotModel.php
 * 
 * @autor Alex Letov
 * 
 * Slot model.
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
         return 'slot';
    }
    
    public function relations()
    {
        return array(
            'flight' => array(self::BELONGS_TO, 'FlightModel', 'flightid'),
            'book' => array(self::HAS_ONE, 'SlotReserverModel', 'slotid'),
        );
    }
}
?>
