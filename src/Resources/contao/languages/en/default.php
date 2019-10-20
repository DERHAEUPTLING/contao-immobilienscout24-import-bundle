<?php

declare(strict_types=1);

use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate as RE;

// backend
$GLOBALS['TL_LANG']['MOD']['immoscout24_accounts'] = ['Immoscout24 Accounts'];
$GLOBALS['TL_LANG']['FMD']['immoscout24'] = ['Immoscout24'];
$GLOBALS['TL_LANG']['FMD']['immoscout24_real_estate_list'] = ['Real estate list'];
$GLOBALS['TL_LANG']['FMD']['immoscout24_real_estate_reader'] = ['Real estate reader'];

// attribute labels
$GLOBALS['TL_LANG']['immoscout24']['realEstateId'] = 'Real estate ID';
$GLOBALS['TL_LANG']['immoscout24']['title'] = 'Title';
$GLOBALS['TL_LANG']['immoscout24']['createdAt'] = 'Offer created at';
$GLOBALS['TL_LANG']['immoscout24']['modifiedAt'] = 'Offer last modified at';
$GLOBALS['TL_LANG']['immoscout24']['listed'] = 'Listed';
$GLOBALS['TL_LANG']['immoscout24']['descriptionNote'] = 'Description';
$GLOBALS['TL_LANG']['immoscout24']['furnishingNote'] = 'Furnishing';
$GLOBALS['TL_LANG']['immoscout24']['locationNote'] = 'Location';
$GLOBALS['TL_LANG']['immoscout24']['otherNote'] = 'More';
$GLOBALS['TL_LANG']['immoscout24']['addressStreet'] = 'Street';
$GLOBALS['TL_LANG']['immoscout24']['addressHouseNumber'] = 'House number';
$GLOBALS['TL_LANG']['immoscout24']['addressCity'] = 'City';
$GLOBALS['TL_LANG']['immoscout24']['addressZip'] = 'Zip code';
$GLOBALS['TL_LANG']['immoscout24']['addressLatitude'] = 'Latitude';
$GLOBALS['TL_LANG']['immoscout24']['addressLongitude'] = 'Longitude';
$GLOBALS['TL_LANG']['immoscout24']['price'] = 'Price in €';
$GLOBALS['TL_LANG']['immoscout24']['numberOfFloors'] = 'Number of floors';
$GLOBALS['TL_LANG']['immoscout24']['numberOfRooms'] = 'Number of rooms';
$GLOBALS['TL_LANG']['immoscout24']['numberOfBathrooms'] = 'Number of bathrooms';
$GLOBALS['TL_LANG']['immoscout24']['numberOfBedrooms'] = 'Number of bedrooms';
$GLOBALS['TL_LANG']['immoscout24']['cellar'] = 'Cellar';
$GLOBALS['TL_LANG']['immoscout24']['builtInKitchen'] = 'Built in kitchen';
$GLOBALS['TL_LANG']['immoscout24']['balcony'] = 'Balcony';
$GLOBALS['TL_LANG']['immoscout24']['garden'] = 'Garden';
$GLOBALS['TL_LANG']['immoscout24']['guestToilet'] = 'Guest toilet';
$GLOBALS['TL_LANG']['immoscout24']['livingSpace'] = 'Living space in m²';
$GLOBALS['TL_LANG']['immoscout24']['plotArea'] = 'Plot area in m²';
$GLOBALS['TL_LANG']['immoscout24']['lodgerFlat'] = 'Lodger flat';
$GLOBALS['TL_LANG']['immoscout24']['summerResidencePractical'] = 'Summer residence practical';
$GLOBALS['TL_LANG']['immoscout24']['rented'] = 'Rented';
$GLOBALS['TL_LANG']['immoscout24']['rentalIncome'] = 'Rental income in €';
$GLOBALS['TL_LANG']['immoscout24']['constructionYear'] = 'Construction year';
$GLOBALS['TL_LANG']['immoscout24']['lastRefurbishment'] = 'Last refurbishment';
$GLOBALS['TL_LANG']['immoscout24']['thermalCharacteristic'] = 'Thermal characteristics';
$GLOBALS['TL_LANG']['immoscout24']['energyConsumptionContainsWarmWater'] = 'Warm water included in energy consumption';
$GLOBALS['TL_LANG']['immoscout24']['energyPerformanceCertificate'] = 'Energy performance certificate';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateEfficiencyClass'] = 'Efficiency class of energy certificate';
$GLOBALS['TL_LANG']['immoscout24']['numberOfParkingSpaces'] = 'Parking spaces';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpacePrice'] = 'Parking space price in €';
$GLOBALS['TL_LANG']['immoscout24']['handicappedAccessible'] = 'Handicapped accessible';
$GLOBALS['TL_LANG']['immoscout24']['courtage'] = 'Courtage';
$GLOBALS['TL_LANG']['immoscout24']['courtageValue'] = 'Courtage';
$GLOBALS['TL_LANG']['immoscout24']['courtageNote'] = 'Courtage explained';

