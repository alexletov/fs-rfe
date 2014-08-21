<?php
/**
 * @file UserController.php
 * 
 * @autor Alex Letov
 * 
 * User controller.
 */
class UserController extends CController
{
    public function actionMyreserved()
    {
        $userid = Yii::app()->user->getId();
        $flights = BookModel::model()->findAll('userid = :userid', array(':userid' => $userid));
        $slots = SlotreserveModel::model()->findAll('userid = :userid', array(':userid' => $userid));
        $this->render('list', array('flights' => $flights, 'slots' => $slots));
    }
    
    public function actionDeletebook($id)
    {
        $book = BookModel::model()->findByPk($id);
        if($book === null)
        {
            $this->render('rmnotfonud', array('type' => 'book'));
            return;
        }
        if($book->userid != Yii::app()->user->getId())
        {
            $this->render('rmuerror', array('type' => 'book'));
            return;
        }
        if($book->delete())
        {
            if(file_exists(Yii::app()->getBasePath().'/images/boardingpass/f'.$id.'.png'))
            {
                unlink(Yii::app()->getBasePath().'/images/boardingpass/f'.$id.'.png');
            }
            $this->render('rmsuccess', array('type' => 'book'));
        }
        else
        {
            $this->render('rmdberror', array('type' => 'book'));
        }
    }
    
    public function actionDeletereserve($id)
    {
        $book = SlotreserveModel::model()->findByPk($id);
        if($book === null)
        {
            $this->render('rmnotfonud', array('type' => 'slotr'));
            return;
        }
        if($book->userid != Yii::app()->user->getId())
        {
            $this->render('rmuerror', array('type' => 'slotr'));
            return;
        }
        if($book->delete())
        {
            $this->render('rmsuccess', array('type' => 'slotr'));
        }
        else
        {
            $this->render('rmdberror', array('type' => 'slotr'));
        }
    }
    
    public function actionBp($booking)
    {
        $book = BookModel::model()->findByPk($booking);
        if($book === null)
        {
            $this->render('bnfound');
        }
        else
        {
            if($book->userid != Yii::app()->user->getId())
            {
                $this->render('accessdenied', array('type' => 'slotr'));
                return;
            }
            $this->render('boardingpass', array('booking' => $booking));
        }
    }
    
