<?php
App::uses('CakeEmail', 'Network/Email');
Configure::write('RentSquare.supportemail', 'support@rentsquare.co');

class PagesController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'display', 'about', 'contact', 'privacy', 'security', 'terms');

        if ( $this->Auth->user() )
            //if(strtolower($this->params['action']) == 'index')
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        if ( $this->Session->check('mobile_user') )
        {
            if ( intval($this->Session->read('mobile_user')) )
            {
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            }
        }
    }

    function index()
    {

    }

    function about()
    {
    }

    function contact()
    {
        if ( !empty($this->request->data) )
        {
            $this->__SendContactUsEmail($this->request->data);
            $this->set('emailsent', true);
        }

    }

    function privacy()
    {
    }

    function security()
    {
    }

    function terms()
    {
    }

    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if ( !$count )
        {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if ( !empty($path[0]) )
        {
            $page = $path[0];
        }
        if ( !empty($path[1]) )
        {
            $subpage = $path[1];
        }
        if ( !empty($path[ $count - 1 ]) )
        {
            $title_for_layout = Inflector::humanize($path[ $count - 1 ]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }

    private function __SendContactUsEmail($data)
    {
        $from = Configure::read('RentSquare.supportemail');

        try
        {
            $email = new CakeEmail();
            $email->domain('rentsquaredev.com');
            $email->sender('noreply@rentsquaredev.com', 'RentSquare Support');
            $email->template('contactus', 'generic')
                ->emailFormat('html')
                ->from(array($from => 'RentSquare Support'))
                ->to('sean.perlmutter@gmail.com')
                ->subject('RentSquare Inquiry')
                ->viewVars(array(
                    'data' => $data
                ))
                ->send();
        }
        catch ( Exception $e )
        {
            return false;
        }

        return true;

    }

}

;
