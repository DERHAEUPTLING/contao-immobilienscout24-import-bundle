<?php

declare(strict_types=1);

use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate as RE;

// backend
$GLOBALS['TL_LANG']['MOD']['immoscout24_accounts'] = ['Immoscout24 Accounts'];
$GLOBALS['TL_LANG']['FMD']['immoscout24'] = ['Immoscout24'];
$GLOBALS['TL_LANG']['FMD']['immoscout24_real_estate_list'] = ['Immobilien Liste'];
$GLOBALS['TL_LANG']['FMD']['immoscout24_real_estate_reader'] = ['Immobilien Leser'];

// attribute labels
$GLOBALS['TL_LANG']['immoscout24']['realEstateId'] = 'Real Estate ID';
$GLOBALS['TL_LANG']['immoscout24']['title'] = 'Titel';
$GLOBALS['TL_LANG']['immoscout24']['createdAt'] = 'Angebot erstell am';
$GLOBALS['TL_LANG']['immoscout24']['modifiedAt'] = 'Angebot zuletzt bearbeitet';
$GLOBALS['TL_LANG']['immoscout24']['listed'] = 'Listed';
$GLOBALS['TL_LANG']['immoscout24']['descriptionNote'] = 'Objektbeschreibung';
$GLOBALS['TL_LANG']['immoscout24']['furnishingNote'] = 'Ausstattung';
$GLOBALS['TL_LANG']['immoscout24']['locationNote'] = 'Lage';
$GLOBALS['TL_LANG']['immoscout24']['otherNote'] = 'Sonstige Angaben';
$GLOBALS['TL_LANG']['immoscout24']['addressStreet'] = 'Straße';
$GLOBALS['TL_LANG']['immoscout24']['addressHouseNumber'] = 'Haus Nr.';
$GLOBALS['TL_LANG']['immoscout24']['addressCity'] = 'Stadt';
$GLOBALS['TL_LANG']['immoscout24']['addressZip'] = 'PLZ';
$GLOBALS['TL_LANG']['immoscout24']['addressLatitude'] = 'Latitude';
$GLOBALS['TL_LANG']['immoscout24']['addressLongitude'] = 'Longitude';
$GLOBALS['TL_LANG']['immoscout24']['price'] = 'Preis in €';
$GLOBALS['TL_LANG']['immoscout24']['numberOfFloors'] = 'Etagenzahl';
$GLOBALS['TL_LANG']['immoscout24']['numberOfRooms'] = 'Zimmerzahl';
$GLOBALS['TL_LANG']['immoscout24']['numberOfBathrooms'] = 'Badezimmer';
$GLOBALS['TL_LANG']['immoscout24']['numberOfBedrooms'] = 'Schlafzimmer';
$GLOBALS['TL_LANG']['immoscout24']['cellar'] = 'Keller';
$GLOBALS['TL_LANG']['immoscout24']['builtInKitchen'] = 'Einbauküche';
$GLOBALS['TL_LANG']['immoscout24']['balcony'] = 'Balkon/ Terasse';
$GLOBALS['TL_LANG']['immoscout24']['garden'] = 'Garten';
$GLOBALS['TL_LANG']['immoscout24']['guestToilet'] = 'Gäste WC';
$GLOBALS['TL_LANG']['immoscout24']['livingSpace'] = 'Wöhnfläche';
$GLOBALS['TL_LANG']['immoscout24']['totalFloorSpace'] = 'Gesamtfläche';
$GLOBALS['TL_LANG']['immoscout24']['netFloorSpace'] = 'Nutzfläche';
$GLOBALS['TL_LANG']['immoscout24']['usableFloorSpace'] = 'Nutzfläche';
$GLOBALS['TL_LANG']['immoscout24']['plotArea'] = 'Grundstücksfläche';
$GLOBALS['TL_LANG']['immoscout24']['lodgerFlat'] = 'Einliegerwohnung';
$GLOBALS['TL_LANG']['immoscout24']['summerResidencePractical'] = 'Als Ferienwohnung / Sommerresidenz geeignet'; // Als Sommerresidenz geeignet
$GLOBALS['TL_LANG']['immoscout24']['rented'] = 'Vermietet';
$GLOBALS['TL_LANG']['immoscout24']['rentalIncome'] = 'Mieteinnahmen';
$GLOBALS['TL_LANG']['immoscout24']['constructionYear'] = 'Baujahr';
$GLOBALS['TL_LANG']['immoscout24']['lastRefurbishment'] = 'Letzte Modernisierung';
$GLOBALS['TL_LANG']['immoscout24']['thermalCharacteristic'] = 'Energieverbrauchskennwert'; // Wärmeeigenschaften
$GLOBALS['TL_LANG']['immoscout24']['energyConsumptionContainsWarmWater'] = 'Energieverbrauch enthält Warmwasser';
$GLOBALS['TL_LANG']['immoscout24']['energyPerformanceCertificate'] = 'Energieausweis';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateEfficiencyClass'] = 'Effizienzklasse des Energieausweises';
$GLOBALS['TL_LANG']['immoscout24']['numberOfParkingSpaces'] = 'Garage/ Stellplatz';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpacePrice'] = 'Stellplatz Preis'; // Stellplatz Miete / Stellplatz Kaufpreis
$GLOBALS['TL_LANG']['immoscout24']['handicappedAccessible'] = 'Barrierefrei';
$GLOBALS['TL_LANG']['immoscout24']['courtage'] = 'Provisionspflichtig';
$GLOBALS['TL_LANG']['immoscout24']['courtageValue'] = 'Provisionsbetrag';
$GLOBALS['TL_LANG']['immoscout24']['courtageNote'] = 'Provisionshinweis';
$GLOBALS['TL_LANG']['immoscout24']['numberOfLifts'] = 'Aufzug';
$GLOBALS['TL_LANG']['immoscout24']['freeFromYear'] = 'Bezugsfrei ab'; // frei ab
$GLOBALS['TL_LANG']['immoscout24']['baseRent'] = 'Kaltmiete';
$GLOBALS['TL_LANG']['immoscout24']['totalRent'] = 'Warmmiete';
$GLOBALS['TL_LANG']['immoscout24']['heatingCosts'] = 'Heizkosten';
$GLOBALS['TL_LANG']['immoscout24']['heatingCostsInServiceCharge'] = 'Heizkosten sind in Nebenkosten enthalten';
$GLOBALS['TL_LANG']['immoscout24']['petsAllowed'] = 'Haustiere';
$GLOBALS['TL_LANG']['immoscout24']['basement'] = 'Keller';
$GLOBALS['TL_LANG']['immoscout24']['buildingPermission'] = 'Baugenehmigung';

