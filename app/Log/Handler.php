<?php
namespace App\Log;

use Monolog\Handler\StreamHandler;


class Handler extends StreamHandler
{
    protected function write(array $record)
    {
        $oldUrl = $this->getUrl();
        if (isset($record['context']['db'])) {
            $this->url = str_replace(pathinfo($this->getUrl(), PATHINFO_BASENAME), 'db.log', $this->getUrl());
        }
        parent::write($record);
        $this->url = $oldUrl;
    }

}