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
    function google_image_resize(string $url = '', $width = 100, $height = null, string $server = 'images1'): string
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
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/27/2021 38:04
     */
    function wordpress_proxy(string $imageUrl = '', string $server = 'i3'): string
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
    function wordpress_proxy_dns_prefetch(): string
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::wordpressProxyDnsPrefetch();
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
    function bear_framework_image_url(string $input = '', $server = '', $base = 'live'): string
    {
        $images_url = trim($input);
        if (function_exists('config_item') && !empty($images_url)) {
            $no_thumb = [
                'images/system/no_avatar.jpg',
                'images/system/no_avatar_100x100.jpg',
                'images/system/no_video_available.jpg',
                'images/system/no_video_available_thumb.jpg',
                'images/system/no-image-available.jpg',
                'images/system/no-image-available_60.jpg',
                'images/system/no-image-available_330.jpg'
            ];
            if (in_array($images_url, $no_thumb)) {
                return assets_url($images_url);
            }

            $parse_input = parse_url($images_url);
            if (isset($parse_input['host'])) {
                return $images_url;
            }
            if (trim(mb_substr($images_url, 0, 12)) === 'crawler-news') {
                $images_url = trim('uploads/' . $images_url);
            }
            $images_url = str_replace(array('upload-vcms/news/news/', 'upload-vcms/mheath/mheath/'), array('upload-vcms/news/', 'upload-vcms/mheath/'), $images_url);

            return config_item('static_url') . $images_url;
        }

        return $images_url;
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
    function bear_framework_create_image_thumbnail(string $url = '', int $width = 100, int $height = 100)
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
    function create_image_thumbnail(string $url = '', int $width = 100, int $height = 100)
    {
        return nguyenanhung\Libraries\ImageHelper\ImageHelper::createThumbnail($url, $width, $height);
    }
}
