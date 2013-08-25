<?php
/**
 * @file PageController.php
 * 
 * @autor Alex Letov
 * 
 * Page controller.
 */
class PageController extends CController
{    
    public function actionPartners($apt = 'ulli')
    {
        $this->render('partners', array('apt' => $apt));
    }
    
    public function actionAtc()
    {
        $this->render('atc');
    }
    
    public function actionBriefing()
    {
        $this->render('briefing');
    }
}
?>
