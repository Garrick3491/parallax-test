<?php

namespace App\Upload\Messenger;

use GuzzleHttp\Client;
use App\Data\DeviceRow;
use Symfony\Component\Serializer\SerializerInterface;

class DeviceToApiImporter
{
    private Client $guzzle;
    public function __construct(private SerializerInterface $serializer)
    {
        $this->client = new Client(['base_uri' => 'http://127.0.0.1:8000']);
    }

    public function import(DeviceRow $device): bool
    {
        $serialized = $this->serializer->serialize($device, 'json');

        $response = $this->client->request('POST', '/api/devices', [
            'body' => $serialized
        ]);

        if ($response->getStatusCode() === 202)
        {
            return true;
        }
        
        return false;
    }
}