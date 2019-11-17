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
$GLOBALS['TL_LANG']['immoscout24']['numberOfLifts'] = 'Number of lifts';
$GLOBALS['TL_LANG']['immoscout24']['freeFromYear'] = 'Free from';
$GLOBALS['TL_LANG']['immoscout24']['baseRent'] = 'Base rent';
$GLOBALS['TL_LANG']['immoscout24']['totalRent'] = 'Total rent';
$GLOBALS['TL_LANG']['immoscout24']['heatingCosts'] = 'Heating costs';
$GLOBALS['TL_LANG']['immoscout24']['heatingCostsInServiceCharge'] = 'Heating costs included in service charge';
$GLOBALS['TL_LANG']['immoscout24']['petsAllowed'] = 'Pets allowed';
$GLOBALS['TL_LANG']['immoscout24']['basement'] = 'Basement';
$GLOBALS['TL_LANG']['immoscout24']['buildingPermission'] = 'Building permission';

// generic values
$GLOBALS['TL_LANG']['immoscout24']['none'] = '-';
$GLOBALS['TL_LANG']['immoscout24']['yes'] = 'Yes';
$GLOBALS['TL_LANG']['immoscout24']['no'] = 'No';

// enumerations
$GLOBALS['TL_LANG']['immoscout24']['objectType'] = 'Object type';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_REAL_ESTATE] = 'default';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_BUY] = 'house buy';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_RENT] = 'house rent';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GARAGE_RENT] = 'garage rent';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GARAGE_BUY] = 'garage buy';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SENIOR_CARE] = 'senior care';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_ASSISTED_LIVING] = 'assisted living';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_APARTMENT_RENT] = 'apartment rent';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_APARTMENT_BUY] = 'apartment buy';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_COMPULSORY_AUCTION] = 'auction';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SHORT_TERM_ACCOMMODATION] = 'short term accommodation';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_INVESTMENT] = 'investment';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_OFFICE] = 'office';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_STORE] = 'store';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GASTRONOMY] = 'gastronomy';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_INDUSTRY] = 'industry';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SPECIAL_PURPOSE] = 'special purpose';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_LIVING_BUY_SITE] = 'living buy site';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_LIVING_RENT_SITE] = 'living rent site';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_TRADE_SITE] = 'trade site';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_TYPE] = 'house type';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_FLAT_SHARE_ROOM] = 'flat share room';

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
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SINGLE_FAMILY_HOUSE] = 'single family house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_MID_TERRACE_HOUSE] = 'mid terrace house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_END_TERRACE_HOUSE] = 'end terrace house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_MULTI_FAMILY_HOUSE] = 'multi family house';

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

$GLOBALS['TL_LANG']['immoscout24']['apartmentType'] = 'Apartment type';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_ROOF_STOREY] = 'roof storey';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_LOFT] = 'loft';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_MAISONETTE] = 'maisonette';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_PENTHOUSE] = 'penthouse';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_TERRACED_FLAT] = 'terraced flat';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_GROUND_FLOOR] = 'ground floor';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_APARTMENT] = 'apartment';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_RAISED_GROUND_FLOOR] = 'raised ground floor';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_HALF_BASEMENT] = 'half basement';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_OTHER] = 'other';

$GLOBALS['TL_LANG']['immoscout24']['industryType'] = 'Industry type';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SHOWROOM_SPACE] = 'showroom space';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_HALL] = 'hall';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_HIGH_LACK_STORAGE] = 'high lack storage';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_INDUSTRY_HALL] = 'industry hall';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_INDUSTRY_HALL_WITH_OPEN_AREA] = 'hall with open area';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_COLD_STORAGE] = 'cold storage';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_MULTIDECK_CABINET_STORAGE] = 'multi-deck cabinet storage';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_WITH_OPEN_AREA] = 'storage with open area';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_AREA] = 'storage area';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_HALL] = 'storage hall';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SERVICE_AREA] = 'service area';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SHIPPING_STORAGE] = 'shipping storage';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_REPAIR_SHOP] = 'repair shop';

