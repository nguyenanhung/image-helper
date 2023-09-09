<?php
/**
 * Project image-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/02/2023
 * Time: 23:19
 */

namespace nguyenanhung\Libraries\ImageHelper;

use Exception;

/**
 * Class ImageHelper
 *
 * @package   nguyenanhung\Libraries\ImageHelper
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class ImageHelper
{
    const VERSION = '2.0.2';

    /**
     * Function getVersion
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 36:14
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Function googleGadgetsProxy
     *
     * @param string $url
     * @param string|int $width
     * @param string|int|null $height
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/20/2021 11:20
     */
    public static function googleGadgetsProxy(string $url = '', $width = 100, $height = null): string
    {
        if (strpos($url, 'media.anhp.vn')) {
            return trim($url);
        }
        $proxyUrl = 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy';
        $proxyContainer = 'focus';
        $proxyRefresh = 2592000;
        // Start
        $params = array();
        $params['url'] = $url;
        $params['resize_w'] = $width;
        if ($height !== null) {
            $params['resize_h'] = $height;
        }
        $params['container'] = $proxyContainer;
        $params['refresh'] = $proxyRefresh;
        // Result URL
        $url = $proxyUrl . '?' . urldecode(http_build_query($params));

        return trim($url);
    }

    /**
     * Function googleGadgetsProxyDnsPrefetch
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 34:32
     */
    public static function googleGadgetsProxyDnsPrefetch(): string
    {
        return "<link href='//images1-focus-opensocial.googleusercontent.com' rel='dns-prefetch' />" . PHP_EOL;
    }

    /**
     * Function wordpressProxy
     *
     * @param string $imageUrl
     * @param string $server
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/20/2021 11:39
     */
    public static function wordpressProxy(string $imageUrl = '', string $server = 'i3'): string
    {
        if (strpos($imageUrl, 'media.anhp.vn')) {
            return trim($imageUrl);
        }
        $imageUrl = str_replace(array('https://', 'http://', '//'), '', $imageUrl);
        $url = 'https://' . trim($server) . '.wp.com/' . $imageUrl;

        return trim($url);
    }

    /**
     * Function wordpressProxyDnsPrefetch
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 33:45
     */
    public static function wordpressProxyDnsPrefetch(): string
    {
        $html = "<link href='//i0.wp.com' rel='dns-prefetch' />" . PHP_EOL;
        $html .= "<link href='//i1.wp.com' rel='dns-prefetch' />" . PHP_EOL;
        $html .= "<link href='//i2.wp.com' rel='dns-prefetch' />" . PHP_EOL;
        $html .= "<link href='//i3.wp.com' rel='dns-prefetch' />" . PHP_EOL;

        return $html;
    }

    /**
     * Function createThumbnail
     *
     * @param string $url
     * @param int $width
     * @param int $height
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 00:20
     */
    public static function createThumbnail(string $url = '', int $width = 100, int $height = 100)
    {
        try {
            if (function_exists('base_url') && function_exists('config_item') && class_exists('nguyenanhung\MyImage\ImageCache')) {
                $tmpPath = config_item('image_tmp_path');
                $storagePath = config_item('base_storage_path');
                $cache = new \nguyenanhung\MyImage\ImageCache();
                $cache->setTmpPath($tmpPath);
                $cache->setUrlPath(base_url($storagePath));
                $cache->setDefaultImage();
                $thumbnail = $cache->thumbnail($url, $width, $height);
                if (!empty($thumbnail)) {
                    return $thumbnail;
                }

                return $cache->thumbnail(config_item('image_path_tmp_default'), $width, $height);
            }

            return $url;
        } catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', "Error Code: " . $e->getCode() . " - File: " . $e->getFile() . " - Line: " . $e->getLine() . " - Message: " . $e->getMessage());
            }

            return $url;
        }
    }
}
