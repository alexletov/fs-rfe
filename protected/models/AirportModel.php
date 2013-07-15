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
            'event' => array(self::BELONGS_TO, 'Event', 'eventid'),
            'flights' => array(self::HAS_MANY, 'Flight', 'airportid'),
        );
    }
}
?>
