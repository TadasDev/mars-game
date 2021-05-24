<?php

namespace Core;

class Request
{
    private $post;
    private $get;
    private $server;

    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
        $this->server = $_SERVER;
    }

    public function getPathInfo()
    {
        if (isset($this->server['PATH_INFO'])) {
            return strtolower($this->server['PATH_INFO']);
        }

        return false;
    }

    public function getPost($key = null)
    {
        if ($key !== null && isset($this->post[$key])) {
            return $this->post[$key];
        }

        return null;
    }

    public function getGet($key = null)
    {
        if ($key !== null && isset($this->get[$key])) {
            return $this->get[$key];
        }

        return null;
    }
}