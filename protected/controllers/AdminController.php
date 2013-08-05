<?php
/**
 * @file AdminController.php
 * 
 * @autor Alex Letov
 * 
 * Admin controller.
 */
class AdminController extends CController
{   
    private $admin;
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionRemovebook($id)
    {
        $booking = BookModel::model()->findByPk($id);
        if($booking != null)
        {
            $uid = $booking->userid;
            $fid = $booking->flightid;
            if($booking->delete())
            {
                if(file_exists(Yii::app()->getBasePath().'/images/boardingpass/f'.$id.'.png'))
                {
                    unlink(Yii::app()->getBasePath().'/images/boardingpass/f'.$id.'.png');
                }
                AdminlogModel::addLog('success', 'Booking '.$id.' (userid='.$uid.', flightid='.$fid.') removed from database.');
                $this->render('bdsuccess', array('id' => $id));
            }
            else
            {
                AdminlogModel::addLog('error', 'Booking '.$id.' (userid='.$uid.', flightid='.$fid.') wasn\'t removed from database. Database error');
                $this->render('bderror', array('id' => $id, 'type' => 'db'));
            }
        }
        else
        {
            AdminlogModel::addLog('error', 'Booking '.$id.' not found in database.');
            $this->render('bderror', array('id' => $id, 'type' => 'nf'));
        }        
    }
    
    public function actionRemoveflight($id)
    {
        $flight = FlightModel::model()->findByPk($id);
        $book = $flight->getBooking();
        if($book != NULL)
        {
            if(file_exists(Yii::app()->getBasePath().'/images/boardingpass/f'.$book->id.'.png'))
            {
                unlink(Yii::app()->getBasePath().'/images/boardingpass/f'.$book->id.'.png');
            }
        }
        if($flight != null)
        {
            $fltdetails = ' airportid: '.$flight->airportid.
                ', fromicao: '.$flight->fromicao.
                ', toicao: '.$flight->toicao.
                ', fromtime: '.$flight->fromtime.
                ', totime: '.$flight->totime.
                ', arrival: '.$flight->arrival.
                ', aircraft: '.$flight->aircraft.
                ', gate: '.$flight->gate.
                ', airline: '.$flight->airline.
                ', flightnumber: '.$flight->flightnumber;
            
            if($flight->delete())
            {
                AdminlogModel::addLog('success', 'Flight '.$id.' removed from database. Flight details: '.$fltdetails);
                $this->render('fdsuccess', array('id' => $id));
            }
            else
            {
                AdminlogModel::addLog('error', 'Flight '.$id.' wasn\'t removed from database. database error. Flight details: '.$fltdetails);
                $this->render('fderror', array('id' => $id, 'type' => 'db'));
            }
        }
        else
        {
            AdminlogModel::addLog('error', 'Flight '.$id.' not found in database.');
            $this->render('fderror', array('id' => $id, 'type' => 'nf'));
        }        
    }
    
