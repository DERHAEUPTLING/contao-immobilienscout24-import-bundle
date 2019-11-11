<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Entity;

use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24Api;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24ApiMapperTrait;
use Derhaeuptling\ContaoImmoscout24\Synchronizer\ItemAlreadyUpToDateException;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository")
 * @ORM\Table(name="tl_immoscout24_real_estate")
 */
class RealEstate extends DcaDefault
{
    use Immoscout24ApiMapperTrait;

    public const OBJECT_TYPE_REAL_ESTATE = 0;
    public const OBJECT_TYPE_HOUSE_BUY = 1;
    public const OBJECT_TYPE_HOUSE_RENT = 2;
    public const OBJECT_TYPE_GARAGE_RENT = 3;
    public const OBJECT_TYPE_GARAGE_BUY = 4;
    public const OBJECT_TYPE_SENIOR_CARE = 5;
    public const OBJECT_TYPE_ASSISTED_LIVING = 6;
    public const OBJECT_TYPE_APARTMENT_RENT = 7;
    public const OBJECT_TYPE_APARTMENT_BUY = 8;
    public const OBJECT_TYPE_COMPULSORY_AUCTION = 9;
    public const OBJECT_TYPE_SHORT_TERM_ACCOMMODATION = 10;
    public const OBJECT_TYPE_INVESTMENT = 11;
    public const OBJECT_TYPE_OFFICE = 12;
    public const OBJECT_TYPE_STORE = 13;
    public const OBJECT_TYPE_GASTRONOMY = 14;
    public const OBJECT_TYPE_INDUSTRY = 15;
    public const OBJECT_TYPE_SPECIAL_PURPOSE = 16;
    public const OBJECT_TYPE_LIVING_BUY_SITE = 17;
    public const OBJECT_TYPE_LIVING_RENT_SITE = 18;
    public const OBJECT_TYPE_TRADE_SITE = 19;
    public const OBJECT_TYPE_HOUSE_TYPE = 20;
    public const OBJECT_TYPE_FLAT_SHARE_ROOM = 21;

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DRAFT = 2;
    public const STATUS_ARCHIVED = 3;
    public const STATUS_TO_BE_DELETED = 4;

    public const PRICE_INTERVAL_ONE_TIME_CHARGE = 0;
    public const PRICE_INTERVAL_DAY = 1;
    public const PRICE_INTERVAL_WEEK = 2;
    public const PRICE_INTERVAL_MONTH = 3;
    public const PRICE_INTERVAL_YEAR = 4;

    public const PRICE_MARKETING_TYPE_PURCHASE = 0;
    public const PRICE_MARKETING_TYPE_PURCHASE_PER_SQM = 1;
    public const PRICE_MARKETING_TYPE_RENT = 2;
    public const PRICE_MARKETING_TYPE_RENT_PER_SQM = 3;
    public const PRICE_MARKETING_TYPE_LEASE = 4;
    public const PRICE_MARKETING_TYPE_LEASEHOLD = 5;
    public const PRICE_MARKETING_TYPE_BUDGET_RENT = 6;
    public const PRICE_MARKETING_TYPE_RENT_AND_BUY = 7;

    public const BUILDING_TYPE_NO_INFORMATION = 0;
    public const BUILDING_TYPE_BLOCKHOUSE = 1;
    public const BUILDING_TYPE_BUNGALOW = 2;
    public const BUILDING_TYPE_SEMI_DETACHED_HOUSE = 3;
    public const BUILDING_TYPE_ONE_FAMILY_HOUSE = 4;
    public const BUILDING_TYPE_FAMILY_HOUSE_WITH_LODGER_FLAT = 5;
    public const BUILDING_TYPE_TUDOR_HOUSE = 6;
    public const BUILDING_TYPE_WOODEN_HOUSE = 7;
    public const BUILDING_TYPE_COUNTRY_HOUSE = 8;
    public const BUILDING_TYPE_APARTMENT_BUILDING = 9;
    public const BUILDING_TYPE_NON_DETACHED_HOUSE = 10;
    public const BUILDING_TYPE_CITY_VILLA = 11;
    public const BUILDING_TYPE_VILLA = 12;
    public const BUILDING_TYPE_SEMI_DETACHED_HOUSE_PAIR = 13;

    public const CONSTRUCTION_PHASE_NO_INFORMATION = 0;
    public const CONSTRUCTION_PHASE_COMPLETED = 1;
    public const CONSTRUCTION_PHASE_PROJECTED = 2;
    public const CONSTRUCTION_PHASE_UNDER_CONSTRUCTION = 3;

