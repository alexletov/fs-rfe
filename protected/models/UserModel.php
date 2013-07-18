<?php
/**
 * @file UserModel.php
 * 
 * @autor Alex Letov
 * 
 * User model.
 */

class UserModel extends CActiveRecord
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
         return 'user';
    }
        
    public static function isAdmin($id)
    {
        $user = UserModel::model()->findByPk($id);
        if($user != null)
        {
            return AdminModel::model()->find('vid = :vid', array(':vid' => $user->vid,)) != null;
        }
        else
        {
            return false;
        }
    }
}
?>
