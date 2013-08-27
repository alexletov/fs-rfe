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
    
    public function actionProgress()
    {
        $flc = FlightModel::model()->count();
        $bc = BookModel::model()->count();
        $progress = $bc / $flc;
        
        $slc = SlotModel::model()->count();
        $sc = SlotreserveModel::model()->count();
        
        $sprogress = $sc / $slc;
        $this->render('progress', array('progress' => $progress, 'sprogress' => $sprogress));
    }
}
?>
