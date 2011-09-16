<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initTwilio()
	{
		$config = $this->getOption('twilio');
		$twilio = new Services_Twilio($config['sid'], $config['token']);
		return $twilio;
	}
}