    public function actionAddflight($apt, $arrival)
    {
        if(!(isset($_POST['from']) || isset($_POST['to']) || isset($_POST['dtime'])
                || isset($_POST['atime']) || isset($_POST['aircraft']) || isset($_POST['gate'])
                || isset($_POST['company']) || isset($_POST['flightnumber'])))
        {
            AdminlogModel::addLog('error', 'Add flight fail: not all data recieved.');
            $this->render('fanodata');
            return;
        }
        
        
        $fm = new FlightModel;
        $fm->airportid = $apt;
        $fm->fromicao = $_POST['from'];
        $fm->toicao = $_POST['to'];
        $fm->fromtime = $_POST['dtime'];
        $fm->totime = $_POST['atime'];
        $fm->arrival = $arrival;
        $fm->aircraft = $_POST['aircraft'];
        $fm->gate = isset($_POST['gate']) ? $_POST['gate'] : '';
        $fm->airline = $_POST['company'];
        $fm->flightnumber = $_POST['flightnumber'];
        
        $fltdetails = ' airportid: '.$fm->airportid.
                ', fromicao: '.$fm->fromicao.
                ', toicao: '.$fm->toicao.
                ', fromtime: '.$fm->fromtime.
                ', totime: '.$fm->totime.
                ', arrival: '.$fm->arrival.
                ', aircraft: '.$fm->aircraft.
                ', gate: '.$fm->gate.
                ', airline: '.$fm->airline.
                ', flightnumber: '.$fm->flightnumber;
        
        $airport = AirportModel::model()->findByPk($apt);
        if($airport != null)
        {
            if($arrival)
            {
                if($airport->icao != $fm->toicao)
                {
                    $error = 'Airport ICAO and arrival ICAO wasn\'t equals.';
                    AdminlogModel::addLog('error', 'Couldn\'t save new flight. Flight details:'.
                        $fltdetails.
                        '. Error details: '.$error);
                    $this->render('faerror', array('error' => $error));
                    return;
                }
            }
            else
            {
                if($airport->icao != $fm->fromicao)
                {
                    $error = 'Airport ICAO and departure ICAO wasn\'t equals.';
                    AdminlogModel::addLog('error', 'Couldn\'t save new flight. Flight details:'.
                        $fltdetails.
                        '. Error details: '.$error);
                    $this->render('faerror', array('error' => $error));
                    return;
                }
            }
        }
        else
        {
            $error = 'Airport doesn\'t exists in database.';
            AdminlogModel::addLog('error', 'Couldn\'t save new flight. Flight details:'.
                $fltdetails.
                '. Error details: '.$error);
            $this->render('faerror', array('error' => $error));
            return;
        }
        
        if(!$fm->validate())
        {
            $error = $fm->getErrors();
            AdminlogModel::addLog('error', 'Couldn\'t save new flight. Validation error. Flight details:'.
                $fltdetails.
                '. Error details: '.var_export($error, true));
            $this->render('faerror', array('error' => $error, true));
            return;
        }
        
        if($fm->save())
        {
            AdminlogModel::addLog('success', 'Flight successfully added: id '.$fm->id.'. Flight details:'.
                $fltdetails);
            $this->render('fasuccess');
        }
        else
        {
            $error = 'Database error.';
            AdminlogModel::addLog('error', 'Couldn\'t save new flight. Database error. Flight details:'.
                $fltdetails.
                '.');
            $this->render('faerror', array('error' => $error));
        }        
    }
    