// generic values
$GLOBALS['TL_LANG']['immoscout24']['none'] = '-';
$GLOBALS['TL_LANG']['immoscout24']['yes'] = 'Ja';
$GLOBALS['TL_LANG']['immoscout24']['no'] = 'Nein';

// enumerations
$GLOBALS['TL_LANG']['immoscout24']['objectType'] = 'Object Typ';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_REAL_ESTATE] = 'default';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_BUY] = 'Haus Kauf';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_RENT] = 'Haus Miete';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GARAGE_RENT] = 'Garage Miete';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GARAGE_BUY] = 'Garage Kauf';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SENIOR_CARE] = 'Altenpflege';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_ASSISTED_LIVING] = 'betreutes Wohnen';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_APARTMENT_RENT] = 'Wohnung Miete';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_APARTMENT_BUY] = 'Wohnung Kauf';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_COMPULSORY_AUCTION] = 'Zwangsversteigerung';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SHORT_TERM_ACCOMMODATION] = 'Wohnen auf Zeit';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_INVESTMENT] = 'Anlageobjekt';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_OFFICE] = 'Büro / Praxis';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_STORE] = 'Geschäft';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_GASTRONOMY] = 'Gastronomie / Hotel';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_INDUSTRY] = 'Halle';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_SPECIAL_PURPOSE] = 'Spezialgewerbe';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_LIVING_BUY_SITE] = 'Grundstück Kauf';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_LIVING_RENT_SITE] = 'Grundstück Miete';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_TRADE_SITE] = 'Gewerbegrundstück';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_HOUSE_TYPE] = 'Typenhaus';
$GLOBALS['TL_LANG']['immoscout24']['objectType_'][RE::OBJECT_TYPE_FLAT_SHARE_ROOM] = 'WG-Zimmer';

$GLOBALS['TL_LANG']['immoscout24']['state'] = 'Status';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_INACTIVE] = 'inactive';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_ACTIVE] = 'active';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_DRAFT] = 'draft';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_ARCHIVED] = 'archived';
$GLOBALS['TL_LANG']['immoscout24']['state_'][RE::STATUS_TO_BE_DELETED] = 'to be deleted';

$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType'] = 'Zahlungsintervall';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_ONE_TIME_CHARGE] = '
Einmalige Zahlung';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_DAY] = 'täglich';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_WEEK] = 'wöchentlich';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_MONTH] = 'montalich';
$GLOBALS['TL_LANG']['immoscout24']['priceIntervalType_'][RE::PRICE_INTERVAL_YEAR] = 'jährlich';