    public const CONDITION_NO_INFORMATION = 0;
    public const CONDITION_FIRST_TIME_USE = 1;
    public const CONDITION_FIRST_TIME_USE_AFTER_REFURBISHMENT = 2;
    public const CONDITION_MINT_CONDITION = 3;
    public const CONDITION_REFURBISHED = 4;
    public const CONDITION_MODERNIZED = 5;
    public const CONDITION_FULLY_RENOVATED = 6;
    public const CONDITION_WELL_KEPT = 7;
    public const CONDITION_NEED_OF_RENOVATION = 8;
    public const CONDITION_NEGOTIABLE = 9;
    public const CONDITION_RIPE_FOR_DEMOLITION = 10;

    public const INTERIOR_QUALITY_NO_INFORMATION = 0;
    public const INTERIOR_QUALITY_SIMPLE = 1;
    public const INTERIOR_QUALITY_NORMAL = 2;
    public const INTERIOR_QUALITY_LUXURY = 3;
    public const INTERIOR_QUALITY_SOPHISTICATED = 4;

    public const HEATING_TYPE_NO_INFORMATION = 0;
    public const HEATING_TYPE_SELF_CONTAINED_CENTRAL_HEATING = 1;
    public const HEATING_TYPE_STOVE_HEATING = 2;
    public const HEATING_TYPE_CENTRAL_HEATING = 3;
    public const HEATING_TYPE_COMBINED_HEAT_AND_POWER_PLANT = 4;
    public const HEATING_TYPE_ELECTRIC_HEATING = 5;
    public const HEATING_TYPE_DISTRICT_HEATING = 6;
    public const HEATING_TYPE_FLOOR_HEATING = 7;
    public const HEATING_TYPE_GAS_HEATING = 8;
    public const HEATING_TYPE_WOOD_PELLET_HEATING = 9;
    public const HEATING_TYPE_NIGHT_STORAGE_HEATER = 10;
    public const HEATING_TYPE_OIL_HEATING = 11;
    public const HEATING_TYPE_SOLAR_HEATING = 12;
    public const HEATING_TYPE_HEAT_PUMP = 13;

    public const ENERGY_RATING_TYPE_NO_INFORMATION = 0;
    public const ENERGY_RATING_TYPE_ENERGY_REQUIRED = 1;
    public const ENERGY_RATING_TYPE_ENERGY_CONSUMPTION = 2;

    public const ENERGY_CERTIFICATE_AVAILABILITY_NO_INFORMATION = 0;
    public const ENERGY_CERTIFICATE_AVAILABILITY_AVAILABLE = 1;
    public const ENERGY_CERTIFICATE_AVAILABILITY_NOT_AVAILABLE_YET = 2;
    public const ENERGY_CERTIFICATE_AVAILABILITY_NOT_REQUIRED = 3;

    public const ENERGY_CERTIFICATE_CREATION_DATE_NO_INFORMATION = 0;
    public const ENERGY_CERTIFICATE_CREATION_DATE_BEFORE_01_MAY_2014 = 1;
    public const ENERGY_CERTIFICATE_CREATION_DATE_FROM_01_MAY_2014 = 2;

    public const PARKING_SPACE_TYPE_NO_INFORMATION = 0;
    public const PARKING_SPACE_TYPE_GARAGE = 1;
    public const PARKING_SPACE_TYPE_OUTSIDE = 3;
    public const PARKING_SPACE_TYPE_CARPORT = 4;
    public const PARKING_SPACE_TYPE_DUPLEX = 5;
    public const PARKING_SPACE_TYPE_CAR_PARK = 6;
    public const PARKING_SPACE_TYPE_UNDERGROUND_GARAGE = 7;

