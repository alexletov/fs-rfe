<?php
/**
 * @file AirportdbModel.php
 * 
 * @autor Alex Letov
 * 
 * Airport database model.
 */

class AirportdbModel extends CActiveRecord
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
         return 'airportdb';
    }
    
    static public function getByICAO($icao)
    {
        return AirportdbModel::model()->find('icao = :icao', array(':icao' => $icao));
    }
}
?>
