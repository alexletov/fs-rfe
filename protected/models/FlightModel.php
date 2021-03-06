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
            'airport' => array(self::BELONGS_TO, 'AirportModel', 'airportid'),
            'book' => array(self::HAS_ONE, 'BookModel', 'flightid'),
        );
    }
    
    public function rules()
    {
        return array(
            array('airportid, fromicao, toicao, fromtime, totime, arrival, aircraft, airline, flightnumber', 'required'),
            array('fromicao, toicao, aircraft', 'length', 'min' => 4, 'max' => 4),
            array('airline', 'length', 'min' => 3, 'max' => 3),
            array('flightnumber', 'length', 'min' => 1, 'max' => 5),
            array('gate', 'length', 'min' => 0, 'max' => 5),
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
    
    public function getTurnaroundModel()
    {
        return TurnaroundModel::model()->find('flttoid = :flttoid OR fltfromid = :fltfromid', array(':flttoid' => $this->id, ':fltfromid' => $this->id,));
    }
    
    public function getBooking()
    {
        return BookModel::model()->find('flightid = :flightid', array(':flightid' => $this->id,));
    }
}
?>