    /**
     * @ORM\Column(name="object_type", type="smallint")
     * @Immoscout24Api(name="_object_type", mandatory=true, enum={
     *      "realestates.realEstate" = RealEstate::OBJECT_TYPE_REAL_ESTATE,
     *      "realestates.houseBuy" = RealEstate::OBJECT_TYPE_HOUSE_BUY,
     *      "realestates.houseRent" = RealEstate::OBJECT_TYPE_HOUSE_RENT,
     *      "realestates.garageRent" = RealEstate::OBJECT_TYPE_GARAGE_RENT,
     *      "realestates.garageBuy" = RealEstate::OBJECT_TYPE_GARAGE_BUY,
     *      "realestates.seniorCare" = RealEstate::OBJECT_TYPE_SENIOR_CARE,
     *      "realestates.assistedLiving" = RealEstate::OBJECT_TYPE_ASSISTED_LIVING,
     *      "realestates.apartmentRent" = RealEstate::OBJECT_TYPE_APARTMENT_RENT,
     *      "realestates.apartmentBuy" = RealEstate::OBJECT_TYPE_APARTMENT_BUY,
     *      "realestates.compulsoryAuction" = RealEstate::OBJECT_TYPE_COMPULSORY_AUCTION,
     *      "realestates.shortTermAccommodation" = RealEstate::OBJECT_TYPE_SHORT_TERM_ACCOMMODATION ,
     *      "realestates.investment" = RealEstate::OBJECT_TYPE_INVESTMENT ,
     *      "realestates.office" = RealEstate::OBJECT_TYPE_OFFICE ,
     *      "realestates.store" = RealEstate::OBJECT_TYPE_STORE ,
     *      "realestates.gastronomy" = RealEstate::OBJECT_TYPE_GASTRONOMY ,
     *      "realestates.industry" = RealEstate::OBJECT_TYPE_INDUSTRY ,
     *      "realestates.specialPurpose" = RealEstate::OBJECT_TYPE_SPECIAL_PURPOSE ,
     *      "realestates.livingBuySite" = RealEstate::OBJECT_TYPE_LIVING_BUY_SITE ,
     *      "realestates.livingRentSite" = RealEstate::OBJECT_TYPE_LIVING_RENT_SITE ,
     *      "realestates.tradeSite" = RealEstate::OBJECT_TYPE_TRADE_SITE ,
     *      "realestates.houseType" = RealEstate::OBJECT_TYPE_HOUSE_TYPE ,
     *      "realestates.flatShareRoom" = RealEstate::OBJECT_TYPE_FLAT_SHARE_ROOM
     * })
     *
     * @var int
     */
    public $objectType = self::OBJECT_TYPE_REAL_ESTATE;

    /**
     * @ORM\Column(name="state", type="smallint")
     * @Immoscout24Api(name="realEstateState", mandatory=true, enum={
     *      "INACTIVE" = RealEstate::STATUS_INACTIVE,
     *      "ACTIVE" = RealEstate::STATUS_ACTIVE,
     *      "DRAFT" = RealEstate::STATUS_DRAFT,
     *      "ARCHIVED" = RealEstate::STATUS_ARCHIVED,
     *      "TO_BE_DELETED" = RealEstate::STATUS_TO_BE_DELETED
     * })
     *
     * @var int
     */
    public $state = self::STATUS_INACTIVE;

    /**
     * @ORM\Column(name="listed", type="boolean", nullable=true)
     * @Immoscout24Api(name="listed", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $listed;

    /**
     * @ORM\Column(name="description_note", type="text")
     * @Immoscout24Api(name="descriptionNote")
     *
     * @var string
     */
    public $descriptionNote = '';

    /**
     * @ORM\Column(name="furnishing_note", type="text")
     * @Immoscout24Api(name="furnishingNote")
     *
     * @var string
     */
    public $furnishingNote = '';

    /**
     * @ORM\Column(name="location_note", type="text")
     * @Immoscout24Api(name="locationNote")
     *
     * @var string
     */
    public $locationNote = '';

    /**
     * @ORM\Column(name="other_note", type="text")
     * @Immoscout24Api(name="otherNote")
     *
     * @var string
     */
    public $otherNote = '';

    /**
     * @ORM\Column(name="address_street")
     * @Immoscout24Api(name="address::street")
     *
     * @var string
     */
    public $addressStreet = '';

    /**
     * @ORM\Column(name="address_house_number")
     * @Immoscout24Api(name="address::houseNumber")
     *
     * @var string
     */
    public $addressHouseNumber = '';

    /**
     * @ORM\Column(name="address_zip")
     * @Immoscout24Api(name="address::postcode")
     *
     * @var string
     */
    public $addressZip = '';

    /**
     * @ORM\Column(name="address_city")
     * @Immoscout24Api(name="address::city")
     *
     * @var string
     */
    public $addressCity = '';

    /**
     * @ORM\Column(name="address_latitude", type="decimal", precision=10, scale=8, nullable=true)
     * @Immoscout24Api(name="address::wgs84Coordinate::latitude")
     *
     * @var ?float
     */
    public $addressLatitude;

