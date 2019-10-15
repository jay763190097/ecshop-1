<?php


namespace frontend\method;


class Method
{

    public static function getList()
    {
        $data = [];
        $file = @file_get_contents(\Yii::$app->params['admin_url'] . '/data/flash_data.xml');
        if (strlen($file) > 0) {
            $data = self::get_flash_xml($file);
        }
        return self::formatBody(['banners' => $data]);
    }

    private static function get_flash_xml($file)
    {
        $flashdb = array();

        // 兼容v2.7.0及以前版本
        if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]*)"\stext="([^"]*)"\ssort="([^"]*)"/', $file, $t, PREG_SET_ORDER)) {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]*)"\stext="([^"]*)"/', $file, $t, PREG_SET_ORDER);
        }
        if (!empty($t)) {
            foreach ($t as $key => $val) {
                $val[4] = isset($val[4]) ? $val[4] : 0;
//                $flashdb[] = array('id' => $key, 'photo' => self::formatPhoto($val[1]), 'link' => $val[2], 'title' => $val[3], 'sort' => $val[4]);
                $flashdb[] = array('id' => $key, 'photo' => self::formatPhoto($val[1]), 'link' => $val[2], 'title' => $val[3]);
            }
        }
        return $flashdb;
    }

    public static function formatBody(array $data = [])
    {
        $data['error_code'] = 0;
        return $data;
    }

    public static function formatPhoto($img, $thumb = null, $domain = null)
    {
        if ($img == null) {
            return null;
        }
        if ($thumb == null) {
            $thumb = $img;
        }

        $domain = $domain == null ? \Yii::$app->params['admin_url'] : $domain;

        if (!preg_match('/^http/', $thumb) && !preg_match('/^https/', $thumb)) {
            $thumb = $domain . '/' . $thumb;
        }


        if (!preg_match('/^http/', $img) && !preg_match('/^https/', $img)) {
            $img = $domain . '/' . $img;
        }

        return [
            //定义图片服务器
            'thumb' => $thumb,
            'large' => $img
        ];
    }

    /**
     * 返回两个时间的相距时间，*年*月*日*时*分*秒
     * @param int $one_time 时间一
     * @param int $two_time 时间二
     * @param int $return_type 默认值为0，0/不为0则拼接返回，1/*秒，2/*分*秒，3/*时*分*秒/，4/*日*时*分*秒，5/*月*日*时*分*秒，6/*年*月*日*时*分*秒
     * @param array $format_array 格式化字符，例，array('年', '月', '日', '时', '分', '秒')
     * @return String or false
     */
    public static function getRemainderTime($one_time, $two_time, $return_type = 0, $format_array = array('年', '月', '日', '时', '分', '秒'))
    {
        if ($return_type < 0 || $return_type > 6) {
            return false;
        }

        if (!(is_int($one_time) && is_int($two_time))) {
            return false;
        }

        $remainder_seconds = abs($one_time - $two_time);
        //年
        $years = 0;
        if (($return_type == 0 || $return_type == 6) && $remainder_seconds - 31536000 > 0) {
            $years = floor($remainder_seconds / (31536000));
        }
        //月
        $monthes = 0;
        if (($return_type == 0 || $return_type >= 5) && $remainder_seconds - $years * 31536000 - 2592000 > 0) {
            $monthes = floor(($remainder_seconds - $years * 31536000) / (2592000));
        }
        //日
        $days = 0;
        if (($return_type == 0 || $return_type >= 4) && $remainder_seconds - $years * 31536000 - $monthes * 2592000 - 86400 > 0) {
            $days = floor(($remainder_seconds - $years * 31536000 - $monthes * 2592000) / (86400));
        }
        //时
        $hours = 0;
        if (($return_type == 0 || $return_type >= 3) && $remainder_seconds - $years * 31536000 - $monthes * 2592000 - $days * 86400 - 3600 > 0) {
            $hours = floor(($remainder_seconds - $years * 31536000 - $monthes * 2592000 - $days * 86400) / 3600);
        }
        //分
        $minutes = 0;
        if (($return_type == 0 || $return_type >= 2) && $remainder_seconds - $years * 31536000 - $monthes * 2592000 - $days * 86400 - $hours * 3600 - 60 > 0) {
            $minutes = floor(($remainder_seconds - $years * 31536000 - $monthes * 2592000 - $days * 86400 - $hours * 3600) / 60);
        }
        //秒
        $seconds = $remainder_seconds - $years * 31536000 - $monthes * 2592000 - $days * 86400 - $hours * 3600 - $minutes * 60;
        $return = false;
        switch ($return_type) {
            case 0:
                if ($years > 0) {
                    $return = $years . $format_array[0] . $monthes . $format_array[1] . $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                } else if ($monthes > 0) {
                    $return = $monthes . $format_array[1] . $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                } else if ($days > 0) {
                    $return = $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                } else if ($hours > 0) {
                    $return = $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                } else if ($minutes > 0) {
                    $return = $minutes . $format_array[4] . $seconds . $format_array[5];
                } else {
                    $return = $seconds . $format_array[5];
                }
                break;
            case 1:
                $return = $seconds . $format_array[5];
                break;
            case 2:
                $return = $minutes . $format_array[4] . $seconds . $format_array[5];
                break;
            case 3:
                $return = $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                break;
            case 4:
                $return = $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                break;
            case 5:
                $return = $monthes . $format_array[1] . $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                break;
            case 6:
                $return = $years . $format_array[0] . $monthes . $format_array[1] . $days . $format_array[2] . $hours . $format_array[3] . $minutes . $format_array[4] . $seconds . $format_array[5];
                break;
            default:
                $return = false;
        }
        return $return;
    }


}