$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType'] = 'marketingType';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_PURCHASE] = 'Kauf';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_PURCHASE_PER_SQM] = 'Kauf pro m²';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT] = 'Miete';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT_PER_SQM] = 'Miete pro m²';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_LEASE] = 'Leasing';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_LEASEHOLD] = 'Pacht';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_BUDGET_RENT] = 'budget rent';
$GLOBALS['TL_LANG']['immoscout24']['priceMarketingType_'][RE::PRICE_MARKETING_TYPE_RENT_AND_BUY] = 'Kauf und Miete';

$GLOBALS['TL_LANG']['immoscout24']['buildingType'] = 'Haustyp'; //HausKategorie
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_BLOCKHOUSE] = 'Blockhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_BUNGALOW] = 'Bungalow';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SEMI_DETACHED_HOUSE] = 'Doppelhaushaelfte';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_ONE_FAMILY_HOUSE] = 'Einfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_FAMILY_HOUSE_WITH_LODGER_FLAT] = 'Einfamilienhaus mit Einliegerwohnung';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_TUDOR_HOUSE] = 'tudor house';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_WOODEN_HOUSE] = 'Holzhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_COUNTRY_HOUSE] = 'Landhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_APARTMENT_BUILDING] = 'Mehrfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_NON_DETACHED_HOUSE] = 'Reihenhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_CITY_VILLA] = 'city villa';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_VILLA] = 'Villa';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SEMI_DETACHED_HOUSE_PAIR] = 'Doppelhaushaelfte';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_SINGLE_FAMILY_HOUSE] = 'Einfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_MID_TERRACE_HOUSE] = 'Reihenmittelhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_END_TERRACE_HOUSE] = 'Reiheneckhaus';
$GLOBALS['TL_LANG']['immoscout24']['buildingType_'][RE::BUILDING_TYPE_MULTI_FAMILY_HOUSE] = 'Mehrfamilienhaus';

$GLOBALS['TL_LANG']['immoscout24']['constructionPhase'] = 'Bauphase';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_COMPLETED] = 'Haus fertig gestellt';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_PROJECTED] = 'Haus in Planung';
$GLOBALS['TL_LANG']['immoscout24']['constructionPhase_'][RE::CONSTRUCTION_PHASE_UNDER_CONSTRUCTION] = 'Haus im Bau';

$GLOBALS['TL_LANG']['immoscout24']['condition'] = 'Objektzustand';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FIRST_TIME_USE] = 'Erstbezug';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FIRST_TIME_USE_AFTER_REFURBISHMENT] = 'Erstbezug nach Sanierung';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_MINT_CONDITION] = 'Neuwertig';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_REFURBISHED] = 'Saniert';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_MODERNIZED] = 'Modernisiert';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_FULLY_RENOVATED] = 'VollstaendigReonviert';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_WELL_KEPT] = 'Gepflegt';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NEED_OF_RENOVATION] = 'Renovierungsbedürftig';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_NEGOTIABLE] = 'Nach Vereinbarung';
$GLOBALS['TL_LANG']['immoscout24']['condition_'][RE::CONDITION_RIPE_FOR_DEMOLITION] = 'Abbruchreif';

$GLOBALS['TL_LANG']['immoscout24']['interiorQuality'] = 'Qualität der Ausstattung';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_SIMPLE] = 'Einfach';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_NORMAL] = 'Normal';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_LUXURY] = 'Luxus';
$GLOBALS['TL_LANG']['immoscout24']['interiorQuality_'][RE::INTERIOR_QUALITY_SOPHISTICATED] = 'Gehoben';

$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014'] = 'Heizungsart (EnEV 2014)';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_SELF_CONTAINED_CENTRAL_HEATING] = 'Etagenheizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_STOVE_HEATING] = 'Ofenheizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_CENTRAL_HEATING] = 'Zentralheizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_COMBINED_HEAT_AND_POWER_PLANT] = 'cBlockheizkraftwerk';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_ELECTRIC_HEATING] = 'Elektro-Heizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_DISTRICT_HEATING] = 'Fernwärme';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_FLOOR_HEATING] = 'Fußbodenheizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_GAS_HEATING] = 'Gas-Heizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_WOOD_PELLET_HEATING] = 'Holz-Pelletheizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_NIGHT_STORAGE_HEATER] = 'Nachtspeicherofen';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_OIL_HEATING] = 'Öl-Heizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_SOLAR_HEATING] = 'Solar-Heizung';
$GLOBALS['TL_LANG']['immoscout24']['heatingTypeEnEV2014_'][RE::HEATING_TYPE_HEAT_PUMP] = 'Wärmepumpe';

