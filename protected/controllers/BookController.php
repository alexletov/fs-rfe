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
        $mbooking = new BookModel;
        $f = FlightModel::model()->findByPk($flight);
        
        if($f == null)
        {
            $this->render('fnotfound');
            return;
        }
        $t = $f->getTurnaround();
        if(($ta == 1) && ($t != null))
        {
            $ta = 1;
            $tbooking = new BookModel;
        }
        else
        {
            $ta = 0;
        }
        
        $mbooking->flightid = $f->id;
        $mbooking->userid = Yii::app()->user->getId();
        if($ta == 1)
        {
            $tbooking->flightid = $t->id;;
            $tbooking->userid = Yii::app()->user->getId();
        }
        
        $fb = $f->getBooking();
        if($fb != null)
        {
            $this->render('falreadybooked', array('bookid' => $fb->id));
            return;
        }
        else
        {
            if($ta == 1)
            {
                $tb = $t->getBooking();
                if($tb != null)
                {
                    $this->render('falreadybooked', array('bookid' => $tb->id, 'ta' => 1));
                    return;
                }
            }
            $success2 = true;
            $success = $mbooking->save();
            if(($ta == 1) && ($success))
            {
                $success2 = $tbooking->save();
            }
            if($success && $success2)
            {
                $this->render('fbsuccess', array('ta' => $ta));
            }
            else
            {
                if($success)
                {
                    $this->render('fberror', array('ta' => $ta, 'errta' => 1));
                }
                else
                {
                    $this->render('fberror', array('ta' => $ta, 'errta' => 0));
                }
            }
        }
    }
    
    public function actionDetails($booking)
    {
        $book = BookModel::model()->findByPk($booking);
        if($book === null)
        {
            $this->render('bnotfound');
            return;
        }
        $flight = $book->getRelated('flight');
        $user = $book->getRelated('user');
        if($flight === null)
        {
            $this->render('fnotfound');
            return;
        }
        $ta = $flight->getTurnaround();
        
        $this->render('bdetails', array('flight' => $flight, 'ta' => $ta, 'user' => $user));
    }
    
    public function filters()
    {
        return array(
            'AccessControl',
        );
    }
    
    public function filterAccessControl($filterChain)
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect($this->createAbsoluteUrl('main/login'));
            return;
        }
        $filterChain->run();
    }
}
?>
