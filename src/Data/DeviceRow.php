<?php

namespace App\Data;

final class DeviceRow
{

    private string $name;
    private string $address;
    private string $longitude;
    private string $latitude;
    private string $device_type;
    private string $manufacturer;
    private string $model;
    private \DateTime $install_date;
    private string $note;
    private string $eui;
    private string $serial_number;

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getDeviceType(): string
    {
        return $this->device_type;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getInstallDate(): \DateTime
    {
        return $this->install_date;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getEui(): string
    {
        return $this->eui;
    }

    public function getSerialNumber(): string
    {
        return $this->serial_number;
    }

    /**
     *  @param array<mixed> $row
     **/
    public static function make(array $row): self
    {
        $self = new self();
        $self->name = $row['name'];
        $self->address = $row['address'];
        $self->longitude = $row['longitude'];
        $self->latitude = $row['latitude'];
        $self->device_type  = $row['device_type'];
        $self->manufacturer = $row['manufacturer'];
        $self->model = $row['model'];
        $self->install_date = new \DateTime($row['install_date']);
        $self->note = $row['notes'];
        $self->eui = $row['eui'];
        $self->serial_number = $row['serial_number'];

        return $self;
        }


}