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
