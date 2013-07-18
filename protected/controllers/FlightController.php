<?php
/**
 * @file FlightController.php
 * 
 * @autor Alex Letov
 * 
 * Flight controller.
 */

class FlightController extends CController
{
    public $defaultAction = 'list';
    
    public function actionArrivals()
    {
        $this->_list(1);
    }
    
    public function actionDepartures()
    {
        $this->_list(0);
    }
    
    private function _list($dir)
    {
        $id = 0;
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $ac = AirportModel::model()->findByPk($id);
        
        $flights = array();
        if($ac != null)
        {
            $active = $ac->active;
            $criteria = new CDbCriteria;
            if($dir)
            {
                $criteria->order = 'flights.totime ASC';
            }
            else
            {
                $criteria->order = 'flights.fromtime ASC';
            }
            $flights = $ac->getRelated('flights', false, $criteria); /* Getting flights for this airport. */
        }
        else {
            $active = true;
        }
        $this->render('list', array('airport' => $ac, 'flights' => $flights, 'active' => $active, 'dir' => $dir));
    }
    
    public function actionEvents()
    {
        $id = 1;
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $event = EventModel::model()->findByPk($id);
        if($event != null)
        {
            $apts = $event->getRelated('airports', false, array('active' => 1));
        }
        $ap = array();
        $i = 0;
        if($apts != null)
        {
            foreach($apts as $value)
            {
                $ap[$i] = $value;
                $i++;
            }
        }
        $this->render('airports', array('airports' => $ap, 'count' => $i));
    }
    
    public function actionSlots()
    {
        $id = 1;
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $ac = AirportModel::model()->findByPk($id);
        
        $slots = array();
        if($ac != null)
        {
            $active = $ac->active;
            $criteria = new CDbCriteria;
            $criteria->order = 'slots.time ASC';
            $slots = $ac->getRelated('slots', false, $criteria); /* Getting flights for this airport. */
        }
        else {
            $active = true;
        }
        $this->render('slotlist', array('airport' => $ac, 'slots' => $slots, 'active' => $active));
    }
}

?>
