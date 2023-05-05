<?php

namespace App\Actions;

use App\DTO\NewShip;
use App\Models\Ship;
use Illuminate\Http\UploadedFile;

class RegisterShipAction
{
    public function execute(NewShip $newShip): Ship
    {
        return Ship::create([
            'status' => 'pending',
            'user_id' => $newShip->userId,
            'code' => $newShip->code,
            'name' => $newShip->name,
            'owner_name' => $newShip->ownerName,
            'owner_address' => $newShip->ownerAddress,
            'size' => $newShip->size,
            'captain_name' => $newShip->captainName,
            'crew_size' => $newShip->crewSize,
            'license_number' => $newShip->licenseNumber,
            'picture_path' => $this->uploadPicture($newShip->picture),
            'permit_document_path' => $this->uploadDocument($newShip->permitDocument),
        ]);
    }

    protected function uploadPicture(UploadedFile $picture): string
    {
        return $picture->storePublicly('ships/pictures');
    }

    protected function uploadDocument(UploadedFile $file): string
    {
        return $file->store('ships/documents');
    }
}
