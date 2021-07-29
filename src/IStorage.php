<?php
namespace Ivan\Console;

Interface IStorage
{
    public function getCommands(): array;

    public function putCommands(Command ...$commands): void ;
}