    public function actionUnlinkta($id1, $id2)
    {
        $flight1 = FlightModel::model()->findByPk($id1);
        $flight2 = FlightModel::model()->findByPk($id2);
        if($flight1 === null)
        {
            AdminlogModel::addLog('error', 'Flight not found: '.$id1);
            $this->render('fanfound');
            return;
        }
        
        if($flight2 === null)
        {
            AdminlogModel::addLog('error', 'Flight not found: '.$id1);
            $this->render('fanfound');
            return;
        }
        $fltdetails1 = 'id: '.$flight1->id.
                ' airportid: '.$flight1->airportid.
                ', fromicao: '.$flight1->fromicao.
                ', toicao: '.$flight1->toicao.
                ', fromtime: '.$flight1->fromtime.
                ', totime: '.$flight1->totime.
                ', arrival: '.$flight1->arrival.
                ', aircraft: '.$flight1->aircraft.
                ', gate: '.$flight1->gate.
                ', airline: '.$flight1->airline.
                ', flightnumber: '.$flight1->flightnumber;
        
        $fltdetails2 = 'id: '.$flight2->id.
                ' airportid: '.$flight2->airportid.
                ', fromicao: '.$flight2->fromicao.
                ', toicao: '.$flight2->toicao.
                ', fromtime: '.$flight2->fromtime.
                ', totime: '.$flight2->totime.
                ', arrival: '.$flight2->arrival.
                ', aircraft: '.$flight2->aircraft.
                ', gate: '.$flight2->gate.
                ', airline: '.$flight2->airline.
                ', flightnumber: '.$flight2->flightnumber;
        
        $ta = $flight1->getTurnaround();
        
        if($ta === null)
        {
            AdminlogModel::addLog('error', 'Turnaround not found: flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('tanfound');
            return;
        }
        
        $ta1 = $flight1->getTurnaroundModel();
        $ta2 = $flight2->getTurnaroundModel();
        
        if($ta1 === null)
        {
            AdminlogModel::addLog('error', 'Turnaround record for flight 1 not found: flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('tamnfound');
            return;
        }
        
        if($ta2 === null)
        {
            AdminlogModel::addLog('error', 'Turnaround record for flight 2 not found: flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('tamnfound');
            return;
        }
        
        if(($ta->id != $flight2->id) || ($ta1->id != $ta2->id))
        {
            AdminlogModel::addLog('error', 'This turnaround not for flight 1 and flight 2: flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('tanerror');
            return;
        }
        $taid = $ta1->id;
        if($ta1->delete())
        {
            AdminlogModel::addLog('success', 'Turnaround (id: '.$taid.') deleted: flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('tadsuccess');
        }
        else
        {
            AdminlogModel::addLog('success', 'Turnaround wasn\'t deleted. Database error. Flights('.$id1.', '.$id2.
                    '). Flight details 1: '.$fltdetails1.'. Flight details 2: '.$fltdetails2);
            $this->render('taderror');
        }
    }
    
    public function actionRemoveslot($id)
    {
        $slot = SlotModel::model()->findByPk($id);
        if($slot != null)
        {
            $slotdetails = ' slottime: '.$slot->time;
            
            if($slot->delete())
            {
                AdminlogModel::addLog('success', 'Slot '.$id.' removed from database. Slot details: '.$slotdetails);
                $this->render('sdsuccess', array('id' => $id));
            }
            else
            {
                AdminlogModel::addLog('error', 'Slot '.$id.' wasn\'t removed from database. database error. Slot details: '.$slotdetails);
                $this->render('sderror', array('id' => $id, 'type' => 'db'));
            }
        }
        else
        {
            AdminlogModel::addLog('error', 'Slot '.$id.' not found in database.');
            $this->render('sderror', array('id' => $id, 'type' => 'nf'));
        }        
    }
    
    public function actionRemovereserve($id)
    {
        $sr = SlotreserveModel::model()->findByPk($id);
        if($sr != null)
        {
            $uid = $sr->userid;
            $fid = $sr->slotid;
            if($sr->delete())
            {
                AdminlogModel::addLog('success', 'Slot reservation '.$id.' (userid='.$uid.', slotid='.$fid.') removed from database.');
                $this->render('rdsuccess', array('id' => $id));
            }
            else
            {
                AdminlogModel::addLog('error', 'Slot reservation '.$id.' (userid='.$uid.', slotid='.$fid.') wasn\'t removed from database. Database error');
                $this->render('rderror', array('id' => $id, 'type' => 'db'));
            }
        }
        else
        {
            AdminlogModel::addLog('error', 'Slot reservation '.$id.' not found in database.');
            $this->render('rderror', array('id' => $id, 'type' => 'nf'));
        }        
    }
    
    public function actionAddslot($apt)
    {
        if(!(isset($_POST['time'])))
        {
            AdminlogModel::addLog('error', 'Add slot fail: not all data recieved.');
            $this->render('sanodata');
            return;
        }
        $slot = new SlotModel;
        $slot->airportid = $apt;
        $slot->time = $_POST['time'];
        
        $slotdetails = ' airportid: '.$slot->airportid.
                ', time: '.$slot->time;
        
        $airport = AirportModel::model()->findByPk($apt);
        if($airport === null)
        {
            $error = 'Airport doesn\'t exists in database.';
            AdminlogModel::addLog('error', 'Couldn\'t save new slot. Slot details:'.
                $slotdetails.
                '. Error details: '.$error);
            $this->render('saerror', array('error' => $error));
            return;
        }
        
        if(!$slot->validate())
        {
            $error = $slot->getErrors();
            AdminlogModel::addLog('error', 'Couldn\'t save new slot. Validation error. Slot details:'.
                $slotdetails.
                '. Error details: '.var_export($error, true));
            $this->render('saerror', array('error' => $error, true));
            return;
        }
        
        if($slot->save())
        {
            AdminlogModel::addLog('success', 'Slot successfully added: id '.$slot->id.'. Slot details:'.
                $slotdetails);
            $this->render('sasuccess');
        }
        else
        {
            $error = 'Database error.';
            AdminlogModel::addLog('error', 'Couldn\'t save new slot. Database error. Slot details:'.
                $slotdetails.
                '.');
            $this->render('saerror', array('error' => $error));
        }  
    }
    
    public function filters()
    {
        return array(
            'AccessControl',
        );
    }
    
    public function filterAccessControl($filterChain)
    {
        $this->admin = UserModel::isAdmin(Yii::app()->user->getId());
        if(!$this->admin)
        {
            AdminlogModel::addLog('unauthorized access', Yii::app()->request->urlReferrer);
            $this->render('noaccess');
            return false;
        }
        $filterChain->run();
    }
}
?>
