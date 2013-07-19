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
        
        $conditions = array();
        if($ac != null)
        {
            $active = $ac->active;
            $criteria = new CDbCriteria;
            if(isset($_POST['ac']) && !empty($_POST['ac']) && (strlen($_POST['ac']) == 3))
            {
                $criteria->addSearchCondition('airline', $_POST['ac']);
                $conditions['ac'] = $_POST['ac'];
            }
            if(isset($_POST['nr']) && !empty($_POST['nr']) && (strlen($_POST['nr']) < 5))
            {
                $criteria->addSearchCondition('flightnumber', $_POST['nr']);
                $conditions['nr'] = $_POST['nr'];
            }
            if(isset($_POST['acft']) && !empty($_POST['acft']) && (strlen($_POST['acft']) < 5))
            {
                $criteria->addSearchCondition('aircraft', $_POST['acft']);
                $conditions['acft'] = $_POST['acft'];
                
            }
            if(isset($_POST['to']) && !empty($_POST['to']) && (strlen($_POST['to']) < 5))
            {
                $criteria->addSearchCondition('toicao', $_POST['to']);
                $conditions['to'] = $_POST['to'];
            }
            if(isset($_POST['from']) && !empty($_POST['from']) && (strlen($_POST['from']) < 5))
            {
                $criteria->addSearchCondition('fromicao', $_POST['from']);
                $conditions['from'] = $_POST['from'];
            }
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
        $this->render('list', array('airport' => $ac, 'flights' => $flights, 'active' => $active, 'dir' => $dir, 'conditions' => $conditions));
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
