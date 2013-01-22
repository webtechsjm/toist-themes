<?php

define("JUICEMOBILEV2_MODE", "live");

function juicemobilev2_ad()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $ip = (stristr($ua,"opera mini") && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
        ? trim(end(split(",", $_SERVER['HTTP_X_FORWARDED_FOR'])))
        : $_SERVER['REMOTE_ADDR'];

    // prepare url parameters of request
    $juicemobilev2_get  = 'site='.urlencode('17511');
    $juicemobilev2_get .= '&ip='.urlencode($ip);
    $juicemobilev2_get .= '&ua='.urlencode($ua);
    $juicemobilev2_get .= '&url='.urlencode(sprintf("http%s://%s%s", (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == TRUE ? "s": ""), $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"]));
    $juicemobilev2_get .= '&zone='.urlencode('53845');
    $juicemobilev2_get .= '&type=-1'; // type of ads (1 - text, 2 - image, 4 - richmedia ad) or a combination like 3 = 1+2 (text + image), 7 = 1+2+4 (text + image + richmedia)
    $juicemobilev2_get .= '&key=1';
    //$juicemobilev2_get .= '&lat=1';
    //$juicemobilev2_get .= '&long=1';
    $juicemobilev2_get .= '&count=1'; // quantity of ads
    $juicemobilev2_get .= '&version='.urlencode('php_0001'); // php code version
    $juicemobilev2_get .= '&keywords='; // keywords to search ad delimited by commas (not necessary)
    $juicemobilev2_get .= '&whitelabel=0'; // filter by whitelabel(0 - all, 1 - only whitelabel, 2 - only non-whitelabel)
    $juicemobilev2_get .= '&premium=0'; // filter by premium status (0 - non-premium, 1 - premium only, 2 - both)
    $juicemobilev2_get .= '&over_18=0'; // filter by ad over 18 content (0 or 1 - deny over 18 content , 2 - only over 18 content, 3 - allow all ads including over 18 content)
    $juicemobilev2_get .= '&paramBORDER='.urlencode('#000000'); // ads border color
    $juicemobilev2_get .= '&paramHEADER='.urlencode('#cccccc'); // header color
    $juicemobilev2_get .= '&paramBG='.urlencode('#eeeeee'); // background color
    $juicemobilev2_get .= '&paramTEXT='.urlencode('#000000'); // text color
    $juicemobilev2_get .= '&paramLINK='.urlencode('#ff0000'); // url color


    //check UID
    if ( isset($_COOKIE['MOCEAN_AD_UDID']) ) {
        if(setcookie('MOCEAN_AD_UDID', $_COOKIE['MOCEAN_AD_UDID'], time() + 60 * 60 * 24 * 7)) {
            $juicemobilev2_get .= '&udid='.urlencode($_COOKIE['MOCEAN_AD_UDID']);
        }
    } else {
        $udid = md5(time()+rand());
        if(setcookie('MOCEAN_AD_UDID', $udid, time() + 60 * 60 * 24 * 7)) {
            $juicemobilev2_get .= '&udid='.urlencode($udid);
        }
    }


    if(JUICEMOBILEV2_MODE == "test") $juicemobilev2_get .= '&test=1';

    // send request
    $juicemobilev2_request = @fsockopen('ads.juicemobile.ca', 80, $errno, $errstr, 1);
    if ($juicemobilev2_request) {
        stream_set_timeout($juicemobilev2_request, 3000);
        $query = "GET /ad?".$juicemobilev2_get." HTTP/1.0\r\n";
        $query .= "Host: ads.juicemobile.ca\r\n";
        $query .= "Connection: close\r\n";


        // IIS support
        if(isset($_SERVER['ALL_HTTP']) && is_array($_SERVER['ALL_HTTP'])) {
            foreach ($_SERVER['ALL_HTTP'] as $name => $value) {
                $query .= "CS_$name: $value\r\n";
            }
        }
        elseif(isset($_SERVER['ALL_HTTP'])) {
            $array = explode("\n",$_SERVER['ALL_HTTP']);
            foreach ($array as $value) {
                if($value) {
                    $query .= "CS_$value\r\n";
                }
            }
        }

        foreach ($_SERVER as $name => $value) {
            $query .= "CS_$name: $value\r\n";
        }

        $query .= "\r\n";
        fwrite($juicemobilev2_request, $query);
        $juicemobilev2_info = stream_get_meta_data($juicemobilev2_request);
        $juicemobilev2_timeout = $juicemobilev2_info['timed_out'];
        $juicemobilev2_contents = "";
        $juicemobilev2_body = false;
        $juicemobilev2_head = "";
        while (!feof($juicemobilev2_request) && !$juicemobilev2_timeout) {
            $juicemobilev2_line = fgets($juicemobilev2_request);
            if(!$juicemobilev2_body && $juicemobilev2_line == "\r\n") $juicemobilev2_body = true;
            if(!$juicemobilev2_body) $juicemobilev2_head .= $juicemobilev2_line;
            if($juicemobilev2_body && !empty($juicemobilev2_line)) $juicemobilev2_contents .= $juicemobilev2_line;
            $juicemobilev2_info = stream_get_meta_data($juicemobilev2_request);
            $juicemobilev2_timeout = $juicemobilev2_info['timed_out'];
        }
        fclose($juicemobilev2_request);
        if (!preg_match('/^HTTP\/1\.\d 200 OK/', $juicemobilev2_head)) $juicemobilev2_timeout = true;
        if($juicemobilev2_timeout) return "";
        return $juicemobilev2_contents;
    }
}

?>