    /**
     * @ORM\Column(name="address_longitude", type="decimal", precision=11, scale=8, nullable=true)
     * @Immoscout24Api(name="address::wgs84Coordinate::longitude")
     *
     * @var ?float
     */
    public $addressLongitude;

    /**
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     * @Immoscout24Api(name="price::value")
     *
     * @var ?float
     */
    public $price;

    /**
     * @ORM\Column(name="price_interval_type", type="integer")
     * @Immoscout24Api(name="price::priceIntervalType", enum={
     *      "ONE_TIME_CHARGE" = RealEstate::PRICE_INTERVAL_ONE_TIME_CHARGE,
     *      "DAY" = RealEstate::PRICE_INTERVAL_DAY,
     *      "WEEK" = RealEstate::PRICE_INTERVAL_WEEK,
     *      "MONTH" = RealEstate::PRICE_INTERVAL_MONTH,
     *      "YEAR" = RealEstate::PRICE_INTERVAL_YEAR
     * })
     *
     * @var int
     */
    public $priceIntervalType = self::PRICE_INTERVAL_ONE_TIME_CHARGE;

    /**
     * @ORM\Column(name="price_marketing_type", type="integer")
     * @Immoscout24Api(name="price::marketingType", enum={
     *      "PURCHASE" = RealEstate::PRICE_MARKETING_TYPE_PURCHASE,
     *      "PURCHASE_PER_SQM" = RealEstate::PRICE_MARKETING_TYPE_PURCHASE_PER_SQM,
     *      "RENT" = RealEstate::PRICE_MARKETING_TYPE_RENT,
     *      "RENT_PER_SQM" = RealEstate::PRICE_MARKETING_TYPE_RENT_PER_SQM,
     *      "LEASE" = RealEstate::PRICE_MARKETING_TYPE_LEASE,
     *      "LEASEHOLD" = RealEstate::PRICE_MARKETING_TYPE_LEASEHOLD,
     *      "BUDGET_RENT" = RealEstate::PRICE_MARKETING_TYPE_BUDGET_RENT,
     *      "RENT_AND_BUY" = RealEstate::PRICE_MARKETING_TYPE_RENT_AND_BUY
     * })
     *
     * @var int
     */
    public $priceMarketingType = self::PRICE_MARKETING_TYPE_PURCHASE;

    /**
     * @ORM\Column(name="number_of_floors", type="integer", nullable=true)
     * @Immoscout24Api(name="numberOfFloors")
     *
     * @var ?int
     */
    public $numberOfFloors;

    /**
     * @ORM\Column(name="number_of_rooms", type="integer", nullable=true)
     * @Immoscout24Api(name="numberOfRooms")
     *
     * @var ?int
     */
    public $numberOfRooms;

    /**
     * @ORM\Column(name="number_of_bathrooms", type="integer", nullable=true)
     * @Immoscout24Api(name="numberOfBathRooms")
     *
     * @var ?int
     */
    public $numberOfBathrooms;

    /**
     * @ORM\Column(name="number_of_bedrooms", type="integer", nullable=true)
     * @Immoscout24Api(name="numberOfBedRooms")
     *
     * @var ?int
     */
    public $numberOfBedrooms;

    /**
     * @ORM\Column(name="cellar", type="boolean", nullable=true)
     * @Immoscout24Api(name="cellar", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $cellar;

    /**
     * @ORM\Column(name="built_in_kitchen", type="boolean", nullable=true)
     * @Immoscout24Api(name="builtInKitchen", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $builtInKitchen;

    /**
     * @ORM\Column(name="balcony", type="boolean", nullable=true)
     * @Immoscout24Api(name="balcony", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $balcony;

    /**
     * @ORM\Column(name="garden", type="boolean", nullable=true)
     * @Immoscout24Api(name="garden", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $garden;

    /**
     * @ORM\Column(name="guest_toilet", type="boolean", nullable=true)
     * @Immoscout24Api(name="guestToilet", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $guestToilet;

    /**
     * @ORM\Column(name="living_space", type="float", nullable=true)
     * @Immoscout24Api(name="livingSpace")
     *
     * @var ?float
     */
    public $livingSpace;

    /**
     * @ORM\Column(name="plot_area", type="float", nullable=true)
     * @Immoscout24Api(name="plotArea")
     *
     * @var ?float
     */
    public $plotArea;

