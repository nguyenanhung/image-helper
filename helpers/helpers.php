<?php
if (!function_exists('google_image_resize')) {
    /**
     * Function google_image_resize
     *
     * @param string      $url
     * @param int|null    $width
     * @param int|null    $height
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
        $url = str_replace(
            array(
                'http://cdnphoto.dantri.com.vn',
                'http://img.fica.vn',
                'http://cdn-i.vtcnews.vn',
                'http://www.vothuat.vn',
                'http://haiphong.gov.vn',
                'http://congan.haiphong.gov.vn',
                'http://www.baohaiphong.com.vn',
                'http://baohaiphong.com.vn',
                'http://123.27.254.48:9000',
                'http://static.cand.com.vn',
                'http://streaming1.danviet.vn',
                'http://media.kinhtedothi.vn',
            ),
            array(
                'https://cdnphoto.dantri.com.vn',
                'https://img.fica.vn',
                'https://cdn-i.vtcnews.vn',
                'https://www.vothuat.vn',
                'https://haiphong.gov.vn',
                'https://congan.haiphong.gov.vn',
                'https://baohaiphong.com.vn',
                'https://baohaiphong.com.vn',
                'https://baohaiphong.com.vn',
                'https://static.cand.com.vn',
                'https://streaming1.danviet.vn',
                'https://media.kinhtedothi.vn',
            ),
            $url);
        return trim($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_url_link_need_change_domain')) {
    function bear_framework_crawler_reformat_url_link_need_change_domain($url)
    {
        $url = str_replace(
            array('//image-us.eva.vn/', '//vov-media.emitech.vn/'),
            array('//cdn.eva.vn/', '//media.vov.vn/'),
            $url
        );
        return trim($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_image_src_url_query_removed')) {
    function bear_framework_crawler_reformat_image_src_url_query_removed($url = '')
    {
        $url = trim($url);
        if (empty($url)) {
            return $url;
        }
        $parse = parse_url($url);
        if (!isset($parse['query'])) {
            return $url;
        }
        $queryRemoved = '?' . $parse['query'];
        $url = str_replace($queryRemoved, '', $url);
        return trim($url);
    }
}
if (!function_exists('bear_framework_crawler_reformat_external_cdn_optimize')) {
    function bear_framework_crawler_reformat_external_cdn_optimize($url = '', $width = 345, $height = 200)
    {
        $url = trim($url);
        if (empty($url)) {
            return $url;
        }
        // Xử lý cho vietnamnet, 2sao, vietnambiz, tintuconline
        $arrayList = [
            'cdn.vietnambiz.vn',
            'ttol.vietnamnetjsc.vn',
            'static-images.vnncdn.net',
        ];
        $parseUrl = parse_url($url);
        if (isset($parseUrl['host']) && in_array($parseUrl['host'], $arrayList)) {
            $url = bear_framework_crawler_reformat_image_src_url_query_removed($url);
            $url .= '?width=' . trim($width);
            return trim($url);
        }
        // EPI CMS
        $url = str_replace('https://vov-media.emitech.vn/sites/default/files/styles/og_image/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://vov-media.emitech.vn/sites/default/files/styles/front_medium/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://vov-media.emitech.vn/sites/default/files/styles/front_large/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://vov-media.emitech.vn/sites/default/files/styles/front_small/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://media.vov.vn/sites/default/files/styles/og_image/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://media.vov.vn/sites/default/files/styles/front_large/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);
        $url = str_replace('https://media.vov.vn/sites/default/files/styles/front_small/', 'https://media.vov.vn/sites/default/files/styles/front_medium/', $url);

        $url = str_replace('https://static.kinhtedothi.vn/600x315/images', 'https://static.kinhtedothi.vn/640x360/images', $url);
        $url = str_replace('https://static.kinhtedothi.vn/images', 'https://static.kinhtedothi.vn/640x360/images', $url);
        $url = str_replace('https://image.tienphong.vn/1200x630/Uploaded', 'https://image.tienphong.vn/600x315/Uploaded', $url);
        $url = str_replace('https://image.tienphong.vn/Uploaded', 'https://image.tienphong.vn/600x315/Uploaded', $url);
        $url = str_replace('https://image.ngaynay.vn/1200x630/Uploaded', 'https://image.ngaynay.vn/600x315/Uploaded', $url);
        $url = str_replace('https://image.ngaynay.vn/Uploaded', 'https://image.ngaynay.vn/600x315/Uploaded', $url);
        $url = str_replace('https://image.nhandan.vn/1200x630/Uploaded', 'https://image.nhandan.vn/600x315/Uploaded', $url);
        $url = str_replace('https://image.nhandan.vn/Uploaded', 'https://image.nhandan.vn/600x315/Uploaded', $url);
        // tuoitre
        $url = str_replace('https://cdn1.tuoitre.vn/20', 'https://cdn1.tuoitre.vn/zoom/600_315/20', $url);
        $url = str_replace('https://cdn.tuoitre.vn/zoom/600_315/', 'https://cdn.tuoitre.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://cdn.tuoitre.vn/47', 'https://cdn.tuoitre.vn/thumb_w/' . trim($width) . '/47', $url);
        $url = str_replace('https://cdn.tuoitre.vn/20', 'https://cdn.tuoitre.vn/thumb_w/' . trim($width) . '/20', $url);
        // VC CORP
        $url = str_replace('https://afamilycdn.com/15', 'https://afamilycdn.com/thumb_w/' . trim($width) . '/15', $url);
        $url = str_replace('https://cafebiz.cafebizcdn.vn/16', 'https://cafebiz.cafebizcdn.vn/thumb_w/' . trim($width) . '/16', $url);
        $url = str_replace('https://cafefcdn.com/2', 'https://cafefcdn.com/thumb_w/' . trim($width) . '/2', $url);
        $url = str_replace('https://danviet.mediacdn.vn/29', 'https://danviet.mediacdn.vn/thumb_w/' . trim($width) . '/29', $url);
        $url = str_replace('https://images2.thanhnien.vn/52', 'https://images2.thanhnien.vn/thumb_w/' . trim($width) . '/52', $url);
        $url = str_replace('https://kenh14cdn.com/20', 'https://kenh14cdn.com/thumb_w/' . trim($width) . '/20', $url);
        $url = str_replace('https://sohanews.sohacdn.com/16', 'https://sohanews.sohacdn.com/thumb_w/' . trim($width) . '/16', $url);
        $url = str_replace('https://vtv1.mediacdn.vn/56', 'https://vtv1.mediacdn.vn/thumb_w/' . trim($width) . '/56', $url);
        $url = str_replace('https://afamilycdn.com/zoom/600_315/', 'https://afamilycdn.com/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://cafebiz.cafebizcdn.vn/zoom/600_315/', 'https://cafebiz.cafebizcdn.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://cafefcdn.com/zoom/600_315/', 'https://cafefcdn.com/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://danviet.mediacdn.vn/zoom/600_315/', 'https://danviet.mediacdn.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://images2.thanhnien.vn/zoom/600_315/', 'https://images2.thanhnien.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://kenh14cdn.com/zoom/600_315/', 'https://kenh14cdn.com/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://sohanews.sohacdn.com/zoom/600_315/', 'https://sohanews.sohacdn.com/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://autopro8.mediacdn.vn/zoom/600_315/', 'https://autopro8.mediacdn.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://vtv1.mediacdn.vn/zoom/600_315/', 'https://vtv1.mediacdn.vn/thumb_w/' . trim($width) . '/', $url);
        $url = str_replace('https://vtv1.mediacdn.vn/fb_thumb_bn/', 'https://vtv1.mediacdn.vn/thumb_w/' . trim($width) . '/', $url);
        // OneCMS
        $url = str_replace('https://vb.1cdn.vn/thumbs/680x425/', 'https://vb.1cdn.vn/thumbs/' . trim($width) . 'x' . trim($height) . '/', $url);
        $url = str_replace('https://vb.1cdn.vn/thumbs/600x315/', 'https://vb.1cdn.vn/thumbs/' . trim($width) . 'x' . trim($height) . '/', $url);
        $url = str_replace('https://hgth.1cdn.vn/thumbs/680x425/', 'https://hgth.1cdn.vn/thumbs/' . trim($width) . 'x' . trim($height) . '/', $url);
        $url = str_replace('https://hgth.1cdn.vn/thumbs/600x315/', 'https://hgth.1cdn.vn/thumbs/' . trim($width) . 'x' . trim($height) . '/', $url);
        // Other Site
        $url = str_replace('https://cdnmedia.webthethao.vn/thumb/600-315/uploads', 'https://cdnmedia.webthethao.vn/thumb/' . trim($width) . 'x' . trim($height) . '/uploads', $url);
        $url = str_replace('https://cdnmedia.webthethao.vn/uploads', 'https://cdnmedia.webthethao.vn/thumb/' . trim($width) . 'x' . trim($height) . '/uploads', $url);
        $url = str_replace('https://media.bongda.com.vn/resize/1200x627/files', 'https://media.bongda.com.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.bongda.com.vn/resize/1200x630/files', 'https://media.bongda.com.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.bongda.com.vn/resize/600x312/files', 'https://media.bongda.com.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.bongda.com.vn/files', 'https://media.bongda.com.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.yeah1.com/resize/1200x630/files/', 'https://media.yeah1.com/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://media.yeah1.com/resize/680x415/files/', 'https://media.yeah1.com/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://imgamp.phunutoday.vn/resize/1200x627/files/', 'https://thumb.phunutoday.vn/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://imgamp.phunutoday.vn/resize/1200x630/files/', 'https://thumb.phunutoday.vn/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://imgamp.phunutoday.vn/resize/700x400/files/', 'https://thumb.phunutoday.vn/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://imgamp.phunutoday.vn/resize/600x312/files/', 'https://thumb.phunutoday.vn/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://imgamp.phunutoday.vn/files/', 'https://thumb.phunutoday.vn/resize/' . trim($width) . 'x' . trim($height) . '/files/', $url);
        $url = str_replace('https://congluan-cdn.congluan.vn/resize/1200x627/files', 'https://congluan-cdn.congluan.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://congluan-cdn.congluan.vn/resize/1200x630/files', 'https://congluan-cdn.congluan.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://congluan-cdn.congluan.vn/resize/700x400/files', 'https://congluan-cdn.congluan.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://congluan-cdn.congluan.vn/resize/600x312/files', 'https://congluan-cdn.congluan.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://congluan-cdn.congluan.vn/files', 'https://congluan-cdn.congluan.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.tiepthigiadinh.vn/resize/1200x627/files', 'https://media.tiepthigiadinh.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.tiepthigiadinh.vn/resize/1200x630/files', 'https://media.tiepthigiadinh.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.tiepthigiadinh.vn/resize/700x400/files', 'https://media.tiepthigiadinh.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.tiepthigiadinh.vn/resize/600x312/files', 'https://media.tiepthigiadinh.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);
        $url = str_replace('https://media.tiepthigiadinh.vn/files', 'https://media.tiepthigiadinh.vn/resize/' . trim($width) . 'x' . trim($height) . '/files', $url);

        $url = str_replace('https://news-thumb2.ymgstatic.com/YanThumbNews/', 'https://static2.yan.vn/' . trim($width) . 'x' . trim($height) . '/YanThumbNews/', $url);
        // media.anhp.vn
        $url = str_replace('http://media.anhp.vn:8081/', 'http://media.anhp.vn/', $url);

        return trim($url);
    }
}
