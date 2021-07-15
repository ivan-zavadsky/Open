<?php

class Command_Name extends Command
{
    public function execute($arguments, $options)
    {
        echo $this->getView($arguments, $options);
    }

    private function getView($arguments, $options)
    {
        $command = strtolower(__CLASS__);

        $argumentsOutput = "";
        foreach ($arguments as $argument) {
            $argumentsOutput .= "    - $argument\n";
        }

        $optionsOutput = "";

        foreach ($options as $optionName => $optionValues) {
            $optionsOutput .= "    - $optionName\n";
            if (is_array($optionValues)) {
                foreach ($optionValues as $optionValue) {
                    $optionsOutput .= "        - $optionValue\n";
                }
            } else {
                $optionsOutput .= "        - $optionValues\n";
            }

        }

        return "Called command: $command\n\n"
            . "Arguments:\n$argumentsOutput\n"
            . "Options:\n$optionsOutput\n";

    }

    protected function isValid($arguments, $options)
    {
        return true;
    }

    protected function parseArguments($arguments, $options)
    {
        return [];
    }
}