    /**
     * @ORM\Column(name="building_type", type="smallint")
     * @Immoscout24Api(name="buildingType", enum={
     *      "NO_INFORMATION" = RealEstate::BUILDING_TYPE_NO_INFORMATION,
     *      "BLOCKHOUSE" = RealEstate::BUILDING_TYPE_BLOCKHOUSE,
     *      "BUNGALOW" = RealEstate::BUILDING_TYPE_BUNGALOW,
     *      "SEMI_DETACHED_HOUSE" = RealEstate::BUILDING_TYPE_SEMI_DETACHED_HOUSE,
     *      "ONE_FAMILY_HOUSE" = RealEstate::BUILDING_TYPE_ONE_FAMILY_HOUSE,
     *      "FAMILY_HOUSE_WITH_LODGER_FLAT" = RealEstate::BUILDING_TYPE_FAMILY_HOUSE_WITH_LODGER_FLAT,
     *      "TUDOR_HOUSE" = RealEstate::BUILDING_TYPE_TUDOR_HOUSE,
     *      "WOODEN_HOUSE" = RealEstate::BUILDING_TYPE_WOODEN_HOUSE,
     *      "COUNTRY_HOUSE" = RealEstate::BUILDING_TYPE_COUNTRY_HOUSE,
     *      "APARTMENT_BUILDING" = RealEstate::BUILDING_TYPE_APARTMENT_BUILDING,
     *      "NON_DETACHED_HOUSE" = RealEstate::BUILDING_TYPE_NON_DETACHED_HOUSE,
     *      "CITY_VILLA" = RealEstate::BUILDING_TYPE_CITY_VILLA ,
     *      "VILLA" = RealEstate::BUILDING_TYPE_VILLA,
     *      "SEMI_DETACHED_HOUSE_PAIR" = RealEstate::BUILDING_TYPE_SEMI_DETACHED_HOUSE_PAIR
     * })
     *
     * @var int
     */
    public $buildingType = self::BUILDING_TYPE_NO_INFORMATION;

    /**
     * @ORM\Column(name="lodger_flat", type="boolean", nullable=true)
     * @Immoscout24Api(name="lodgerFlat", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $lodgerFlat;

    /**
     * @ORM\Column(name="summer_residence_practical", type="boolean", nullable=true)
     * @Immoscout24Api(name="summerResidencePractical", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $summerResidencePractical;

    /**
     * @ORM\Column(name="rented", type="boolean", nullable=true)
     * @Immoscout24Api(name="summerResidencePractical", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $rented;

    /**
     * @ORM\Column(name="rental_income", type="decimal", nullable=true)
     * @Immoscout24Api(name="rentalIncome")
     *
     * @var ?float
     */
    public $rentalIncome;

    /**
     * @ORM\Column(name="construction_year", type="integer", nullable=true)
     * @Immoscout24Api(name="constructionYear")
     *
     * @var ?int
     */
    public $constructionYear;

    /**
     * @ORM\Column(name="construction_phase", type="smallint")
     * @Immoscout24Api(name="ConstructionPhase", enum={
     *      "NO_INFORMATION" = RealEstate::CONSTRUCTION_PHASE_NO_INFORMATION,
     *      "COMPLETED" = RealEstate::CONSTRUCTION_PHASE_COMPLETED,
     *      "PROJECTED" = RealEstate::CONSTRUCTION_PHASE_PROJECTED,
     *      "UNDER_CONSTRUCTION" = RealEstate::CONSTRUCTION_PHASE_UNDER_CONSTRUCTION
     * })
     *
     * @var int
     */
    public $constructionPhase = self::CONSTRUCTION_PHASE_NO_INFORMATION;

    /**
     * @ORM\Column(name="last_refurbishment", type="integer", nullable=true)
     * @Immoscout24Api(name="lastRefurbishment")
     *
     * @var ?int
     */
    public $lastRefurbishment;

    /**
     * @ORM\Column(name="building_condition", type="smallint")
     * @Immoscout24Api(name="condition", enum={
     *      "NO_INFORMATION" = RealEstate::CONDITION_NO_INFORMATION,
     *      "FIRST_TIME_USE" = RealEstate::CONDITION_FIRST_TIME_USE,
     *      "FIRST_TIME_USE_AFTER_REFURBISHMENT" = RealEstate::CONDITION_FIRST_TIME_USE_AFTER_REFURBISHMENT,
     *      "MINT_CONDITION" = RealEstate::CONDITION_MINT_CONDITION,
     *      "REFURBISHED" = RealEstate::CONDITION_REFURBISHED,
     *      "MODERNIZED" = RealEstate::CONDITION_MODERNIZED,
     *      "FULLY_RENOVATED" = RealEstate::CONDITION_FULLY_RENOVATED,
     *      "WELL_KEPT" = RealEstate::CONDITION_WELL_KEPT,
     *      "NEED_OF_RENOVATION" = RealEstate::CONDITION_NEED_OF_RENOVATION,
     *      "NEGOTIABLE" = RealEstate::CONDITION_NEGOTIABLE,
     *      "RIPE_FOR_DEMOLITION" = RealEstate::CONDITION_RIPE_FOR_DEMOLITION
     * })
     *
     * @var int
     */
    public $condition = self::CONDITION_NO_INFORMATION;