$GLOBALS['TL_LANG']['immoscout24']['investmentType'] = 'Investment type';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SINGLE_FAMILY_HOUSE] = 'single family house';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_MULTI_FAMILY_HOUSE] = 'multi family house';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_FREEHOLD_FLAT] = 'freehold flat';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SHOPPING_CENTRE] = 'shopping centre';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_RESTAURANT] = 'restaurant';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HOTEL] = 'hotel';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_LEISURE_FACILITY] = 'leisure facility';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_UNIT] = 'commercial unit';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_OFFICE_BUILDING] = 'office building';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_BUILDING] = 'commercial building';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_PROPERTY] = 'commercial property';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HALL_STORAGE] = 'hall storage';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_INDUSTRIAL_PROPERTY] = 'industrial property';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SHOP_SALES_FLOOR] = 'shop sales flor';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SERVICE_CENTRE] = 'service centre';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_OTHER] = 'other';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SUPERMARKET] = 'supermarket';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_LIVING_BUSINESS_HOUSE] = 'living business house';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HOUSING_ESTATE] = 'housing estate';

$GLOBALS['TL_LANG']['immoscout24']['officeType'] = 'Office type';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_LOFT] = 'loft';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_STUDIO] = 'studio';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE] = 'office';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_FLOOR] = 'office floor';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_BUILDING] = 'office building';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_CENTRE] = 'office centre';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_STORAGE_BUILDING] = 'office storage building';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY] = 'surgery';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY_FLOOR] = 'surgery floor';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY_BUILDING] = 'surgery building';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_COMMERCIAL_CENTRE] = 'commercial centre';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_LIVING_AND_COMMERCIAL_BUILDING] = 'living and commercial building';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_AND_COMMERCIAL_BUILDING] = 'office and commercial building';

$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration'] = 'Office rent duration';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::OFFICE_RENT_DURATION_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_WEEKLY] = 'weekly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_MONTHLY] = 'monthly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_YEARLY] = 'yearly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_LONG_TERM] = 'long term';

$GLOBALS['TL_LANG']['immoscout24']['garageType'] = 'Garage type';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_GARAGE] = 'garage';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_STREET_PARKING] = 'street parking';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_CARPORT] = 'carport';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_DUPLEX] = 'duplex';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_CAR_PARK] = 'car park';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_UNDERGROUND_GARAGE] = 'underground garage';

$GLOBALS['TL_LANG']['immoscout24']['commercializationType'] = 'Commercialization type';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_BUY] = 'buy';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_RENT] = 'rent';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_LEASE] = 'lease';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_LEASEHOLD] = 'leasehold';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_COMPULSORY_AUCTION] = 'compulsory auction';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_RENT_AND_BUY] = 'rent and buy';

$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse'] = 'Recommended site use';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::RECOMMENDED_USE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FUTURE_DEVELOPMENT_LAND] = 'future development land';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_TWINHOUSE] = 'twin house';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_SINGLE_FAMILY_HOUSE] = 'single family house';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_GARAGE] = 'garage';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_GARDEN] = 'garden';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_NO_DEVELOPMENT] = 'no development';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_APARTMENT_BUILDING] = 'apartment building';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_ORCHARD] = 'orchard';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_TERRACE_HOUSE] = 'terrace house';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_PARKING_SPACE] = 'parking space';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_VILLA] = 'villa';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FORREST] = 'forrest';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FARMLAND] = 'farmland';

$GLOBALS['TL_LANG']['immoscout24']['storeType'] = 'Store type';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SHOWROOM_SPACE] = 'showroom space';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SHOPPING_CENTRE] = 'shopping centre';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_FACTORY_OUTLET] = 'factory outlet';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_DEPARTMENT_STORE] = 'department store';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_KIOSK] = 'kiosk';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_STORE] = 'store';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SELF_SERVICE_MARKET] = 'self service market';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SALES_AREA] = 'sales area';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SALES_HALL] = 'sales hall';

$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization'] = 'Trade site utilization';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_LEISURE] = 'leisure';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_AGRICULTURE_FORESTRY] = 'agriculture forestry';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_TRADE] = 'trade';
