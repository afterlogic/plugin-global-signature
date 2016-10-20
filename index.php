<?php

class_exists('CApi') or die();

class CSignMessageOnSendPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('webmail.message-plain-part', 'WebmailMessagePlainPart');
		$this->AddHook('webmail.message-html-part', 'WebmailMessageHtmlPart');
	}

	/**
	 * @param CAccount $oAccount
	 * @param \MailSo\Mime\Message $oMessage
	 * @param string $sText
	 * @return void
	 */
	public function WebmailMessagePlainPart($oAccount, &$oMessage, &$sText)
	{
		if (0 < \strlen($sText))
		{
			$sText = $sText."\n\n---\nSignature Plain";
		}
	}
	/**
	 * @param CAccount $oAccount
	 * @param \MailSo\Mime\Message $oMessage
	 * @param string $sHtml
	 * @return void
	 */
	public function WebmailMessageHtmlPart($oAccount, &$oMessage, &$sHtml)
	{
		if (0 < \strlen($sHtml))
		{
			$sHtml = $sHtml.'<br /><br />Signature Html';
		}
	}
}

return new CSignMessageOnSendPlugin($this);
