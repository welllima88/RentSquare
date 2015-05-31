<?php
	class MaintenanceTicket extends AppModel{
		var $name = 'MaintenanceTicket';

		var $actsAs = array('Containable');
		var $belongsTo = array(
			'Tenant' => array(
				'className' => 'User',
				'foreignKey' => 'tenant_id'
				),
			'Property'
			);

		function findAllForProperty($propId, $options = array()){
			is_array($options) or die("Passed non-array to MaintenanceTicket::findAllForProperty()");

			if(!isset($options['conditions']))
				$options['conditions'] = array();

			$options['conditions']['MaintenanceTicket.property_id'] = $propId;

			if(!isset($options['order']))
				$options['order'] = array('MaintenanceTicket.created DESC');

			return $this->find('all', $options);
		}

		function findAllForUser($uid, $options = array()){
			is_array($options) or die("Passed non-array to MaintenanceTicket::findAllForUser()");

			if(!isset($options['conditions']))
				$options['conditions'] = array();

			$options['conditions']['MaintenanceTicket.tenant_id'] = $uid;

			if(!isset($options['order']))
				$options['order'] = array('MaintenanceTicket.created DESC');

			return $this->find('all', $options);
		}

		function get($id, $user, $curProp){
			$conditions = array('MaintenanceTicket.id' => $id);

			if($user['type'] == USER_TYPE_TENANT)
				$conditions['MaintenanceTicket.tenant_id'] = $user['id'];
			else
				$conditions['MaintenanceTicket.property_id'] = $curProp;

			return $this->find('first', array('conditions' => $conditions));
		}
		function getUnreadMaintCount( $user, $curProp_id, $status){
  		$conditions = array();
			if($user['type'] == USER_TYPE_TENANT)
                        {
				$conditions['MaintenanceTicket.tenant_id'] = $user['id'];
				$conditions['MaintenanceTicket.property_id'] = $curProp_id;
                        }
			else
                        {
				$conditions['MaintenanceTicket.property_id'] = $curProp_id;
                        }
                        $conditions['status'] = $status;
			return $this->find('count', array('conditions' => $conditions,'contain' => false));
		}
	};

?>
