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
