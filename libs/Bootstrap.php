<?php

class Bootstrap
{

	private $_url = null;
	private $_controller = null;
	private $_controllerPath = 'controllers/';
	private $_defaultFile = 'index.php';

	/**
	 * Starts the Bootstrap
	 * 
	 * @return boolean
	 */
	public function init()
	{
		$this->_getUrl();
		if (empty($this->_url[0])) {
			$this->_showDefaultController();
			return false;
		}
		$this->_showController();
		$this->_controller->index();
	}


	/**
	 * Fetches the $_GET params from 'url'
	 */
	private function _getUrl()
	{
		$this->_url = isset($_GET['url']) ? $_GET['url'] : null;
		$this->_url = str_replace('-', '', $this->_url);
		$this->_url = filter_var($this->_url, FILTER_SANITIZE_URL);
		$this->_url = rtrim($this->_url, '/');
		$this->_url = explode('/', $this->_url);
	}

	/**
	 * Load a controller if passed in url
	 * 
	 * @return boolean|string
	 */
	private function _showController()
	{
		$file = $this->_controllerPath . $this->_url[0] . '.php';
		if (file_exists($file)) {
			require $file;
			$this->_controller = new $this->_url[0];
		}
	}

	/**
	 * Show default controller if nothing passed
	 */
	private function _showDefaultController()
	{
		require $this->_controllerPath . $this->_defaultFile;
		$this->_controller = new Index();
		$this->_controller->index();
	}
}
