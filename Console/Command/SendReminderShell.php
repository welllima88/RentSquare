<?php
App::uses('CakeEmail', 'Network/Email');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

class SendReminderShell extends AppShell {

    public $uses = array('SignupReminder');

    public function main(){
        $emails = $this->SignupReminder->find('all', array('conditions' => array('status' => null)));
        foreach($emails as $email){
          if($email['SignupReminder']['email'] != "")
            if($this->__sendReminderMail($email['SignupReminder']['email'])){
                $this->SignupReminder->id = $email['SignupReminder']['id'];
                $this->SignupReminder->saveField('status', 'sent');
            }
          else{
            $this->SignupReminder->saveField('status', 'sent');
          }
        }
      }
      private function __sendReminderMail($email_address)
    	{
    		
    			$from = Configure::read('RentSquare.supportemail');
    
    			$email = new CakeEmail();
    			$email->domain('rentsquaredev.com');
    			$email->sender('noreply@rentsquaredev.com','RentSquare Support');
    			$email->template('reminder', 'generic')
    				->emailFormat('html')
    				->from(array($from => 'RentSquare Support'))
    				->to($email_address)
    				->subject('RentSquare Signup Reminder')
    				->send();
    
    			return true;
    	}	
    	
  
}
