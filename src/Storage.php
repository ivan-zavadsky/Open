<?php
namespace Ivan\Console;

class Storage implements IStorage
{
    const STORAGE = 'db.txt';

    public function getCommands(): array
    {
        return json_decode(file_get_contents(self::STORAGE), true) ?? [];
    }

    public function putCommands(Command ...$commands): void
    {
        file_put_contents(self::STORAGE, json_encode($commands));
    }
}