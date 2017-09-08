<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\redactorclips;

use craft\redactorclips\models\Settings;
use craft\helpers\Json;
use Craft;

/**
 * Redactor Clips plugin.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public $hasCpSettings = true;

    // Public Methods
    // =============================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!Craft::$app->getRequest()->getIsConsoleRequest()) {
            if (Craft::$app->getRequest()->isCpRequest) {
                Craft::$app->getView()->registerAssetBundle(Asset::class);
                Craft::$app->getView()->registerCss(Asset::class);

                $clips = [];
                foreach ($this->getSettings()->clips as $clip) {
                    $clips[] = [$clip['name'], $clip['html']];
                }

                $js = 'RedactorPlugins.clips.items = '.Json::encode($clips).';';
                Craft::$app->getView()->registerJs($js);
            }
        }
    }

    // Protected Methods
    // =============================================================================

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->getView()->renderTemplateMacro('_includes/forms', 'editableTableField', [
            [
                'label' => Craft::t('redactor-clips', 'Clips'),
                'instructions' => Craft::t('redactor-clips', 'Define the clips you want to be available in your Rich Text fields.'),
                'id' => 'clips',
                'name' => 'clips',
                'cols' => [
                    'name' => ['heading' => Craft::t('redactor-clips', 'Name'), 'type' => 'singleline', 'width' => '25%'],
                    'html' => ['heading' => Craft::t('redactor-clips', 'HTML'), 'type' => 'multiline', 'class' => 'code']
                ],
                'rows' => $this->getSettings()->clips
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }
}
