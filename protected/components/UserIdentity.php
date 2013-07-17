<?php
/**
 * @file UserIdentity.php
 * 
 * @autor Alex Letov
 * 
 * User identity class. Implement authentication using IVAO Login API.
 */

class UserIdentity extends CUserIdentity {

        private $token;
        public $errorCode;
        private $_id;

        function __construct($token)
        {
            $this->token = $token;
        }
        
        private function getData($token)
        {
            $user_array = json_decode(file_get_contents(Yii::app()->params['api_url'].'?type=json&token='.$token));
            $umodel = UserModel::model()->findByAttributes(array('vid'=>$user_array->vid));
            if($umodel === null)
            {
                $umodel = new UserModel;
            }
            if($user_array->result == 1)
            {                
                $umodel->vid = $user_array->vid;
                $umodel->firstname = $user_array->firstname;
                $umodel->lastname = $user_array->lastname;
                $umodel->rating = $user_array->rating;
                $umodel->ratingatc = $user_array->ratingatc;
                $umodel->ratingpilot = $user_array->ratingpilot;
                $umodel->division = $user_array->division;
                $umodel->expire = time() + (7 * 24 * 60 * 60);
                $umodel->save();
            }
        }
        
        public function authenticate()
        {
            if($this->token == 'error')
            {
                return 1;
            }
            
            /* Check if data in database. */
            $record = UserModel::model()->findByAttributes(array('token'=>$this->token),
                    'expire>NOW()');
            if($record === null)
            {
                /* No record found in database. Try to get data by token. */
                $this->getData($this->token);
                $record = UserModel::model()->findByAttributes(array('token'=>$this->token),
                            'expire>NOW()');
                }
                if($record === null)
                {
                    /* If no record again or expired - error. */
                    $this->errorCode = 1;
                }
                else
                {
                    /* If record found - authenticate user. */
                    $this->_id=$record->id;
                    $this->setState('vid', $record->vid);
                    $this->setState('firstname', $record->firstname);
                    $this->setState('lastname', $record->lastname);
                    $this->setState('rating', $record->rating);
                    $this->setState('ratingatc', $record->ratingatc);
                    $this->setState('ratingpilot', $record->ratingpilot);
                    $this->setState('division', $record->division);
                    $this->errorCode=0;
                }
            return !$this->errorCode;
        }

        public function getId()
        {
                return $this->_id;
        }
}
?>
