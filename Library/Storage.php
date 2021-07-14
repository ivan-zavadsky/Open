<?php

class Storage
{
    const STORAGE = 'db.txt';

    public function getCommands()
    {
        return json_decode(file_get_contents(self::STORAGE), true) ?? [];
    }

    public function putCommands($commands)
    {
        file_put_contents(self::STORAGE, json_encode($commands));
    }
}