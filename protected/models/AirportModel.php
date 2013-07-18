<?php
/**
 * @file AirportModel.php
 * 
 * @autor Alex Letov
 * 
 * Airport model.
 */

class AirportModel extends CActiveRecord
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
         return 'airport';
    }
    
    public function relations()
    {
        return array(
            'event' => array(self::BELONGS_TO, 'EventModel', 'eventid'),
            'flights' => array(self::HAS_MANY, 'FlightModel', 'airportid'),
            'slots' => array(self::HAS_MANY, 'SlotModel', 'airportid'),
        );
    }
}
?>
