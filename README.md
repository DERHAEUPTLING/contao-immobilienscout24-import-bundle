## Immoscout24 Import for Contao

This bundle allows you to import real estate objects from Immoscout24 into your
Contao application (4.8+) and display them as native content.

**Warning**: This bundle is still under development - use at your own risk. There
             are some things missing or only partially implemented including the
             real estate object's attachment resolution that has to be done in a
             separate API request or custom filtering. Also, there is currently
             only an english language file present.

## How to get going

### Setup
 1. Install the bundle and update your database. There is no further
    configuration necessary.    
    ```bash
    composer require derhaeuptling/contao-immobilienscout24-import-bundle
    ```
 
 2. Add at least one `Immoscout24 Account` in the backend and enter your API
    credentials.
    
 3. Setup a cron job that executes the `immoscout24:sync` command or run it
    yourself to import real estate objects from the API into your application.
    You can pass an account's id or description as a parameter to only sync
    this one account and `--dry-run` to only see what would be updated without
    persisting the changes.   
 
 4. Add one or more Immoscout24 modules in your theme and use it in the frontend:
    - The **Real estate list** displays a list of real estate objects. If you
      want to generate a teaser list with 'read more' links, make sure to
      specify a 'jump to' page with the appropriate reader. 
            
    - The **Real estate reader** displays a single real estate object based on
      the url parameter (id).
      

### Templates and values
The real estate listings contain lots of fields - most likely you'll want to
adapt the templates to your needs and only output some of the fields. To do
this, there are some helpers for your convenience.

A) Real estate data comes in the form of an **entity instance**, you can type hint
against it to get IDE auto-completion in your templates: 
```php
  /** var Derhaeuptling\ContaoImmoscout24\Entity\RealEstate $realEstate */
  $realEstate
```  

B) You can also obtain a **list of all available attributes**:
```php
  $this->attributes

  // array [name => label] of publicly accessible fields of the real estate objects 
  // e.g. 'descriptionNote' that can be accessed via $realEstate->descriptionNote
```
    
C) To **retrieve and format data**, you can use these helper functions:    
```php
  $this->hasData(RealEstate $realEstate, string $attribute) : bool
  // will return wether $realEstate holds data for the $attribute 
         
  $this->getFormatted(RealEstate $realEstate, string $attribute) : string
  // will return the formatted value of $attribute - enumerations, dates and
  // booleans will resolved to a string representation based on the language
  // files
```

D) If you want to resolve enumerations yourself you can find all of them as
public constants in the `RealEstate` entity.
