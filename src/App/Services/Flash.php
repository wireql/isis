<?php 

require_once 'UserSessions.php';

class Flash
{

    static public function setMessage($messageKey, $message) {
        UserSessions::setSessionVar($messageKey, $message);
    }

    static public function getMessage($messageKey) {
        $message = UserSessions::getSessionVar($messageKey);
        UserSessions::deleteSessionVar($messageKey);
        
        return $message;
    }
}
