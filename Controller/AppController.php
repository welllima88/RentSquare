<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

Configure::write('Security.salt2', 'R1ysi!84$093dw28vH0ehe82Lsvndeu2r#729(8378sbe'); //Also defined in Update Billing Shell


/**
 * This is a placeholder class.
 * Create the same file in app/Controller/AppController.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

    var $components = array(
        'Paginator', 'Session', 'RequestHandler', 'AutoLogin', 'Auth' => array(
            'loginRedirect'  => array('controller' => 'Users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'Pages', 'action' => 'index')
        )
    );
//		'logoutRedirect' => array('controller' => 'Pages', 'action' => 'index')),'DebugKit.Toolbar');
    var $helpers = array('Html', 'Form', 'Session', 'Js', 'ExHtml', 'Time', 'Time2', 'Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        //If user is on mobile device, show mobile page
        if ( $this->Session->check('nomobile') )
        {

            if ( !intval($this->Session->read('nomobile')) && !empty($_SERVER['HTTP_USER_AGENT']) )
            {
                if ( preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']) )
                {
                    $this->Session->write('mobile_user', '1');
                }
            }
        } else
        {
            if ( !empty($_SERVER['HTTP_USER_AGENT']) )
            {
                if ( preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']) )
                {
                    $this->Session->write('mobile_user', '1');
                }
            }
        }

        //If user is logged in and is not a public page, set layout to back
        if ( $this->Auth->user() && strtolower($this->params['controller']) != 'pages' )
        {
            $this->layout = 'back';
            $this->set('user_type', $this->Auth->user('type'));

            if ( $this->Auth->user('type') == USER_TYPE_MANAGER )
            {
                $this->loadModel('Property');

                $props = $this->Property->getManaged($this->Auth->user('id'));
                //If PM does not have any active properties

                if ( count($props) != 0 )
                {
                    $this->set('properties', $props);
                    //	If the user hasn't set a current property, default to the first one in the list
                    if ( !$this->Session->check('current_property') && count($props) > 0 )
                        $this->Session->write('current_property', $props[0]['Property']['id']);

                    $this->propId = $this->Session->read('current_property');

                    $prop_flag = false;
                    foreach ( $props as $prop )
                    {
                        if ( (string) $prop['Property']['id'] == (string) $this->propId )
                        {
                            $this->set('curProp', $prop['Property']);
                            $this->Session->write('current_property', $prop['Property']['id']);
                            $prop_flag = true;
                        }
                    }
                    if ( !$prop_flag )
                    {
                        $this->set('curProp', $props[0]['Property']);
                        $this->Session->write('current_property', $props[0]['Property']['id']);
                    }
                }
            } else if ( $this->Auth->user('type') == USER_TYPE_TENANT )
            {
                //$this->Session->write('current_property', $props[0]['Property']['id']);
                $this->loadModel('User');
                $this->User->contain();
                $user_details = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
                $this->propId = $user_details['User']['property_id'];
            }
        }
    }

    public function beforeRender()
    {
        parent::beforeRender();
        if ( $this->Auth->user() )
        {
            $this->set('user', $this->Auth->user());

            if ( isset($curProp['timezone']) ) $use_timezone = $curProp['timezone']; else $timezone = $this->Auth->user('timezone');
            $this->set('user_timezone', $timezone);

            //	Set the number of unread messages
            $this->loadModel('ConversationsUser');
            $this->set('unreadMsgs', $this->ConversationsUser->getUnreadCount($this->Auth->user('id')));

            // Set Maintenance Number
            $this->loadModel('MaintenanceTicket');
            $this->set('pendingMaint', $this->MaintenanceTicket->getUnreadMaintCount($this->Auth->user(), $this->propId, 'pending'));
            $this->set('openMaint', $this->MaintenanceTicket->getUnreadMaintCount($this->Auth->user(), $this->propId, 'open'));

            if ( $this->Auth->user('type') == USER_TYPE_MANAGER )
            {

            } else if ( $this->Auth->user('type') == USER_TYPE_TENANT )
            {
                $this->loadModel('User');
                $user = $this->User->get($this->Auth->user('id'));

                $this->loadModel('Property');
                $prop = $this->Property->get($user['User']['property_id']);


                $this->loadModel('Unit');
                $this->Unit->contain();
                $unit = $this->Unit->get($this->Auth->user('unit_id'), $this->Auth->user('id'));

                $this->set('curUnit', $unit['Unit']);
                if ( isset($prop['Property']) )
                {
                    $this->set('curProp', $prop['Property']);
                    $this->set('propManager', $prop['Property']['manager_id']);
                }

            }
        }

        // only compile it on development mode
        if ( Configure::read('debug') > 0 )
        {
            // import the file to application
            App::import('Vendor', 'lessc');

            // set the LESS file location
            $less = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less' . DS . 'main.less';
            $frontLess = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less' . DS . 'front.less';
            $backLess = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'less' . DS . 'back.less';

            // set the CSS file to be written
            $css = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css' . DS . 'main.css';
            $frontCss = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css' . DS . 'front.css';
            $backCss = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'css' . DS . 'back.css';

            // compile the file
            lessc::ccompile($less, $css);
            lessc::ccompile($frontLess, $frontCss);
            lessc::ccompile($backLess, $backCss);
        }
        parent::beforeRender();
    }


    protected function managerCheck()
    {
        if ( $this->Auth->user('type') != USER_TYPE_MANAGER )
        {
            $this->Session->setFlash('This function is only accessible by property managers');
            $this->redirect(array('controller' => 'Users'));
        }
    }

    protected function adminCheck()
    {
        //USER_TYPE_ADMIN
        if ( $this->Auth->user('type') != USER_TYPE_ADMIN )
        {
            $this->Session->setFlash('This function is only accessible by an Admin');
            $this->redirect(array('controller' => 'Users'));
        }
    }

    protected function activePropertyCheck()
    {
        if ( !$this->Session->read('current_property') )
        {
            $this->Session->setFlash('You cannot perform that action because you are not actively managing a specific property.');
            $this->redirect(array('controller' => 'Users'));
        }
    }

    protected function refreshAuth($field = '', $value = '')
    {
        if ( !empty($field) && !empty($value) )
        {
            die();
            $this->Session->write($this->Auth->sessionKey . '.' . $field, $value);
        } else
        {
            if ( !isset($this->User) )
                $this->loadModel('User');

            $this->User->contain();
            $this->User->cacheQueries = false;
            $usr = $this->User->get($this->Auth->user('id'));
            $this->Auth->login($usr['User']);
        }
    }

    protected function __email_developer($array)
    {
        $from = 'support@rentsquare.co';

        $email = new CakeEmail();
        $email->template('error', 'generic')
            ->emailFormat('html')
            ->from(array($from => 'RentSquare Support'))
            ->to('nick@yolodesign.com')
            ->subject('RentSquare Error')
            ->viewVars(array(
                'errors' => $array,
            ))
            ->send();

        return true;
    }

    public function uploadphoto($image_file)
    {

        $image_file['name'] = str_replace(' ', '_', $image_file['name']);

        $results = array();

        if ( $image_file['tmp_name'] == '' )
        {
            $results['error'] = 'Please upload a photo';
        } else
        {

            $img_details = getimagesize($image_file['tmp_name']);

            if ( $this->isUploadedFile($image_file, $img_details) ):

                if ( $image_file['size'] < 32000000 ):

                    $uploadDir = WWW_ROOT . 'files';
                    $target_path = $uploadDir . DS . $image_file['name'];

                    $temp_path = substr($target_path, 0, strlen($target_path) - strlen($this->_ext($image_file['name']))); //temp path without the ext
                    $i = 1;
                    //make sure the file doesn't already exist, if it does, add an itteration to it
                    while ( file_exists($target_path) )
                    {
                        $target_path = $temp_path . "-" . $i . $this->_ext($image_file['name']);
                        $i ++;
                    }
                    $results['image_path'] = $image_file['name'];

                    if ( !move_uploaded_file($image_file['tmp_name'], $target_path) ):
                        $results['error'] = 'The image could not be uploaded. Only .jpg, .png, .gif, and .jpeg are allowed. Please, try again.';
                    endif;//move_upload_file
                else:
                    $results['error'] = 'The image is too big. Max size allowed is 32MB. Please, try again.';
                endif; //if upload size
            else:
                $results['error'] = 'Sorry, the image could not be uploaded. Only .jpg, .png, .gif, and .jpeg are allowed. Please, try again.';
            endif;
        }

        return $results;

    }

    public function isUploadedFile($params, $img_details)
    {

        if ( $img_details && ($img_details['mime'] == 'image/jpeg' || $img_details['mime'] == 'image/png' || $img_details['mime'] == 'image/gif' || $img_details['mime'] == 'image/x-png') )
        {
            if ( (isset($params['error']) && $params['error'] == 0) ||
                (!empty($params['tmp_name']) && $params['tmp_name'] != 'none')
            )
            {
                return is_uploaded_file($params['tmp_name']);
            }
        }

        return false;
    }

    /***************************************************
     * Returns the extension of the uploaded filename.
     *
     * @return string $extension A filename extension
     * @access protected
     */
    function _ext($filename = null)
    {
        return strrchr($filename, ".");
    }

    /***********************
     * Format Phone Number
     *
     */
    function format_phone($phone_number)
    {
        $result = "";
        if ( preg_match('/^(\d{3})(\d{3})(\d{4})$/', $phone_number, $matches) )
        {
            $result = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
        }

        return (($result != "")) ? $result : $phone_number;
    }
}

;
