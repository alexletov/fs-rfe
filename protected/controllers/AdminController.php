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
