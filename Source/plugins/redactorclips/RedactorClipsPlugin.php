<?php
namespace Craft;

/**
 * Redactor Clips plugin
 */
class RedactorClipsPlugin extends BasePlugin
{
	public function getName()
	{
		return 'Redactor Clips';
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'P&T';
	}

	public function getDeveloperUrl()
	{
		return 'http://pixelandtonic.com';
	}

	public function init()
	{
		if (craft()->request->isCpRequest())
		{
			craft()->templates->includeCssResource('redactorclips/clips.css');
			craft()->templates->includeJsResource('redactorclips/clips.js');
		}
	}
}
