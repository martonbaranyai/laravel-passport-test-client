<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    $query = http_build_query([
        'client_id'     => 3,
        'redirect_uri'  => 'http://localhost:8888/callback',
        'response_type' => 'code',
        'scope'         => '',
    ]);

    return redirect('http://localhost:8000/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost:8000/oauth/token', [
        'form_params' => [
            'grant_type'    => 'authorization_code',
            'client_id'     => '3',
            'client_secret' => 'xhpy2uTws9HGTgHvTzXomonVJzRpITNUXZPqzNd4',
            'redirect_uri'  => 'http://localhost:8888/callback',
            'code'          => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

Route::get('/user', function () {
    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc3Yjc4Y2I3NDY4YmNkYTBjOTQ5ZWRiNDBhNjZlZDU0YTRhODIwMTE1M2NlOGJiNDU5MTBkNjg3YTQzZTE0ZGRjYWE5ZmE1ZTY3YmMzZTQ0In0.eyJhdWQiOiIzIiwianRpIjoiNzdiNzhjYjc0NjhiY2RhMGM5NDllZGI0MGE2NmVkNTRhNGE4MjAxMTUzY2U4YmI0NTkxMGQ2ODdhNDNlMTRkZGNhYTlmYTVlNjdiYzNlNDQiLCJpYXQiOjE0NzM4NTk2MjQsIm5iZiI6MTQ3Mzg1OTYyNCwiZXhwIjo0NjI5NTMzMjI0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.p59ykG5wcgwIoh8Yx-SXSFhHA9EvsTj2tCxZZ_dbmJCod5ShZxLa3mru45LK6Iy0G5YIzbRSo275R3bb0Zyp_jXjkIveMOlejQ7bVIn7cIk6PS-kD9YbxP4VSaShGQ3pdSmksQhFRSCVs7VwCdQAIdk9iPRSuo9g1awecJWzFk2-pFC6UFxrYRd7zgKsgmkDMtbgidtvwLOVUihKvG4BQ7_Qd2LQZG4E3dUdnchtU-vHMYdI9BzuUMz8l3T3zfPyh1JdXCgc930SYFyfCrzSEido5TI9DDBsqdQltOu5nZagOxhTgIkjNgfvUmoW55lw2AH0MirddImacyErPacNGuLI-v_7ua17_zjMcDjMaA5tDTTNVylOhduyVHTp_jwJKEqRfz2nIaoAZnBbj5xyVd4WfqDtf0nuh_vbOICEF_BbdGm3eJxcXR7knRx0hH44e56aSiAUvG7NcBB3m3IpRbP3u-DAC6tx3riN_ExSAyQWdGyCqDP_jkOq9VXvvAyaIyLxIGenmlHBl5TRxn1zzUZ6pwT1IBa4rNZO5Oxf_DLZ_N02Z4p4TlZJutrKAjuCh-WkCm7KBLDik0nIoZICaGq8N66wdBa68TY7Wpn8CrHOFYR4m9CCqR_APXIZ0o7g3U1eyFA6wXZBntw2BCwhjFdueDAK5Bun70bXlcRXJL4';
    $http = new GuzzleHttp\Client;

    $response = $http->get('http://localhost:8000/api/user', [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
        ]
    ]);

    return json_decode((string)$response->getBody(), true);
});