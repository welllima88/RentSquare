<?php

class SeoController extends AppController {

    var $uses = array();
    var $components = array('RequestHandler');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('robots');
    }

    function robots()
    {
        //$urls = array();  

        // ...snip...  
        // fill the $urls array with those you don't  
        // want to be indexed/crawled  
        // for example  
        //$urls[] = '/articles/view/some-article/commentpaging';  

        //$this->set(compact('urls'));  
        $this->RequestHandler->respondAs('text');
        $this->viewPath .= '/text';
        $this->layout = 'ajax';
    }
}  