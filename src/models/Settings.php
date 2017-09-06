<?php

namespace craft\redactorclips\models;

use Craft;
use craft\base\Model;
use craft\config\DbConfig;
use craft\helpers\StringHelper;

class Settings extends Model
{
    /**
     * @var array|null
     */

    public $clips = [];

    // Private Methods
    // =============================================================================

    /**
     * @param $settings
     * @param $attribute
     *
     * @return void
     */
    private function _processEmoji(array &$settings, string $attribute)
    {
        if (Craft::$app->getDb()->getDriverName() === DbConfig::DRIVER_MYSQL) {
            foreach ($settings as $clips => $clip) {
                foreach ($clip as $key => $value) {
                    if (!preg_match('/^&#x/', $settings[$clips][$key][$attribute])) {
                        $settings[$clips][$key][$attribute] = StringHelper::encodeMb4($value[$attribute]);
                    } else {
                        $settings[$clips][$key][$attribute] = html_entity_decode($settings[$clips][$key][$attribute]);
                    }
                }
            }
        }
    }

    // Public Methods
    // =============================================================================

    /**
     * @inheritdoc
     */
    public function setAttributes($settings, $safeOnly = true)
    {
        $this->_processEmoji($settings, 'name');
        $this->_processEmoji($settings, 'html');

        parent::setAttributes($settings, $safeOnly);
    }
}
