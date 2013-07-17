<?php
/**
 * @file TurnaroundModel.php
 * 
 * @autor Alex Letov
 * 
 * Turnaround model.
 */

class TurnaroundModel extends CActiveRecord
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
         return 'turnaround';
    }
    
    public function relations()
    {
        return array(
            'to' => array(self::HAS_ONE, 'FlightModel', 'flttoid'),
            'from' => array(self::HAS_ONE, 'FlightModel', 'fltfromid'),
        );
    }
}
?>