    /**
     * @ORM\Column(name="interior_quality", type="smallint")
     * @Immoscout24Api(name="interiorQuality", enum={
     *      "NO_INFORMATION" = RealEstate::INTERIOR_QUALITY_NO_INFORMATION,
     *      "SIMPLE" = RealEstate::INTERIOR_QUALITY_SIMPLE,
     *      "NORMAL" = RealEstate::INTERIOR_QUALITY_NORMAL,
     *      "LUXURY" = RealEstate::INTERIOR_QUALITY_LUXURY,
     *      "SOPHISTICATED" = RealEstate::INTERIOR_QUALITY_SOPHISTICATED
     * })
     *
     * @var int
     */
    public $interiorQuality = self::INTERIOR_QUALITY_NO_INFORMATION;

    /**
     * @ORM\Column(name="heating_type_enev2014", type="smallint")
     * @Immoscout24Api(name="heatingTypeEnev2014", enum={
     *      "NO_INFORMATION" = RealEstate::HEATING_TYPE_NO_INFORMATION,
     *      "SELF_CONTAINED_CENTRAL_HEATING" = RealEstate::HEATING_TYPE_SELF_CONTAINED_CENTRAL_HEATING,
     *      "STOVE_HEATING" = RealEstate::HEATING_TYPE_STOVE_HEATING,
     *      "CENTRAL_HEATING" = RealEstate::HEATING_TYPE_CENTRAL_HEATING,
     *      "COMBINED_HEAT_AND_POWER_PLANT" = RealEstate::HEATING_TYPE_COMBINED_HEAT_AND_POWER_PLANT,
     *      "ELECTRIC_HEATING" = RealEstate::HEATING_TYPE_ELECTRIC_HEATING,
     *      "DISTRICT_HEATING" = RealEstate::HEATING_TYPE_DISTRICT_HEATING,
     *      "FLOOR_HEATING" = RealEstate::HEATING_TYPE_FLOOR_HEATING,
     *      "GAS_HEATING" = RealEstate::HEATING_TYPE_GAS_HEATING,
     *      "WOOD_PELLET_HEATING" = RealEstate::HEATING_TYPE_WOOD_PELLET_HEATING,
     *      "NIGHT_STORAGE_HEATER" = RealEstate::HEATING_TYPE_NIGHT_STORAGE_HEATER ,
     *      "OIL_HEATING" = RealEstate::HEATING_TYPE_OIL_HEATING ,
     *      "SOLAR_HEATING" = RealEstate::HEATING_TYPE_SOLAR_HEATING ,
     *      "HEAT_PUMP" = RealEstate::HEATING_TYPE_HEAT_PUMP
     * })
     *
     * @var int
     */
    public $heatingTypeEnEV2014 = self::HEATING_TYPE_NO_INFORMATION;

    /**
     * @ORM\Column(name="building_energy_rating_type", type="smallint")
     * @Immoscout24Api(name="buildingEnergyRatingType", enum={
     *      "NO_INFORMATION" = RealEstate::ENERGY_RATING_TYPE_NO_INFORMATION,
     *      "ENERGY_REQUIRED" = RealEstate::ENERGY_RATING_TYPE_ENERGY_REQUIRED,
     *      "ENERGY_CONSUMPTION" = RealEstate::ENERGY_RATING_TYPE_ENERGY_CONSUMPTION
     * })
     *
     * @var int
     */
    public $buildingEnergyRatingType = self::ENERGY_RATING_TYPE_NO_INFORMATION;

