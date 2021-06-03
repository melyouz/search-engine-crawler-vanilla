<?php


namespace App\Infrastructure\Http;


class JsonResponse extends Response
{
    public function __construct(array $data, int $statusCode, array $headers = [])
    {
        $content = json_encode($data);
        $headers = array_merge($headers, [
            'Content-Type' => 'application/json',
        ]);

        parent::__construct($content, $statusCode, $headers);
    }
}