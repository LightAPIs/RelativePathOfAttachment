<?php

use Typecho\Plugin;
use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Relative Path Of Attachment
 *
 * @package RelativePathOfAttachment
 * @author Light
 * @version 1.0.0
 * @link https://github.com/LightAPIs
 */
class RelativePathOfAttachment_Plugin implements PluginInterface {
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate() {
        Plugin::factory('admin/write-post.php')->bottom = __CLASS__ . '::render';
        Plugin::factory('admin/write-page.php')->bottom = __CLASS__ . '::render';
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate() {
        // do nothing
    }

    /**
     * 获取插件配置面板
     *
     * @param Form $form 配置面板
     */
    public static function config(Form $form)
    {
        // do nothing
    }

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form)
    {
        // do nothing
    }

    /**
     * 实现方法
     *
     * @return void
     */
    public static function render($post) {
        echo <<<EOD
<script type="text/javascript">
$(document).ready(function() {
    if (window.Typecho && window.Typecho.uploadComplete && window.Typecho.insertFileToEditor) {
        window.Typecho.uploadComplete = function(file) {
            let url = file.url;
            const localOrigin = location.origin;
            if (url.indexOf(localOrigin) === 0) {
                url = url.replace(localOrigin, '');
            }
            window.Typecho.insertFileToEditor(file.title, url, file.isImage);
        }
    }
});
</script>
EOD;
    }
}