    /**
     * @ORM\Column(name="energy_certificate_availability", type="smallint")
     * @Immoscout24Api(name="energyCertificate::energyCertificateAvailability", enum={
     *      "NO_INFORMATION" = RealEstate::ENERGY_CERTIFICATE_AVAILABILITY_NO_INFORMATION,
     *      "AVAILABLE" = RealEstate::ENERGY_CERTIFICATE_AVAILABILITY_AVAILABLE,
     *      "NOT_AVAILABLE_YET" = RealEstate::ENERGY_CERTIFICATE_AVAILABILITY_NOT_AVAILABLE_YET,
     *      "NOT_REQUIRED" = RealEstate::ENERGY_CERTIFICATE_AVAILABILITY_NOT_REQUIRED
     * })
     *
     * @var int
     */
    public $energyCertificateAvailability = self::ENERGY_CERTIFICATE_AVAILABILITY_NO_INFORMATION;

    /**
     * @ORM\Column(name="energy_certificate_creation_date", type="smallint")
     * @Immoscout24Api(name="energyCertificate::energyCertificateCreationDate", enum={
     *      "NOT_APPLICABLE" = RealEstate::ENERGY_CERTIFICATE_CREATION_DATE_NO_INFORMATION,
     *      "BEFORE_01_MAY_2014" = RealEstate::ENERGY_CERTIFICATE_CREATION_DATE_BEFORE_01_MAY_2014,
     *      "FROM_01_MAY_2014" = RealEstate::ENERGY_CERTIFICATE_CREATION_DATE_FROM_01_MAY_2014
     * })
     *
     * @var int
     */
    public $energyCertificateCreationDate = self::ENERGY_CERTIFICATE_CREATION_DATE_NO_INFORMATION;

    /**
     * @ORM\Column(name="energy_certificate_efficiency_class")
     * @Immoscout24Api(name="energyCertificate::energyEfficiencyClass")
     *
     * @var string
     */
    public $energyCertificateEfficiencyClass = '';

    /**
     * @ORM\Column(name="thermal_characteristic", type="float", nullable=true)
     * @Immoscout24Api(name="thermalCharacteristic")
     *
     * @var ?float
     */
    public $thermalCharacteristic;

    /**
     * @ORM\Column(name="energy_consumption_contains_warm_water", type="boolean", nullable=true)
     * @Immoscout24Api(name="energyConsumptionContainsWarmWater", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $energyConsumptionContainsWarmWater;

    /**
     * @ORM\Column(name="energy_performance_certificate", type="boolean", nullable=true)
     * @Immoscout24Api(name="energyPerformanceCertificate", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $energyPerformanceCertificate;

    /**
     * @ORM\Column(name="number_of_parking_spaces", type="integer", nullable=true)
     * @Immoscout24Api(name="numberOfParkingSpaces")
     *
     * @var ?int
     */
    public $numberOfParkingSpaces;

    /**
     * @ORM\Column(name="parking_space_type", type="smallint")
     * @Immoscout24Api(name="parkingSpaceType", enum={
     *      "NO_INFORMATION" = RealEstate::PARKING_SPACE_TYPE_NO_INFORMATION,
     *      "GARAGE" = RealEstate::PARKING_SPACE_TYPE_GARAGE,
     *      "OUTSIDE" = RealEstate::PARKING_SPACE_TYPE_OUTSIDE,
     *      "CARPORT" = RealEstate::PARKING_SPACE_TYPE_CARPORT,
     *      "DUPLEX" = RealEstate::PARKING_SPACE_TYPE_DUPLEX,
     *      "CAR_PARK" = RealEstate::PARKING_SPACE_TYPE_CAR_PARK,
     *      "UNDERGROUND_GARAGE" = RealEstate::PARKING_SPACE_TYPE_UNDERGROUND_GARAGE
     * })
     *
     * @var int
     */
    public $parkingSpaceType = self::PARKING_SPACE_TYPE_NO_INFORMATION;

    /**
     * @ORM\Column(name="parking_space_price", type="decimal", precision=10, scale=2, nullable=true)
     * @Immoscout24Api(name="parkingSpacePrice")
     *
     * @var ?float
     */
    public $parkingSpacePrice;

    /**
     * @ORM\Column(name="handicapped_accessible", type="boolean", nullable=true)
     * @Immoscout24Api(name="handicappedAccessible", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $handicappedAccessible;

    /**
     * @ORM\Column(name="courtage", type="boolean", nullable=true)
     * @Immoscout24Api(name="courtage::hasCourtage", enum={
     *      "YES" = true,
     *      "NO" = false,
     *      "NOT_APPLICABLE" = null
     * })
     *
     * @var ?bool
     */
    public $courtage;

    /**
     * @ORM\Column(name="courtage_value")
     * @Immoscout24Api(name="courtage::courtage")
     *
     * @var string
     */
    public $courtageValue = '';

