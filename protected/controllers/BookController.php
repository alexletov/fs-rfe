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
    public function actionBook()
    {
        $flightid = 0;
        if(isset($_GET['flight']))
        {
            $flightid = $_GET['flight'];
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
    }
}
?>
