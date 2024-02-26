<?php
/**
 * Get all stats of a specific video.
 */

new VimeoStats();

class VimeoStats
{

    static function getStats($url)
    {
        $video_id = str_replace('video/', '', substr(parse_url($url, PHP_URL_PATH), 1));
        $token = get_field('access_token', 'option');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vimeo.com/videos/$video_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return json_decode($response, true);
    }
}