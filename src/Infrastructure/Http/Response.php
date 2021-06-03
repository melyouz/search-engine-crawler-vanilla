<?php


namespace App\Infrastructure\Http;


class Response
{
    public const HTTP_OK = 200;
    public const HTTP_BAD_REQUEST = 400;

    public const HTTP_STATUS_MESSAGES = [
        self::HTTP_OK => 'Accepted',
        self::HTTP_BAD_REQUEST => 'Bad Request',
    ];

    private string $content;
    private int $statusCode;
    private array $headers;

    public function __construct(string $content, int $statusCode, array $headers = [])
    {
        $this->content = $content;
        $this->headers = $headers;
        $this->statusCode = $statusCode;
    }

    public function sendHeaders(): void
    {
        $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.0';
        $statusMessage = self::HTTP_STATUS_MESSAGES[$this->statusCode] ?? '';
        header(sprintf('%s %d %s', $protocol, $this->statusCode, $statusMessage));

        foreach($this->headers as $key => $value) {
            header("$key: $value");
        }
    }

    public function sendContent(): void
    {
        echo $this->content;
    }
}