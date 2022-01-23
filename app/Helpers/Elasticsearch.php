<?php

namespace App\Helpers;

use Elasticsearch\ClientBuilder;

class Elasticsearch
{
    private static $client;

    public static function getClient()
    {
        if (is_null(static::$client)) {
            static::$client = ClientBuilder::create()->setHosts(config('eetree.es.hosts'))->build();
        }
        return static::$client;
    }

    public static function search($params, $index)
    {
        $result = static::getClient()->search([
            'index' => $index,
            'body' => $params,
        ]);
        if (isset($result['hits']['total']['value']) && $result['hits']['total']['value'] > 0) {
            return [
                'total' => $result['hits']['total']['value'],
                'hits' => $result['hits']['hits'],
            ];
        } else {
            return null;
        }
    }
}
