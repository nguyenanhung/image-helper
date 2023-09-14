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
    const VERSION = '1.0.6';

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
     * @return string[]|array
     */
    public static function wordpressProxyProxyServerList()
    {
        return array('i0', 'i1', 'i2', 'i3');
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
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/20/2021 11:39
     */
    public static function wordpressProxy($imageUrl = '', $server = 'i3')
    {
        $url = parse_url($imageUrl);
        $schema = isset($url['scheme']) ? $url['scheme'] : '';
        $host = isset($url['host']) ? $url['host'] : '';
        if (empty($host)) {
            return trim($imageUrl);
        }
        if ($schema === 'http') {
            // Default, WordPress Proxy not Support HTTP Protocol -> Auto Switch Google GadgetsProxy
            return self::googleGadgetsProxy($imageUrl, null);
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
}
