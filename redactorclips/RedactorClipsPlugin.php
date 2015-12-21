<?php
namespace Craft;

/**
 * Redactor Clips plugin
 */
class RedactorClipsPlugin extends BasePlugin
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Redactor Clips';
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '1.2';
	}

	/**
	 * @return string
	 */
	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	public function getDeveloper()
	{
		return 'Pixel & Tonic';
	}

	public function getDeveloperUrl()
	{
		return 'http://pixelandtonic.com';
	}

	/**
	 * @return string
	 */
	public function getPluginUrl()
	{
		return 'https://github.com/pixelandtonic/RedactorClips';
	}

	/**
	 * @return string
	 */
	public function getDocumentationUrl()
	{
		return $this->getPluginUrl().'/blob/master/README.md';
	}

	/**
	 * @return string
	 */
	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/pixelandtonic/RedactorClips/master/releases.json';
	}

	/**
	 * @return mixed
	 */
	public function getSettingsHtml()
	{
		return craft()->templates->renderMacro('_includes/forms', 'editableTableField', array(
			array(
				'label' => Craft::t('Clips'),
				'instructions' => Craft::t('Define the clips you want to be available in your Rich Text fields.'),
				'id'   => 'clips',
				'name' => 'clips',
				'cols' => array(
							'name' => array('heading' => Craft::t('Name'), 'type' => 'singleline', 'width' => '25%'),
							'html' => array('heading' => Craft::t('HTML'), 'type' => 'multiline', 'class' => 'code')
						),
				'rows' => $this->getSettings()->clips
			)
		));
	}

	/**
	 * Preps the settings before they're saved to the database.
	 *
	 * @param array $settings
	 * @return array
	 */
	public function prepSettings($settings)
	{
		if (!empty($settings['clips']))
		{
			// Drop the string row keys
			$settings['clips'] = array_values($settings['clips']);
		}

		return $settings;
	}

	/**
	 *
	 */
	public function init()
	{
		if (!craft()->isConsole())
		{
			if (craft()->request->isCpRequest())
			{
				craft()->templates->includeCssResource('redactorclips/clips.css');
				craft()->templates->includeJsResource('redactorclips/clips.js');

				$clips = array();

				foreach ($this->getSettings()->clips as $clip)
				{
					$clips[] = array($clip['name'], $clip['html']);
				}

				$js = 'RedactorPlugins.clips.items = '.JsonHelper::encode($clips).';';
				craft()->templates->includeJs($js);
			}
		}
	}

	/**
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'clips' => array(AttributeType::Mixed, 'default' => array())
		);
	}
}
