<?php

namespace core\Main;

class Email
{
	
	private $Header = NULL,
			$Message = NULL,
			$Subject = NULL,
			$To = Null;

	function __construct($settings = array())
	{
		if (isset($settings['sender'])) {
			$this->setHeaders($settings['sender']);
		}
		if (isset($settings['accepter'])) {
			$this->setTo($settings['accepter']);
		}
		if (isset($settings['header'])) {
			$this->setSubject($settings['header']);
		}
		if (isset($settings['message'])) {
			$this->setMessage($settings['message']);
		}
	}

	public function setHeaders($from)
	{
		$h = 'MIME-Version: 1.0'."\r\n";
		$h.= 'Content-type: text/html; charset=utf-8'."\r\n";
		$h.= 'From: '.$from."\r\n";
		$h .= 'Reply-To: '.$from."\r\n";
		$h .= 'X-Mailer: PHP/'.phpversion();
		$this->Header = $h;
		return $this;
	}

	public function setTo($accepter)
	{
		$this->To = $accepter;
		return $this;
	}

	public function setSubject($subject)
	{
		$this->Subject = $subject;
		return $this;
	}

	public function setMessage($message)
	{
		$this->Message = $message;
		return $this;
	}

	public function send()
	{
		return mail($this->To, $this->Subject, $this->Message, $this->Header);
	}
}
?>