    /**
     * @ORM\Column(name="courtage_note")
     * @Immoscout24Api(name="courtage::courtageNote")
     *
     * @var string
     */
    public $courtageNote = '';

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * [manually mapped]
     *
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @ORM\Column(name="modified_at", type="datetime")
     * [manually mapped]
     *
     * @var \DateTime
     */
    public $modifiedAt;

    /**
     * @ORM\Column(name="real_estate_id", unique=true)
     * @Immoscout24Api(name="@id", mandatory=true)
     *
     * @var string
     */
    public $realEstateId = '';

    /**
     * @ORM\Column(name="title")
     * @Immoscout24Api(name="title")
     *
     * @var string
     */
    public $title = '';

    /**
     * @ORM\ManyToOne(targetEntity="Derhaeuptling\ContaoImmoscout24\Entity\Account", inversedBy="realEstates")
     * @ORM\JoinColumn(name="immoscout24_account", referencedColumnName="id", onDelete="CASCADE")
     * [manually mapped]
     *
     * @var Account
     */
    private $immoscoutAccount;

    /**
     * @ORM\OneToMany(targetEntity="Derhaeuptling\ContaoImmoscout24\Entity\Attachment", mappedBy="realEstate", cascade={"persist", "remove"})
     *
     * @var Collection|Attachment[]
     */
    private $attachments;

    /**
     * RealEstate constructor.
     */
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    /**
     * @throws AnnotationException
     *
     * @return RealEstate|null
     */
    public static function createFromApiResponse(array $data, Account $account): ?self
    {
        $realEstate = new self();

        // manually mapped values
        $realEstate->immoscoutAccount = $account;
        $realEstate->createdAt = self::getDateTime($data['creationDate'] ?? '');
        $realEstate->modifiedAt = self::getDateTime($data['lastModificationDate'] ?? '', $realEstate->createdAt);

        // todo: arrays
        // firingTypes
        // energySourcesEnEV2014

        // automatically mapped values
        if (self::autoMap($realEstate, $data)) {
            return $realEstate;
        }

        return null;
    }

    /**
     * @throws ItemAlreadyUpToDateException
     */
    public function mergeInto(self $existing, EntityManagerInterface $entityManager): void
    {
        if ($this->realEstateId !== $existing->realEstateId) {
            throw new \RuntimeException('Cannot merge items with different real estate ids.');
        }

        if ($existing->modifiedAt >= $this->modifiedAt) {
            throw new ItemAlreadyUpToDateException($existing->modifiedAt, $this->modifiedAt);
        }

        $entityManager->detach($existing);

        // take the existing item's id, but overwrite everything else
        $this->id = $existing->id;
        $entityManager->merge($this);
    }

    public function getImmoscoutAccount(): Account
    {
        return $this->immoscoutAccount;
    }

    public function getRealEstateId(): string
    {
        return $this->realEstateId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getObjectType(): int
    {
        return $this->objectType;
    }

    /**
     * @param Attachment[] $attachments
     */
    public function setAttachments(array $attachments): void
    {
        $this->attachments = new ArrayCollection($attachments);
    }

    /**
     * Get the first picture attachment which is tagged as 'title picture'.
     */
    public function getTitlePictureAttachment(): ?Attachment
    {
        $titleImages = array_filter(
            $this->attachments->toArray(),
            static function (Attachment $attachment) {
                return
                    Attachment::CONTENT_READY === $attachment->getState() &&
                    $attachment->isTitlePicture();
            }
        );

        return $titleImages[0] ?? null;
    }

    /**
     * Get an array of picture attachments.
     *
     * @return Attachment[]
     */
    public function getPictureAttachments(bool $skipFloorPlans = true, bool $skipTitlePicture = true): array
    {
        return array_filter(
            $this->attachments->toArray(),
            static function (Attachment $attachment) use ($skipFloorPlans, $skipTitlePicture) {
                return
                    Attachment::CONTENT_READY === $attachment->getState() &&
                    !($skipFloorPlans && $attachment->isFloorPlan()) &&
                    !($skipTitlePicture && $attachment->isTitlePicture());
            }
        );
    }

    /**
     * Get an array of picture attachments which are tagged as 'floor plan'.
     *
     * @return Attachment[]
     */
    public function getFloorPlanAttachments(): array
    {
        return array_filter(
            $this->attachments->toArray(),
            static function (Attachment $attachment) {
                return
                    Attachment::CONTENT_READY === $attachment->getState() &&
                    $attachment->isFloorPlan();
            }
        );
    }
}
