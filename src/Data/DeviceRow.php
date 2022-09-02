<?php

namespace App\Data;

final class DeviceRow
{

    private string $name;
    private string $address;
    private string $longitude;
    private string $latitude;
    private string $deviceType;
    private string $manufacturer;
    private string $model;
    private \DateTime $installDate;
    private string $note;
    private string $eui;
    private string $serialNumber;

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
        return $this->deviceType;
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
        return $this->installDate;
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
        return $this->serialNumber;
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
        $self->deviceType  = $row['device_type'];
        $self->manufacturer = $row['manufacturer'];
        $self->model = $row['model'];
        $self->installDate = new \DateTime($row['install_date']);
        $self->note = $row['notes'];
        $self->eui = $row['eui'];
        $self->serialNumber = $row['serial_number'];

        return $self;
    }

}