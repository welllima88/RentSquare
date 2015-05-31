<?php
	class ExHtmlHelper extends HtmlHelper{
		public function link($title, $url = null, $options = array(), $confirmMessage = false){
			if(!is_array($url))
				$tmp = Router::parse($url);
			else
				$tmp = $url;

			if(!isset($this->request->params['action']))
				$this->request->params['action'] = 'index';
			if(!isset($tmp['action']))
				$tmp['action'] = 'index';
			
			if($tmp['controller'] == $this->request->params['controller']){
				if(!isset($options) || !is_array($options))
					$options = array();

				if(!isset($options['class']))
					$options['class'] = 'current-controller';
				else
					$options['class'] .= ' current-controller';

				if(($tmp['action'] == $this->request->params['action']) || ($this->request->params['controller'] == 'Pages' && $this->request->params['action'] == 'display' && $this->request->params['pass'][0] == $tmp['action'])){
					$options['class'] .= ' current-page';

					if(isset($tmp[0]) && isset($this->request->params['pass']) && isset($this->request->params['pass'][0]) && $tmp[0] == $this->request->params['pass'][0])
						$options['class'] .= ' current-item';

				}
			}

			return parent::link($title, $url, $options, $confirmMessage);
		}
	};
?>