<?php

use App\Models\Anteing;
use App\Models\ButtonSupport;
use App\Models\CoverageDensity;
use App\Models\FrequencyBand;
use App\Models\Guarantee;
use App\Models\MadeIn;
use App\Models\Manufacture;
use App\Models\Port;
use App\Models\Promotion;
use App\Models\SpeedWifi;
use App\Models\StandardNetwork;
use App\Models\TypeAnteing;
use App\Models\TypeDevice;
use App\Models\UserConnect;

function getAllManufacture() {
    $manufactureList = new Manufacture();
    return $manufactureList->getAll();
}

function getAllCoverageDensity() {
    $coverageDensityList = new CoverageDensity();
    return $coverageDensityList->getAll();
}

function getAllFrequencyBand() {
    $frequencyBandList = new FrequencyBand();
    return $frequencyBandList->getAll();
}

function getAllGuarantee() {
    $guaranteeList = new Guarantee();
    return $guaranteeList->getAll();
}

function getAllMadeIn() {
    $madeInList = new MadeIn();
    return $madeInList->getAll();
}

function getAllPromotion() {
    $promotionList = new Promotion();
    return $promotionList->getAll();
}

function getAllSpeedWifi() {
    $speedWifiList = new SpeedWifi();
    return $speedWifiList->getAll();
}

function getAllStandardNetwork() {
    $standardNetworkList = new StandardNetwork();
    return $standardNetworkList->getAll();
}

function getAllTypeAnteing() {
    $typeAnteingList = new TypeAnteing();
    return $typeAnteingList->getAll();
}

function getAllTypeDevice() {
    $typeDeviceList = new TypeDevice();
    return $typeDeviceList->getAll();
}

function getAllUserConnect() {
    $userConnectList = new UserConnect();
    return $userConnectList->getAll();
}

function getAllButtonSupport() {
    $buttonSupportList = new ButtonSupport();
    return $buttonSupportList->getAll();
}

function getAllPort() {
    $portList = new Port();
    return $portList->getAll();
}

function getAllAnteing() {
    $anteingList = new Anteing();
    return $anteingList->getAll();
}

