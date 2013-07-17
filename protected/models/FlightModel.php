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
        );
    }
    
    public function getTurnaround()
    {
        $ta = TurnaroundModel::model()->find('flttoid = :flttoid OR fltfromid = :fltfromid', array(':flttoid' => $this->id, ':fltfromid' => $this->id,));
        if($ta != null)
        {
            $taid = 0;
            if($this->id == $ta->flttoid)
            {
                $taid = $ta->fltfromid;
            }
            else
            {
                $taid = $ta->flttoid;
            }
            return FlightModel::model()->findByPk($taid);
        }
        return null;
    }
    
    public function getBooking()
    {
        return BookModel::model()->find('flightid = :flightid', array(':flightid' => $this->id,));
    }
}
?>
