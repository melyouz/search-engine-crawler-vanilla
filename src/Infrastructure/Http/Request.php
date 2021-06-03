<?php


namespace App\Infrastructure\Http;


class Request
{
    private array $query;

    public function __construct(array $query)
    {
        $this->query = $query;
    }

    public static function createFromHttpGlobals(): self
    {
        $query = [];

        foreach($_GET as $key => $value) {
            $query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
        }

        return new self($query);
    }

    public function getParams(): array
    {
        return $this->query;
    }

    public function getParam(string $key, $default = null)
    {
        return $this->query[$key] ?? $default;
    }
}