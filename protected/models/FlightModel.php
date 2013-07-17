<?php
/**
 * @file FlightModel.php
 * 
 * @autor Alex Letov
 * 
 * Flight model.
 */

class FlightModel extends CActiveRecord
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
         return 'flight';
    }
    
    public function relations()
    {
        return array(
            'airport' => array(self::BELONGS_TO, 'AirportModel', 'id'),
            'turnarounds' => array(self::HAS_MANY, 'TurnaroundModel', 'id'),
        );
    }
}
?>
