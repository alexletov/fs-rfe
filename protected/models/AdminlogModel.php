<?php
/**
 * @file AdminlogModel.php
 * 
 * @autor Alex Letov
 * 
 * Log for admin actions model.
 */

class AdminlogModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
        
    public function getDbConnection()
    {
        return Yii::app()->db;
    }
 
    public function tableName()
    {
         return 'adminlog';
    }
    
    static public function addLog($success, $msg = '')
    {
        $log = new AdminlogModel;
        $log->userid = Yii::app()->user->isGuest ? 0 : Yii::app()->user->getId();
        $user = UserModel::model()->findByPk($log->userid);
        $log->vid = ($user == null) ? -1 : $user->vid;
        $log->isadmin = UserModel::isAdmin(Yii::app()->user->getId());
        $log->ip = Yii::app()->getRequest()->userHostAddress;
        $log->url = Yii::app()->getRequest()->requestUri;
        $log->result = $success;
        $log->message = $msg;
        $log->save();
    }
}
?>
