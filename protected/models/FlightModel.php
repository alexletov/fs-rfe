<?php
/**
 * @file FlightModel.php
 * 
 * @autor Alex Letov
 * 
 * Flight model.
 */

class Flight extends CActiveRecord {
    public function getDbConnection(){
        return Yii::app()->db;
    }
 
    public function tableName(){
         return 'flight';
    }
    
    public function relations() {
        return array(
            'airport' => array(self::BELONGS_TO, 'Airport', 'id'),
        );
    }
}
?>
