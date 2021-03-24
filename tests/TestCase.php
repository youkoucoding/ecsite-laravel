<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param $uri
     * @param string $method
     * @param array $data
     */
    public function assertLitemallApi($uri, $method = 'get', $data = [], $ignore = [])
    {
        $client = new Client();
        if ($method == 'get') {
            $response1 = $this->get($uri, $this->getAuthHeader());
            $response2 = $client->get(
                '127.0.0.1' . $uri,
                ['headers' => ['X-Litemall-Token' => $this->token]]
            );
        } else {
            $response1 = $this->post($uri, $this->getAuthHeader());
            $response2 = $client->post(
                '127.0.0.1' . $uri,
                ['headers' => ['X-Litemall-Token' => $this->token], 'json' => $data],
            );
        }

        $content1 = $response1->getContent();
        $content1 = json_decode($content1, true);
        $content2 = $response2->getBody()->getContents();
        $content2 = json_decode($content2, true);

        foreach ($ignore as $key) {
            unset($content1[$key]);
            unset($content2[$key]);
        }

        $this->assertEuqals($content2, $content1);
    }

    public function assertLitemallApiGet($uri)
    {
        return $this->assertLitemallApi($uri);
    }

    public function assertLitemallApiPost($uri, $data = [])
    {
        return $this->assertLitemallApi($uri, 'post', $data);
    }
}
