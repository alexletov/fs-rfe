<?php
/**
 * @file TurnaroundModel.php
 * 
 * @autor Alex Letov
 * 
 * Turnaround model.
 */

class Turnaround extends CActiveRecord {
    public function getDbConnection(){
        return Yii::app()->db;
    }
 
    public function tableName(){
         return 'turnaround';
    }
    
    public function relations() {
        return array(
            'to' => array(self::HAS_ONE, 'Flight', 'flttoid'),
            'from' => array(self::HAS_ONE, 'Flight', 'fltfromid'),
        );
    }
}
?>