    public function actionBpimg($booking)
    {
        $book = BookModel::model()->findByPk($booking);
        
        if($book === null)
        {
            return;
        }
        
        if($book->userid != Yii::app()->user->getId())
        {
            $this->render('accessdenied', array('type' => 'slotr'));
            return;
        }
        
        if(file_exists(Yii::app()->getBasePath().'/images/boardingpass/f'.$booking.'.png'))
        {
            $file = Yii::app()->getBasePath().'/images/boardingpass/f'.$booking.'.png';
            $stream = fopen($file, 'rb');
            $data   = fread($stream,filesize($file));
            fclose($stream);
            if (!is_bool($data)) {
                   header('Content-Type: image/png');
                   echo $data;
            }
            return;
        };        
        
        $flight = $book->getRelated('flight');
        $apt = $flight->getRelated('airport');
        $event = $apt->getRelated('event');
        
        if(($flight == null) || ($apt == null) || ($event == null))
        {
            return;
        }
        
        
        $ename = $event->name;
        $airline = $flight->airline;
        $flightnumber = $flight->flightnumber;
        $gate = $flight->gate;
        $departure_time = date('H:i', strtotime($flight->fromtime));
        $boarding_time = date('H:i', strtotime($flight->fromtime)-30*60);
        $_event_date = new DateTime($event->start);
        $event_date = strtoupper($_event_date->format('d M Y'));
        $passname = strtoupper(Yii::app()->user->firstname.' '.Yii::app()->user->lastname);
        $fromicao = $flight->fromicao;
        $toicao = $flight->toicao;
        $fapt = AirportdbModel::getByICAO($fromicao);
        $fromname = $fapt != null ? $fapt->name : '';
        $tapt = AirportdbModel::getByICAO($toicao);
        $toname = $tapt != null ? $tapt->name : '';
        
        
        
        if (Yii::app()->params['use_gd']) {
            $image = imagecreatefrompng(Yii::app()->getBasePath().'/images/boardingpass/template.png');
            
            $font = Yii::app()->getBasePath().'/images/boardingpass/courbd.ttf';
            $black_color = imagecolorallocate($image, 0x00, 0x00, 0x00);
            $red_color = imagecolorallocate($image, 0xFF, 0x00, 0x00);
            $white_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
            
            imagettftext($image, 35, 0, 50, 60, $red_color, $font, $ename);
            
            imagettftext($image, 30, 0, 130, 125, $black_color, $font, $boarding_time);
            imagettftext($image, 30, 0, 300, 125, $black_color, $font, $event_date);
            imagettftext($image, 30, 0, 735, 180, $black_color, $font, $departure_time);
            imagettftext($image, 30, 0, 340, 205, $black_color, $font, $fromicao);
            imagettftext($image, 30, 0, 520, 205, $black_color, $font, $toicao);
            imagettftext($image, 30, 0, 690, 325, $white_color, $font, $airline.$flightnumber);
            
            imagettftext($image, 23, 0, 50, 300, $white_color, $font, $airline.$flightnumber);
            imagettftext($image, 23, 0, 200, 300, $white_color, $font, $gate);
            imagettftext($image, 23, 0, 310, 300, $white_color, $font, $departure_time);
            imagettftext($image, 20, 0, 680, 255, $black_color, $font, $fromicao);
            imagettftext($image, 20, 0, 780, 255, $black_color, $font, $toicao);
            imagettftext($image, 17, 0, 50, 185, $black_color, $font, substr($passname, 0, 21));
            imagettftext($image, 15, 0, 675, 112, $black_color, $font, strtoupper(Yii::app()->user->firstname));
            imagettftext($image, 15, 0, 675, 132, $black_color, $font, strtoupper(Yii::app()->user->lastname));
            
            imagettftext($image, 15, 0, 421, 237, $black_color, $font, substr($fromname, 0, 20));
            imagettftext($image, 15, 0, 421, 260, $black_color, $font, substr($toname, 0, 20));
            imagettftext($image, 10, 0, 558, 340, $black_color, $font, $airline);
            
            $otffont = Yii::app()->getBasePath().'/images/boardingpass/bc.otf';
            imagettftext($image, 12, 0, 430, 315, $black_color, $otffont, '*'.$airline.$flightnumber.'/'.$booking.'*');
            
            imagegif($image, Yii::app()->getBasePath().'/images/boardingpass/f'.$booking.'.png');
            header("Content-Type: image/png");
            imagegif($image);
            
            imagedestroy($image);
        } else {
            $image = new Imagick(Yii::app()->getBasePath().'/images/boardingpass/template.png');
            //$image->thumbnailImage(900, 0);
            
            $draw = new ImagickDraw();
            $draw->setFont(Yii::app()->getBasePath().'/images/boardingpass/courbd.ttf');
            $draw->setFontSize(35);
            $draw->setFillColor('red');
            $draw->setGravity(Imagick::GRAVITY_NORTHWEST);           
                   
            $image->annotateImage($draw, 50, 30, 0, $ename);
            
            $draw->setFontSize(30);
            $image->annotateImage($draw, 130, 115, 0, $boarding_time);
            $image->annotateImage($draw, 300, 115, 0, $event_date);
            $image->annotateImage($draw, 735, 170, 0, $departure_time);
            $draw->setFillColor('black');
            $image->annotateImage($draw, 340, 170, 0, $fromicao);
            $image->annotateImage($draw, 520, 170, 0, $toicao);
            
            $draw->setFillColor('white');
            $image->annotateImage($draw, 690, 305, 0, $airline.$flightnumber);
            
            $draw->setFontSize(25);
            $image->annotateImage($draw, 55, 280, 0, $airline.$flightnumber);
            $image->annotateImage($draw, 200, 280, 0, $gate);
            $image->annotateImage($draw, 310, 280, 0, $departure_time);
            
            $draw->setFillColor('black');
            $image->annotateImage($draw, 680, 235, 0, $fromicao);
            $image->annotateImage($draw, 780, 235, 0, $toicao);
            
            $draw->setFontSize(20);
            $draw->setFillColor('black');
            $image->annotateImage($draw, 50, 165, 0, substr($passname, 0, 21));
            
            $draw->setFontSize(15);
            
            $image->annotateImage($draw, 675, 92, 0, strtoupper(Yii::app()->user->firstname));
            $image->annotateImage($draw, 675, 112, 0, strtoupper(Yii::app()->user->lastname));
            
            $draw->setFillColor('black');
            $draw->setGravity(Imagick::GRAVITY_SOUTHEAST);  
            $image->annotateImage($draw, 450, 182, 0, substr($fromname, 0, 20));
            $draw->setGravity(Imagick::GRAVITY_NORTHWEST);  
            $image->annotateImage($draw, 490, 205, 0, substr($toname, 0, 20));
            
            $draw->setFontSize(10);
            $image->annotateImage($draw, 558, 330, 0, $airline);
            
            $draw->setFont(Yii::app()->getBasePath().'/images/boardingpass/bc.otf');
            $draw->setFontSize(17);
            $draw->setFillColor('black');
            $image->annotateImage($draw, 430, 255, 0, '*'.$airline.$flightnumber.'/'.$booking.'*');
            
            $image->writeImage(Yii::app()->getBasePath().'/images/boardingpass/f'.$booking.'.png');
            header("Content-Type: image/png");
            echo $image;
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
        if(Yii::app()->user->isGuest)
        {
            $this->redirect($this->createAbsoluteUrl('main/login'));
            return;
        }
        $filterChain->run();
    }
}
?>
