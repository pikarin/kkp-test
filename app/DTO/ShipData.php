<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class ShipData
{
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public string $ownerName,
        public string $ownerAddress,
        public int $size,
        public string $captainName,
        public int $crewSize,
        public string $licenseNumber,
        public ?UploadedFile $picture = null,
        public ?UploadedFile $permitDocument = null,
        public ?string $status = null,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
            id: $data['id'],
            code: $data['code'],
            name: $data['name'],
            ownerName: $data['owner_name'],
            ownerAddress: $data['owner_address'],
            size: $data['size'],
            captainName: $data['captain_name'],
            crewSize: $data['crew_size'],
            licenseNumber: $data['license_number'],
            picture: $data['picture'] ?? null,
            permitDocument: $data['permit_document'] ?? null,
            status: $data['status'] ?? null,
        );
    }
}
