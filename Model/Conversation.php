<?php

class Conversation extends AppModel {

    var $name = 'Conversation';
    var $actsAs = array('Containable');
    var $hasMany = array(
        'Message',
        'ConversationsUser'
    );

    var $belongsTo = array(
        'Sender'      => array(
            'className'  => 'User',
            'foreignKey' => 'sender_id'
        ),
        'LastMessage' => array(
            'className'  => 'Message',
            'foreignKey' => 'last_msg_id'
        )
    );

    //var $hasAndBelongsToMany = array('User');

    function createNew($from, $to, $title)
    {
        is_array($to) or die("Conversation::create() passed non-array as 'to' parameter");

        //	Add the sender to the list of recipients for the conversation
        //	we'll their messages out from their own inbox
        array_push($to, $from);
        //	Filter out duplicates, so each user appears only once in the list
        $to = array_unique($to);

        $data['Conversation']['sender_id'] = $from;
        $data['Conversation']['title'] = $title;

        if ( $this->save($data) )
        {
            ClassRegistry::init('ConversationsUser')->addUsersTo($this->id, $to);

            return $this->id;
        }

        return false;
    }

    function updateMessages($id)
    {
        $this->contain(array('Message' => array('order' => 'Message.created DESC', 'limit' => 1)));
        $conv = $this->find('first', array('conditions' => array('Conversation.id' => $id)));

        if ( $conv )
        {
            $conv['Conversation']['last_msg_id'] = $conv['Message'][0]['id'];
            $conv['Conversation']['sender_id'] = $conv['Message'][0]['sender_id'];
            $conv['Conversation']['last_msg_time'] = $conv['Message'][0]['created'];
            //print_r($conv);
            if ( $this->save($conv) )
            {
                if ( ClassRegistry::init('ConversationsUser')->updateAll(array('status' => MSG_STATUS_UNREAD, 'last_msg_time' => "'" . $conv['Message'][0]['created'] . "'"), array('conversation_id' => $id, 'user_id !=' => $conv['Message'][0]['sender_id'])) )
                    return true;
            }
        } else
            die("Failed to load Conversation model for update");

        return false;
    }

    function get($id, $uid)
    {
        if ( ClassRegistry::init('ConversationsUser')->userHasAccess($uid, $id) )
        {
            $this->contain(array(
                    'Message'           => array('order' => array('Message.created ASC'), 'Sender' => array('Unit' => array('fields' => 'number'))),
                    'ConversationsUser' => array('User' => array('Unit' => array('fields' => 'number')))
                )
            );

            return $this->find('first', array('conditions' => array('Conversation.id' => $id)));
        }

        return null;
    }

   function loadPropertyName( $data ) 
   {
      foreach ($data as $key => $thisrec )
      {
         // If Property name not set, the sender was PM, and Property Name is an array of his properties.  We want to identify
         //  the particular property in question based on a resident in the email thread
         if ( isset($thisrec['Conversation']['Sender']['Property']['name']) && !empty($thisrec['Conversation']['Sender']['Property']['name']) && is_string($thisrec['Conversation']['Sender']['Property']['name']))
         {
            // Already set, no odifications needed
         }
         else
         {
             debug($thisrec);
             $convUserModel = ClassRegistry::init('ConversationsUser');
             $convusers = $convUserModel->find('first',array('conditions' => array( 
                                                                       'conversation_id' => $thisrec['ConversationsUser']['conversation_id'], 
                                                                       'user_id !=' => $thisrec['ConversationsUser']['user_id']
                                                                                          
                                                    )));
             if( isset($convusers) && !empty($convusers['User']['property_id']))
             {
                $propsModel = ClassRegistry::init('Property');
                $props = $propsModel->findById( $convusers['User']['property_id']);
                if (isset($props['Property']['name']) && !empty($props['Property']['name']))
                {
                   $data[$key]['Conversation']['Sender']['Property']['name'] = $props['Property']['name'];
                }
             }
         }
      }

      return $data;
   }
}

?>
