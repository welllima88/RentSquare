<?php

class Message extends AppModel {

    var $name = 'Message';
    var $actsAs = array('Containable');
    var $belongsTo = array('Conversation', 'Sender' => array('className' => 'User', 'foreignKey' => 'sender_id'));

    var $validate = array(
        'to'    => array(
            'rule'    => array(
                'multiple', array(
                    'min' => 1
                )
            ),
            'message' => 'Please select at least one User'
        ),
        'title' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'allowEmpty' => false,
            'message'    => 'Please enter a subject'
        )
    );

    function afterSave($created)
    {
        if ( $created )
        {
            $id = $this->data['Message']['id'];
            $cid = $this->data['Message']['conversation_id'];

            ClassRegistry::init('Conversation')->updateMessages($cid);
        }
    }

    function send($from, $to, $title, $content, $conversationId = null)
    {
        if ( $conversationId == null )
        {
            $conversationId = ClassRegistry::init('Conversation')->createNew($from, $to, $title);
            if ( !$conversationId )
                return false;
        }
        $data['Message']['title'] = $title;
        $data['Message']['content'] = $content;
        $data['Message']['sender_id'] = $from;
        $data['Message']['conversation_id'] = $conversationId;
        if ( $this->save($data) )
        {
            return $this->id;
        }

        return false;
    }
}

;

?>
