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
