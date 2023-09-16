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
    function google_image_resize($url = '', $width = 100, $height = null, $server = 'images1')
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
    function google_image_proxy_dns_prefetch()
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
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/27/2021 38:04
     */
    function wordpress_proxy($imageUrl = '', $server = 'i3')
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::wordpressProxy($imageUrl, $server);
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
    function wordpress_proxy_dns_prefetch()
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::wordpressProxyDnsPrefetch();
    }
}
if (!function_exists('bear_framework_image_url')) {
    /**
     * Function bear_framework_image_url
     *
     * @param $input
     * @param $server
     * @param $base
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 15/06/2022 54:18
     */
    function bear_framework_image_url($input = '', $server = '', $base = 'live')
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::formatImageUrl($input, $server, $base);
    }
}
if (!function_exists('bear_framework_create_image_thumbnail')) {
    /**
     * Function bear_framework_create_image_thumbnail
     *
     * @param $url
     * @param $width
     * @param $height
     *
     * @return mixed|string|null
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
     * @param $url
     * @param $width
     * @param $height
     *
     * @return mixed|string|null
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
    function bear_framework_crawler_reformat_url_link_need_change_http_to_https($url)
    {
        $url = str_replace('http://cdnphoto.dantri.com.vn', 'https://cdnphoto.dantri.com.vn', $url);
        $url = str_replace('http://cdn-i.vtcnews.vn', 'https://cdn-i.vtcnews.vn', $url);
        $url = str_replace('http://www.vothuat.vn', 'https://www.vothuat.vn', $url);
        $url = str_replace('http://haiphong.gov.vn', 'https://haiphong.gov.vn', $url);
        $url = str_replace('http://congan.haiphong.gov.vn', 'https://congan.haiphong.gov.vn', $url);
        $url = str_replace('http://www.baohaiphong.com.vn', 'https://baohaiphong.com.vn', $url);
        $url = str_replace('http://baohaiphong.com.vn', 'https://baohaiphong.com.vn', $url);
        $url = str_replace('http://123.27.254.48:9000', 'https://baohaiphong.com.vn', $url);
        $url = str_replace('http://static.cand.com.vn', 'https://static.cand.com.vn', $url);
        $url = str_replace('http://streaming1.danviet.vn', 'https://streaming1.danviet.vn', $url);
        $url = str_replace('http://media.kinhtedothi.vn', 'https://media.kinhtedothi.vn', $url);
        return trim($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_url_link_need_change_domain')) {
    function bear_framework_crawler_reformat_url_link_need_change_domain($url)
    {
        $url = str_replace('//image-us.eva.vn/', '//cdn.eva.vn/', $url);
        return trim($url);
    }
}
