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
    const VERSION = '1.0.15';

    /**
     * Function getVersion
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 36:14
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function googleGadgetsProxyServer
     *
     * User: 713uk13m <dev@nguyenanhung.com>
     * Copyright: 713uk13m <dev@nguyenanhung.com>
     *
     * @return string[]|array
     */
    public static function googleGadgetsProxyServerList()
    {
        return array('images1', 'images2', 'images3', 'images4', 'images5', 'images6', 'images7', 'images8', 'images9', 'images10');
    }

    /**
     * Function wordpressProxyProxyServerList
     *
     * User: 713uk13m <dev@nguyenanhung.com>
     * Copyright: 713uk13m <dev@nguyenanhung.com>
     *
     * @return string[]|array
     */
    public static function wordpressProxyProxyServerList()
    {
        return array('i0', 'i1', 'i2', 'i3');
    }

    /**
     * Function imageProxyBlacklistServer
     *
     * @return string[]|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/09/2023 18:23
     */
    public static function imageProxyBlacklistServer()
    {
        if (defined('PROXY_IMAGE_BLACKLIST_SERVER')) {
            return PROXY_IMAGE_BLACKLIST_SERVER;
        }
        return null;
    }

    public static function imageProxyWhitelistServer()
    {
        if (defined('PROXY_IMAGE_WHITELIST_SERVER')) {
            return PROXY_IMAGE_WHITELIST_SERVER;
        }
        return null;
    }

    /**
     * Function googleGadgetsProxy
     *
     * @param string $url
     * @param int|null $width
     * @param int|null $height
     * @param string|null $server
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/20/2021 11:20
     */
    public static function googleGadgetsProxy($url = '', $width = 100, $height = null, $server = 'images1')
    {
        $parse = parse_url($url);
        $host = isset($parse['host']) ? $parse['host'] : '';
        if (empty($host)) {
            return trim($url);
        }

        // Blacklist Proxy
        $blacklistServer = self::imageProxyBlacklistServer();
        if (!empty($blacklistServer)) {
            if (is_array($blacklistServer)) {
                if (in_array($host, $blacklistServer, true)) {
                    return trim($url);
                }
            } elseif ($host === $blacklistServer) {
                return trim($url);
            }
        }
        // Next

        $server = trim($server);
        if (in_array($server, self::googleGadgetsProxyServerList())) {
            $proxyUrl = 'https://' . trim($server) . '-focus-opensocial.googleusercontent.com/gadgets/proxy';
        } else {
            $proxyUrl = 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy';
        }
        $proxyContainer = 'focus';
        $proxyRefresh = 2592000;
        // Start
        $params = array();
        $params['url'] = $url;
        if ($width !== null) {
            $params['resize_w'] = $width;
        }
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
     * @param $server
     * User: 713uk13m <dev@nguyenanhung.com>
     * Copyright: 713uk13m <dev@nguyenanhung.com>
     *
     * @return string
     */
    public static function googleGadgetsProxyDnsPrefetch($server = 'images1')
    {
        $html = '';
        if ($server === 'full') {
            foreach (self::googleGadgetsProxyServerList() as $proxy) {
                $html .= "<link href='//" . trim($proxy) . "-focus-opensocial.googleusercontent.com' rel='dns-prefetch' />" . PHP_EOL;
            }
        } else {
            $html .= "<link href='//images1-focus-opensocial.googleusercontent.com' rel='dns-prefetch' />" . PHP_EOL;
        }
        return $html;
    }

    /**
     * Function wordpressProxy
     *
     * @param string $imageUrl
     * @param string $server
     * @param int|string|null $width
     * @param int|string|null $height
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/20/2021 11:39
     */
    public static function wordpressProxy($imageUrl = '', $server = 'i3', $width = null, $height = null)
    {
        $url = parse_url($imageUrl);
        $schema = isset($url['scheme']) ? $url['scheme'] : '';
        $host = isset($url['host']) ? $url['host'] : '';
        $port = isset($url['port']) ? $url['port'] : '';

        if (empty($host)) {
            return trim($imageUrl);
        }

        if ($schema === 'http' && (!empty($port) && $port != 80)) {
            /**
             * Default, WordPress Proxy not Support HTTP Protocol with port != 80 -> Auto Switch Google GadgetsProxy
             * @see https://jetpack.com/support/site-accelerator/
             */
            return self::googleGadgetsProxy($imageUrl, $width, $height);
        }

        $protocol = array($schema . '://', '//',);
        $imageUrl = str_replace($protocol, '', $imageUrl);
        $server = trim($server);
        if (in_array($server, self::wordpressProxyProxyServerList())) {
            $proxyUrl = 'https://' . trim($server) . '.wp.com/';
        } else {
            $proxyUrl = 'https://i3.wp.com/';
        }
        $url = $proxyUrl . $imageUrl;
        $url = trim($url);
        // Resize
        $width = (int)$width;
        $height = (int)$height;
        if ($width > 0 && $height > 0) {
            $resize = '?resize=' . $width . ',' . $height;
            return $url . $resize;
        }
        if ($width > 0) {
            $resize = '?w=' . $width;
            return $url . $resize;
        }
        if ($height > 0) {
            $resize = '?h=' . $height;
            return $url . $resize;
        }
        // return
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
    public static function wordpressProxyDnsPrefetch()
    {
        $html = '';
        foreach (self::wordpressProxyProxyServerList() as $server) {
            $html .= "<link href='//" . trim($server) . ".wp.com' rel='dns-prefetch' />" . PHP_EOL;
        }
        return $html;
    }

    /**
     * Function createThumbnail
     *
     * @param $url
     * @param $width
     * @param $height
     *
     * @return mixed|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 00:20
     */
    public static function createThumbnail($url = '', $width = 100, $height = 100)
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

    /**
     * Function createThumbnailWithCodeIgniterCache
     *
     * @param $url
     * @param $width
     * @param $height
     *
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/09/2023 01:35
     */
    public static function createThumbnailWithCodeIgniterCache($url = '', $width = 100, $height = 100)
    {
        try {
            if (function_exists('base_url') && function_exists('config_item')) {
                $cacheKey = md5('createThumbnailWithCodeIgniterCache' . $url . $width . $height);
                $cacheTtl = 15552000; // Cache 6 tháng
                // Setup CodeIgniter
                $CI =& get_instance();
                $CI->load->driver('cache', array('adapter' => 'file', 'backup' => 'dummy'));
                if (!$urlThumbnail = $CI->cache->get($cacheKey)) {
                    $tmpPath = config_item('image_tmp_path');
                    $storagePath = config_item('base_storage_path');
                    $imageCache = new \nguyenanhung\MyImage\ImageCache();
                    $imageCache->setTmpPath($tmpPath)->setUrlPath(base_url($storagePath))->setDefaultImage();
                    $thumbnail = $imageCache->thumbnail($url, $width, $height);
                    if (!empty($thumbnail)) {
                        $urlThumbnail = $thumbnail;
                    } else {
                        $thumbnailTmp = $imageCache->thumbnail(config_item('image_path_tmp_default'), $width, $height);
                        $urlThumbnail = $thumbnailTmp;
                    }
                    if ($urlThumbnail !== null) {
                        $CI->cache->save($cacheKey, $urlThumbnail, $cacheTtl);
                    }
                }
                if (!empty($urlThumbnail)) {
                    return $urlThumbnail;
                }
                return $url;
            }
            return $url;
        } catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', "Error Code: " . $e->getCode() . " - File: " . $e->getFile() . " - Line: " . $e->getLine() . " - Message: " . $e->getMessage());
            }
            return $url;
        }
    }

    /**
     * Function formatImageUrl
     *
     * @param $input
     * @param $server
     * @param $base
     *
     * @return array|mixed|string|string[]
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/09/2023 01:39
     */
    public static function formatImageUrl($input = '', $server = '', $base = 'live')
    {
        $images_url = trim($input);
        $images_url = bear_framework_crawler_reformat_url_link_need_change_http_to_https($images_url);
        $images_url = bear_framework_crawler_reformat_url_link_need_change_domain($images_url);
        try {
            if (function_exists('base_url') && function_exists('config_item') && !empty($images_url)) {
                $no_thumb = array(
                    'images/system/no_avatar.jpg',
                    'images/system/no_avatar_100x100.jpg',
                    'images/system/no_video_available.jpg',
                    'images/system/no_video_available_thumb.jpg',
                    'images/system/no-image-available.jpg',
                    'images/system/no-image-available_60.jpg',
                    'images/system/no-image-available_330.jpg'
                );
                if (in_array($images_url, $no_thumb)) {
                    return assets_url($images_url);
                }
                $parse = parse_url($images_url);
                if (isset($parse['host'])) {
                    return $images_url;
                }
                if (trim(mb_substr($images_url, 0, 12)) === 'crawler-news') {
                    $images_url = trim('uploads/' . $images_url);
                }
                $images_url = str_replace(array('upload-vcms/news/news/', 'upload-vcms/mheath/mheath/'), array('upload-vcms/news/', 'upload-vcms/mheath/'), $images_url);
                return config_item('static_url') . $images_url;
            }

            return $images_url;
        } catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', "Error Code: " . $e->getCode() . " - File: " . $e->getFile() . " - Line: " . $e->getLine() . " - Message: " . $e->getMessage());
            }
            return $input;
        }
    }
}
