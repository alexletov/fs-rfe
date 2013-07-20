<?php
/**
 * @file BookController.php
 * 
 * @autor Alex Letov
 * 
 * Booking controller.
 */
class BookController extends CController
{
    public function actionBook($flight)
    {
        $flightid = $flight;
        if(Yii::app()->user->isGuest)
        {
            $this->redirect($this->createAbsoluteUrl('main/login'));
            return;
        }
        $flight = FlightModel::model()->findByPk($flightid);
        if($flight === null)
        {
            $this->render('fnotfound');
            return;
        }
        $booking = $flight->getBooking();
        if($booking != null)
        {
            $this->render('falreadybooked', array('bookid' => $booking->id));
            return;
        }
        $ta = $flight->getTurnaround();
        $this->render('prebook', array('flight' => $flight, 'ta' => $ta));
    }
    
    
    public function actionFlightregister($flight, $ta = 0)
    {
        echo $flight.' '.$ta;
        return;
    }
}
?>
