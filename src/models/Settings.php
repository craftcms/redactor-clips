<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\redactorclips\models;

use Craft;
use craft\base\Model;
use craft\config\DbConfig;
use craft\helpers\StringHelper;

/**
 * Redactor Clips plugin.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
 */
class Settings extends Model
{
    /**
     * @var array|null
     */
    public $clips = [];

    // Public Methods
    // =============================================================================

    /**
     * @inheritdoc
     */
    public function setAttributes($settings, $safeOnly = true)
    {
        // Special processing for MySQL
        if (Craft::$app->getDb()->getDriverName() === DbConfig::DRIVER_MYSQL) {
            $this->_processEmoji($settings, 'name');
            $this->_processEmoji($settings, 'html');
        }

        parent::setAttributes($settings, $safeOnly);
    }

    // Private Methods
    // =============================================================================

    /**
     * If any 4-byte characters were saved as part of the settings, we have to encode them
     * for MySQL because MySQL's utf8 implementation only deals with 3-bytes.
     *
     * @param $settings
     * @param $attribute
     *
     * @return void
     */
    private function _processEmoji(array &$settings, string $attribute)
    {
        foreach ($settings as $clips => $clip) {
            foreach ($clip as $key => $value) {
                // Does this look like an encoded character already? If so, let's decode it.
                if (preg_match('/^&#x/', $settings[$clips][$key][$attribute])) {
                    $settings[$clips][$key][$attribute] = html_entity_decode($settings[$clips][$key][$attribute]);
                } else {
                    // If not, let's encode it so MySQL won't choke.
                    $settings[$clips][$key][$attribute] = StringHelper::encodeMb4($value[$attribute]);
                }
            }
        }
    }
}
