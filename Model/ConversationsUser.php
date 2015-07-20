<?php

class ConversationsUser extends AppModel {

    public $paginate = array(
        'limit'   => 3,
        'order'   => array('ConversationsUser.last_msg_time' => 'DESC'),
        'contain' => array('asdflkjasdf')
    );

    var $actsAs = array('Containable');

    var $belongsTo = array('User', 'Conversation');

    function userHasAccess($uid, $cid)
    {
        return $this->find('first', array('conditions' => array('user_id' => $uid, 'conversation_id' => $cid)));
    }

    function addUsersTo($cid, $users)
    {
        $data = array();
        foreach ( $users as $user )
        {
            array_push($data, array('conversation_id' => $cid, 'user_id' => $user, 'status' => MSG_STATUS_READ));
        }

        return $this->saveAll($data);
    }

    function status($cid, $uid, $status = null)
    {
        $convUser = $this->find('first', array('conditions' => array('conversation_id' => $cid, 'user_id' => $uid)));
        if ( $status != null )
        {
            $convUser['ConversationsUser']['status'] = $status;
            $this->save($convUser);
        }

        return $convUser['ConversationsUser']['status'];
    }

    function getUnreadCount($uid)
    {
        return $this->find('count', array('conditions' => array('ConversationsUser.status' => MSG_STATUS_UNREAD, 'ConversationsUser.user_id' => $uid)));
    }

}

;

?>
