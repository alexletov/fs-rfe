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
        $this->render('index');
    }
}
?>
