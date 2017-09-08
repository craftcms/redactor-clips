<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\redactorclips;

use craft\web\AssetBundle;

/**
 * Redactor Clips plugin.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
 */
class Asset extends AssetBundle
{
    /**
     * @var string The JS filename (sans "[.min].js") to register
     */
    public $jsFile = 'clips';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = __DIR__.'/lib';

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            $this->jsFile.$this->dotJs(),
        ];

        $this->css = [
            'clips.min.css',
        ];

        parent::init();
    }
}
