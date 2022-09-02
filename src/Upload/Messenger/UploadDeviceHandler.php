<?php

namespace App\Upload\Messenger;

use App\Data\DeviceRow;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadDeviceHandler implements MessageHandlerInterface
{
    public function __invoke(DeviceRow $device): void
    {
        // do something with the resource
    }
}