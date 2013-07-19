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
            $this->render('noaccess');
            return false;
        }
        $filterChain->run();
    }
}
?>
