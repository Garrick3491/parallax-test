<?php

namespace App\Upload\Validation;

use League\Csv\Reader;

class FileValidator
{
    public function validateCsv(Reader $csv): bool
    {
        $headers = $csv->getHeader();

        foreach ($headers as $header)
        {
            if (!in_array($header, [
                'name',	'address', 'longitude', 'latitude', 'device_type', 'manufacturer',	'model', 'install_date', 'notes', 'eui', 'serial_number'	
            ]))
            {
                return false;
            }
        }
        return true;
    }
}