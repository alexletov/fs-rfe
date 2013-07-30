<?php
/**
 * @file SlotreserveModel.php
 * 
 * @autor Alex Letov
 * 
 * Slot reservation model.
 */

class SlotreserveModel extends CActiveRecord
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
         return 'slotreserve';
    }
    
    public function relations()
    {
        return array(
            'slot' => array(self::BELONGS_TO, 'SlotModel', 'slotid'),
            'user' => array(self::BELONGS_TO, 'UserModel', 'userid'),
        );
    }
    
    public function rules()
    {
        return array(
            array('userid, slotid, airport, arrival', 'required'),
            array('airport', 'length', 'min' => 4, 'max' => 4),
        );
    }
}
?>
