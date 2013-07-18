<?php
/**
 * @file MainController.php
 * 
 * @autor Alex Letov
 * 
 * Main controller.
 */
class MainController extends CController
{
    public function actionIndex()
    {
        $this->render('main');
    }
    
    public function actionLogin()
    {
        if(!isset($_GET['IVAOTOKEN']))
        {
            $this->redirect(Yii::app()->params['login_url'].'?url='.$this->createAbsoluteUrl('main/login'));
        }
        $identity = new UserIdentity($_GET['IVAOTOKEN']);
        if($identity->authenticate())
        {
            Yii::app()->user->login($identity);
            $this->redirect($this->createUrl('main/'));
        }
        else
        {
            $this->redirect(Yii::app()->params['login_url'].'?url='.urlencode($this->createAbsoluteUrl('main/login')));
        }
    }
    
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('main'));
    }
}
?>
