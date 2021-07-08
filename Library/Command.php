<?php

abstract class Command
{
    protected string $name;
    protected string $description;

    public function __construct()
    {
        $this->config();
    }

    abstract public function execute($arguments, $options);
    protected function config()
    {

    }
}