// generic values
$GLOBALS['TL_LANG']['immoscout24']['none'] = '-';
$GLOBALS['TL_LANG']['immoscout24']['yes'] = 'Yes';
$GLOBALS['TL_LANG']['immoscout24']['no'] = 'No';

// enumerations
$GLOBALS['TL_LANG']['immoscout24']['state'] = 'Status';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_INACTIVE] = 'inactive';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_ACTIVE] = 'active';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_DRAFT] = 'draft';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_ARCHIVED] = 'archived';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_TO_BE_DELETED] = 'to be deleted';

$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType'] = 'Price interval';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_ONE_TIME_CHARGE] = 'one time charge';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_DAY] = 'daily';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_WEEK] = 'weekly';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_MONTH] = 'monthly';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_YEAR] = 'yearly';

$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType'] = 'Price marketing';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_PURCHASE] = 'purchase';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_PURCHASE_PER_SQM] = 'purchase per m²';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT] = 'rent';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT_PER_SQM] = 'rent per m²';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_LEASE] = 'lease';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_LEASEHOLD] = 'lease hold';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_BUDGET_RENT] = 'budget rent';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT_AND_BUY] = 'rent and buy';

$GLOBALS['TL_LANG']['immoscout24']['buildingType'] = 'Building type';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_BLOCKHOUSE] = 'block house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_BUNGALOW] = 'bungalow';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SEMI_DETACHED_HOUSE] = 'semi detached house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_ONE_FAMILY_HOUSE] = 'one family house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_FAMILY_HOUSE_WITH_LODGER_FLAT] = 'family house with lodger flat';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_TUDOR_HOUSE] = 'tudor house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_WOODEN_HOUSE] = 'wooden house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_COUNTRY_HOUSE] = 'country house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_APARTMENT_BUILDING] = 'apartment house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_NON_DETACHED_HOUSE] = 'non detached house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_CITY_VILLA] = 'city villa';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_VILLA] = 'villa';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SEMI_DETACHED_HOUSE_PAIR] = 'semi detached house pair';

$GLOBALS['TL_LANG']['immoscout24']['constructionPhase'] = 'Construction phase';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_COMPLETED] = 'completed';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_PROJECTED] = 'projected';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_UNDER_CONSTRUCTION] = 'under construction';

$GLOBALS['TL_LANG']['immoscout24']['condition'] = 'Condition';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FIRST_TIME_USE] = 'first time use';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FIRST_TIME_USE_AFTER_REFURBISHMENT] = 'first time use after refurbishment';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_MINT_CONDITION] = 'mint condition';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_REFURBISHED] = 'refurbished';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_MODERNIZED] = 'modernized';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FULLY_RENOVATED] = 'fully renovated';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_WELL_KEPT] = 'well kept';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NEED_OF_RENOVATION] = 'in need of renovation';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NEGOTIABLE] = 'negotiable';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_RIPE_FOR_DEMOLITION] = 'ripe for demolition';

$GLOBALS['TL_LANG']['immoscout24']['interiorQuality'] = 'Interior quality';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_SIMPLE] = 'simple';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_NORMAL] = 'normal';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_LUXURY] = 'luxury';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_SOPHISTICATED] = 'sophisticated';

$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014'] = 'Heating type (EnEV 2014)';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_SELF_CONTAINED_CENTRAL_HEATING] = 'self contained central heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_STOVE_HEATING] = 'stove heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_CENTRAL_HEATING] = 'central heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_COMBINED_HEAT_AND_POWER_PLANT] = 'combined heat and power plant';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_ELECTRIC_HEATING] = 'electrical heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_DISTRICT_HEATING] = 'district heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_FLOOR_HEATING] = 'floor heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_GAS_HEATING] = 'gas heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_WOOD_PELLET_HEATING] = 'wood pellet heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_NIGHT_STORAGE_HEATER] = 'night storage heater';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_OIL_HEATING] = 'oil heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_SOLAR_HEATING] = 'solar heating';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_HEAT_PUMP] = 'heat pump';

$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType'] = 'Energy rating type';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_ENERGY_REQUIRED] = 'energy required';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_ENERGY_CONSUMPTION] = 'energy consumption';

$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability'] = 'Energy certificate';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_AVAILABLE] = 'available';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NOT_AVAILABLE_YET] = 'not available yet';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NOT_REQUIRED] = 'not required';

$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate'] = 'Creation date of energy certificate';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_BEFORE_01_MAY_2014] = 'before May 1st, 2014';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_FROM_01_MAY_2014] = 'after May 1st, 2014';

$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType'] = 'Parking space type';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_GARAGE] = 'garage';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_OUTSIDE] = 'outside';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_CARPORT] = 'carport';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_DUPLEX] = 'duplex';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_CAR_PARK] = 'car park';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_UNDERGROUND_GARAGE] = 'underground garage';
