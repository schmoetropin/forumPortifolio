<?php
declare(strict_types=1);

namespace Src\Core;

class Request
{
    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getDbRequestUri(): string
    {
        $reqUri = str_replace([REQ_URI.'/', REQ_URI_ROOT], '', $_SERVER['REQUEST_URI']);
        return $reqUri;
    }

    /**
     * @return array
     */
    public function validateInput(): array
    {
        $data = [];

        foreach ($_POST as $key => $value) {
            $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        foreach ($_GET as $key => $value) {
            $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        foreach ($_FILES as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}