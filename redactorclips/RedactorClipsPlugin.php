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
		if (!craft()->isConsole())
		{
			if (craft()->request->isCpRequest())
			{
				craft()->templates->includeCssResource('redactorclips/clips.css');
				craft()->templates->includeJsResource('redactorclips/clips.js');

				$modalHtml = craft()->templates->render('redactorclips/modal', array(
					'clips' => $this->getSettings()->clips
				));

				craft()->templates->includeFootHtml($modalHtml);
			}
		}
	}

	protected function defineSettings()
	{
		return array(
			'clips' => array(AttributeType::Mixed, 'default' => array())
		);
	}

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
}
