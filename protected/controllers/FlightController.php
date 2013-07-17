<?php
/**
 * @file FlightController.php
 * 
 * @autor Alex Letov
 * 
 * Flight controller.
 */

class FlightController extends CController
{
    public $defaultAction = 'list';
    
    public function actionList()
    {
        $id = 0;
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $ac = AirportModel::model()->findByPk($id);
        $active = $ac->active;
        $flights = array();
        if($ac != null)
        {
            $flights = $ac->getRelated('flights'); /* Getting flights for this airport. */
        }
        else {
            $active = true;
        }
        $this->render('list', array('flights' => $flights, 'active' => $active));
    }
}

?>