$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType'] = 'Energieausweistyp';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_ENERGY_REQUIRED] = 'Endenergiebedarf';
$GLOBALS['TL_LANG']['immoscout24']['buildingEnergyRatingType_'][RE::ENERGY_RATING_TYPE_ENERGY_CONSUMPTION] = 'Energieverbrauchskennwert';

$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability'] = 'Energy Zertifikat';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_AVAILABLE] = 'available';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NOT_AVAILABLE_YET] = 'not available yet';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateAvailability_'][RE::ENERGY_CERTIFICATE_AVAILABILITY_NOT_REQUIRED] = 'not required';

$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate'] = 'Creation date of energy certificate';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_BEFORE_01_MAY_2014] = 'before May 1st, 2014';
$GLOBALS['TL_LANG']['immoscout24']['energyCertificateCreationDate_'][RE::ENERGY_CERTIFICATE_CREATION_DATE_FROM_01_MAY_2014] = 'after May 1st, 2014';

$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType'] = 'Parkplatz Typ';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_GARAGE] = 'Garage';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_OUTSIDE] = 'Außenstellplatz';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_CARPORT] = 'Carport';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_DUPLEX] = 'Duplex';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_CAR_PARK] = 'Parkhaus';
$GLOBALS['TL_LANG']['immoscout24']['parkingSpaceType_'][RE::PARKING_SPACE_TYPE_UNDERGROUND_GARAGE] = 'Tiefgarage';

$GLOBALS['TL_LANG']['immoscout24']['apartmentType'] = 'Wohnungskategorie';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_ROOF_STOREY] = 'Dachgeschoss';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_LOFT] = 'Loft';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_MAISONETTE] = 'Maisonette';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_PENTHOUSE] = 'Penthouse';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_TERRACED_FLAT] = 'Terrassenwohnung';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_GROUND_FLOOR] = 'Erdgeschosswohnung';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_APARTMENT] = 'Wohnung';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_RAISED_GROUND_FLOOR] = 'Hochparterre';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_HALF_BASEMENT] = 'Souterrain';
$GLOBALS['TL_LANG']['immoscout24']['apartmentType_'][RE::APARTMENT_TYPE_OTHER] = 'Sonstige';

$GLOBALS['TL_LANG']['immoscout24']['industryType'] = 'Objekttyp';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SHOWROOM_SPACE] = 'Ausstellungsfläche';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_HALL] = 'Halle';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_HIGH_LACK_STORAGE] = 'Hochregallager';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_INDUSTRY_HALL] = 'Industriehalle';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_INDUSTRY_HALL_WITH_OPEN_AREA] = 'Industrie Halle mit Freifläche';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_COLD_STORAGE] = 'Kühlhaus';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_MULTIDECK_CABINET_STORAGE] = 'Kühlregallager';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_WITH_OPEN_AREA] = 'Lager mit Freifläche';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_AREA] = 'Lagerfläche';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_STORAGE_HALL] = 'Lagerhalle';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SERVICE_AREA] = 'Servicefläche';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_SHIPPING_STORAGE] = 'Speditionslager';
$GLOBALS['TL_LANG']['immoscout24']['industryType_'][RE::INDUSTRY_TYPE_REPAIR_SHOP] = 'Werkstatt';

$GLOBALS['TL_LANG']['immoscout24']['investmentType'] = 'Anlagetyp';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SINGLE_FAMILY_HOUSE] = 'Einfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_MULTI_FAMILY_HOUSE] = 'Mehrfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_FREEHOLD_FLAT] = 'Eigentumswohnung';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SHOPPING_CENTRE] = 'Einkaufszentrum';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_RESTAURANT] = 'Restaurant';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HOTEL] = 'Hotel';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_LEISURE_FACILITY] = 'Freizeitanlage';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_UNIT] = 'Gewerbeeinheit';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_OFFICE_BUILDING] = 'Bürogebäude';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_BUILDING] = 'Geschäftshaus';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_COMMERCIAL_PROPERTY] = 'Gewerbeimmobilie';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HALL_STORAGE] = 'Halle/Lager)';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_INDUSTRIAL_PROPERTY] = 'Industrieanwesen';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SHOP_SALES_FLOOR] = 'Laden/Verkaufsfläche';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SERVICE_CENTRE] = 'Servicecenter';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_OTHER] = 'Sonstige';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_SUPERMARKET] = 'Supermarkt';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_LIVING_BUSINESS_HOUSE] = 'Wohn/Geschäftshaus';
$GLOBALS['TL_LANG']['immoscout24']['investmentType_'][RE::INVESTMENT_TYPE_HOUSING_ESTATE] = 'Wohnanlage';

