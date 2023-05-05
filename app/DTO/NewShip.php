<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class NewShip
{
    public function __construct(
        public int $userId,
        public string $code,
        public string $name,
        public string $ownerName,
        public string $ownerAddress,
        public int $size,
        public string $captainName,
        public int $crewSize,
        public string $licenseNumber,
        public UploadedFile $picture,
        public UploadedFile $permitDocument,
        public ?string $status = null,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
            userId: $data['user_id'],
            code: $data['code'],
            name: $data['name'],
            ownerName: $data['owner_name'],
            ownerAddress: $data['owner_address'],
            size: $data['size'],
            captainName: $data['captain_name'],
            crewSize: $data['crew_size'],
            licenseNumber: $data['license_number'],
            picture: $data['picture'],
            permitDocument: $data['permit_document'],
        );
    }
}
