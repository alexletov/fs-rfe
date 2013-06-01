<?php
/**
 * @file UserModel.php
 * 
 * @autor Alex Letov
 * 
 * User model.
 */

class User extends CActiveRecord {
    public function getDbConnection(){
        return Yii::app()->db;
    }
 
    public function tableName(){
         return 'user';
    }
}
?>
