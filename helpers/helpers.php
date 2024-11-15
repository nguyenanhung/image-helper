<?php

if (!function_exists('google_image_resize')) {
    /**
     * Function google_image_resize
     *
     * @param string $url
     * @param int|null $width
     * @param int|null $height
     * @param string|null $server
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/27/2021 37:48
     */
    function google_image_resize($url = '', $width = 100, $height = null, $server = 'images1'): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::googleGadgetsProxy($url, $width, $height, $server);
    }
}
if (!function_exists('google_image_proxy_dns_prefetch')) {
    /**
     * Function google_image_proxy_dns_prefetch
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 36:03
     */
    function google_image_proxy_dns_prefetch(): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::googleGadgetsProxyDnsPrefetch();
    }
}
if (!function_exists('wordpress_proxy')) {
    /**
     * Function wordpress_proxy
     *
     * @param string $imageUrl
     * @param string $server
     * @param int|string|null $width
     * @param int|string|null $height
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/27/2021 38:04
     */
    function wordpress_proxy($imageUrl = '', $server = 'i3', $width = null, $height = null): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::wordpressProxy($imageUrl, $server, $width, $height);
    }
}
if (!function_exists('wordpress_proxy_dns_prefetch')) {
    /**
     * Function wordpress_proxy_dns_prefetch
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 36:15
     */
    function wordpress_proxy_dns_prefetch(): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::wordpressProxyDnsPrefetch();
    }
}
if (!function_exists('cloudflare_image_proxy')) {
    /**
     * Function cloudflare_image_proxy
     *
     * @param $imageUrl
     * @param $width
     * @param $height
     * @param $quality
     * User: 713uk13m <dev@nguyenanhung.com>
     * Copyright: 713uk13m <dev@nguyenanhung.com>
     * @return string
     */
    function cloudflare_image_proxy($imageUrl = '', $width = null, $height = null, $quality = null)
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::cloudFlareImageTransform(
            $imageUrl,
            $width,
            $height,
            $quality
        );
    }
}
if (!function_exists('bear_framework_image_url')) {
    /**
     * Function bear_framework_image_url
     *
     * @param string $input
     * @param        $server
     * @param        $base
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 54:18
     */
    function bear_framework_image_url($input = '', $server = '', $base = 'live'): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::formatImageUrl($input, $server, $base);
    }
}
if (!function_exists('bear_framework_create_image_thumbnail')) {
    /**
     * Function bear_framework_create_image_thumbnail
     *
     * @param string $url
     * @param int $width
     * @param int $height
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 03:06
     */
    function bear_framework_create_image_thumbnail($url = '', $width = 100, $height = 100)
    {
        return create_image_thumbnail($url, $width, $height);
    }
}
if (!function_exists('create_image_thumbnail')) {
    /**
     * Function create_image_thumbnail
     *
     * @param string $url
     * @param int $width
     * @param int $height
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 03:06
     */
    function create_image_thumbnail($url = '', $width = 100, $height = 100)
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::createThumbnail($url, $width, $height);
    }
}
if (!function_exists('bear_framework_crawler_reformat_url_link_need_change_http_to_https')) {
    function bear_framework_crawler_reformat_url_link_need_change_http_to_https($url): string
    {
        return smart_bear_cms_cdn_url_http_to_https($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_url_link_need_change_domain')) {
    function bear_framework_crawler_reformat_url_link_need_change_domain($url): string
    {
        return smart_bear_cms_cdn_url_change_domain($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_image_src_url_query_removed')) {
    function bear_framework_crawler_reformat_image_src_url_query_removed($url = ''): string
    {
        return smart_bear_cms_cdn_url_query_removed($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_external_cdn_optimize')) {
    function bear_framework_crawler_reformat_external_cdn_optimize($url = '', $width = 345, $height = 200): string
    {
        return smart_bear_cms_external_cdn_url_optimize($url, $width, $height);
    }
}
