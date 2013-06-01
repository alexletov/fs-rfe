<?php
/**
 * @file EventModel.php
 * 
 * @autor Alex Letov
 * 
 * Event model.
 */

class Event extends CActiveRecord {
    public function getDbConnection(){
        return Yii::app()->db;
    }
 
    public function tableName(){
         return 'event';
    }
    
    public function relations() {
        return array(
            'airports' => array(self::HAS_MANY, 'Airport', 'eventid'),
        );
    }
}
?>
