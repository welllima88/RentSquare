<?php


/**
 * A JSONPushNotification that can be use for sending unspecified push 
 * notifications to the SDKs that are encapsulated by a JSON Object
 * 
 * @author Rob Kurst <rob.kurst@basecommerce.com>
 */
class JSONPushNotification extends PushNotification {
    
    private $io_json;
    
    /**
     * default constructor that sets the type to JSON
     */
    function JSONPushNotification() {
        $this->is_type = PushNotification::$XS_PN_TYPE_JSON;
        $this->io_json = array();
    }
    
    /**
     * returns the JSON object
     * @return the JSON object
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public function getJSON() {
        $o_json = $this->io_json;
        $o_json["push_notification_type"] = $this->getNotificationType();
        return $o_json;
    }
    
    /**
     * private method used to set the json object
     * @param vo_json the json object to be set
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    private function setJSON( $vo_json ) {
        $this->io_json = $vo_json;
    }
    
    /**
     * creates a JSONPushNotification object from the passed in JSON object
     * 
     * @param type $vo_json the JSON object
     * @return JSONPushNotification with the JSON object in it
     * @author Rob Kurst <rob.kurst@basecommerce.com>
     */
    public static function buildFromJSON($vo_json) {
//        parent::buildFromJSON($vo_json);
        
        $o_return = new JSONPushNotification();
        $o_return->setJSON($vo_json);
        
        return $o_return;
    }
    
    
}
