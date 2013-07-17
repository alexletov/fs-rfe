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
    public function actionView()
    {
        $id = 0;
        if(iseet($_GET['id']))
        {
            $id = $_GET['id'];
        }
        $ac = AirportModel::model()->findByPk($id);
        $flights = $ac->getRelated('flights'); /* Getting flights for this airport. */
        $this->render('list', array('flights' => flights));
    }
}

?>