$GLOBALS['TL_LANG']['immoscout24']['officeType'] = 'Bürotyp';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_LOFT] = 'Loft';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_STUDIO] = 'Atelier';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE] = 'Buero';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_FLOOR] = 'Buero Etage';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_BUILDING] = 'Buerohaus';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_CENTRE] = 'Buerozentrum';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_STORAGE_BUILDING] = 'Buero und Lager Gebäude';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY] = 'Praxis';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY_FLOOR] = 'Praxis Etage';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_SURGERY_BUILDING] = 'Praxis Haus';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_COMMERCIAL_CENTRE] = 'GewerbeZentrum';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_LIVING_AND_COMMERCIAL_BUILDING] = 'Wohn und Geschäftsgebäude';
$GLOBALS['TL_LANG']['immoscout24']['officeType_'][RE::OFFICE_TYPE_OFFICE_AND_COMMERCIAL_BUILDING] = 'Büro und Geschäftsgebäude';

$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration'] = 'Office rent duration';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::OFFICE_RENT_DURATION_NO_INFORMATION] = 'no information';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_WEEKLY] = 'weekly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_MONTHLY] = 'monthly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_YEARLY] = 'yearly';
$GLOBALS['TL_LANG']['immoscout24']['officeRentDuration_'][RE::FLAG__OFFICE_RENT_DURATION_LONG_TERM] = 'long term';

$GLOBALS['TL_LANG']['immoscout24']['garageType'] = 'Garagentyp';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_NO_INFORMATION] = 'keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_GARAGE] = 'Garage';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_STREET_PARKING] = 'Aussenstellplatz';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_CARPORT] = 'Carport';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_DUPLEX] = 'Duplex';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_CAR_PARK] = 'Parkhaus';
$GLOBALS['TL_LANG']['immoscout24']['garageType_'][RE::GARAGE_TYPE_UNDERGROUND_GARAGE] = 'Tiefgarage';

$GLOBALS['TL_LANG']['immoscout24']['commercializationType'] = 'Vermarktungsart';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_NO_INFORMATION] = 'Keine Angeabe';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_BUY] = 'Kauf';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_RENT] = 'Miete';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_LEASE] = 'Leasing';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_LEASEHOLD] = 'Pacht';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_COMPULSORY_AUCTION] = 'Zwangsversteigerung';
$GLOBALS['TL_LANG']['immoscout24']['commercializationType_'][RE::COMMERCIALIZATION_TYPE_RENT_AND_BUY] = 'Kauf und Miete';

$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse'] = 'Empfohlene Nutzungsarten';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::RECOMMENDED_USE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FUTURE_DEVELOPMENT_LAND] = 'Bauerwartungsland';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_TWINHOUSE] = 'Doppelhaus';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_SINGLE_FAMILY_HOUSE] = 'Einfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_GARAGE] = 'Garagen';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_GARDEN] = 'Garten';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_NO_DEVELOPMENT] = 'Keine Bebauung';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_APARTMENT_BUILDING] = 'Mehrfamilienhaus';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_ORCHARD] = 'Obstpflanzung';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_TERRACE_HOUSE] = 'Reihenhaus';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_PARKING_SPACE] = 'Stellplaetze';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_VILLA] = 'Villa';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FORREST] = 'Wald';
$GLOBALS['TL_LANG']['immoscout24']['recommendedSiteUse_'][RE::FLAG__RECOMMENDED_USE_FARMLAND] = 'Ackerland';

$GLOBALS['TL_LANG']['immoscout24']['storeType'] = 'Ladentyp';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SHOWROOM_SPACE] = 'Ausstellungsflaeche';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SHOPPING_CENTRE] = 'Einkaufszentrum';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_FACTORY_OUTLET] = 'FactoryOutlet';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_DEPARTMENT_STORE] = 'Kaufhaus';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_KIOSK] = 'Kiosk';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_STORE] = 'Laden';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SELF_SERVICE_MARKET] = 'SB Markt';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SALES_AREA] = 'Verkaufsflaeche';
$GLOBALS['TL_LANG']['immoscout24']['storeType_'][RE::STORE_TYPE_SALES_HALL] = 'Verkaufshalle';

$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization'] = 'Grundstückskategorie';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_NO_INFORMATION] = 'Keine Angabe';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_LEISURE] = 'Freizeit';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_AGRICULTURE_FORESTRY] = 'Land / Forstwirtschaft';
$GLOBALS['TL_LANG']['immoscout24']['tradeSiteUtilization_'][RE::TRADE_SITE_UTILIZATION_TRADE] = 'Gewerbe';
