<?php
// src/DataTransformer/ParkingDtoDataTransformer.php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Parking;
use App\Entity\ParkingSpace;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;

final class ParkingDtoDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        if(isset($context[AbstractItemNormalizer::OBJECT_TO_POPULATE]) ) {
            $existingParking = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
            $existingParking->setName($data->getName());
            $existingParking->setLocalisation($data->getLocalisation());
            return $existingParking;
        } else {
            $parking = new Parking();
            $parking->setName($data->getName());
            $parking->setLocalisation($data->getLocalisation());
            for($i = 0; $i < $data->getNbParkingSpaces(); $i++) {
                $parkingSpace = new ParkingSpace();
                $parkingSpace->setHeight($data->getHeight());
                $parkingSpace->setWidth($data->getWidth());
                $parking->addParkingSpace($parkingSpace);
            }

            return $parking;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a Parking we transformed the data already
        if ($data instanceof Parking) {
          return false;
        }

        return Parking::class === $to && null !== ($context['input']['class'] ?? null);
    }
}