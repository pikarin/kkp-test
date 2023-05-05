<?php

namespace App\Actions;

use App\DTO\ShipData;
use App\Models\Ship;
use Illuminate\Http\UploadedFile;

class UpdateShipAction
{
    public function execute(ShipData $shipData): void
    {
        $files = [];

        if ($shipData->picture) {
            $files['picture_path'] = $this->uploadPicture($shipData->picture);
        }

        if ($shipData->permitDocument) {
            $files['permit_document_path'] = $this->uploadDocument($shipData->permitDocument);
        }

        Ship::where('id', $shipData->id)
            ->update([
                'status' => $shipData->status,
                'code' => $shipData->code,
                'name' => $shipData->name,
                'owner_name' => $shipData->ownerName,
                'owner_address' => $shipData->ownerAddress,
                'size' => $shipData->size,
                'captain_name' => $shipData->captainName,
                'crew_size' => $shipData->crewSize,
                'license_number' => $shipData->licenseNumber,
                ...$files,
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
