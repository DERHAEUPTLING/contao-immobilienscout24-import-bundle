## Immoscout24 Import for Contao

This bundle allows you to import real estate objects from Immoscout24 into your
Contao application (4.8+) and display them as native content.

**Warning**: This is an early release. There might be features missing. Use at your
             own risk.

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
    persisting the changes. Use the option `--purge` to clear the database
    table and all downloaded files completely beforehand.

 4. We are using Contao's Virtual Filesystem feature. If you also want to adjust
    where the downloaded attachments should be stored, simply mount the
    `immoscout24` directory at another place. See the [Contao developer docs](https://docs.contao.org/dev/framework/filesystem/config/)
    for more information about this topic.

 5. Add one or more Immoscout24 modules in your theme and use it in the frontend:
    - The **Real estate list** displays a list of real estate objects. If you
      want to generate a teaser list with 'read more' links, make sure to
      specify a 'jump to' page with the appropriate reader.

    - The **Real estate reader** displays a single real estate object based on
      the url parameter (id).

    - List items can be constrained individually by using a filter expression.\
      Some filter expression examples:
      - one object by its ID `realEstateId == 111111111`
      - some objects by its IDs `realEstateId in [111111111,222222222,333333333]`
      - all active objects `state ==  STATUS_ACTIVE `
      - all objects published to the homepage channel `'Homepage' in publishChannels`
      - all objects with empty API-Searchfield1 `apiSearchData1 != null`
      - all objects that match a KEYWORD in the title field `title matches "/KEYWORD/"`
      - combine filter `'Homepage' in publishChannels` && `priceMarketingType == "Kauf"`


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

Some enumeration values can occur multiple times per value. In this case
they are implemented as binary flags:
```php
  FLAG__TYPE_A = 1;
  FLAG__TYPE_B = 2;
  FLAG__TYPE_C = 4;
  FLAG__TYPE_D = 8;
  FLAG__TYPE_E = 16;

  // n-of-value selecting 'type A' and 'type E'
  $value = -(FLAG__TYPE_A | FLAG__TYPE_E); // = 17
```
Note that flagged values are stored as **negative numbers**, so that they can
easily be differentiated from regular enumeration values.

### Attachments
Real estate objects can have multiple attachments. Note: that currently only images
are supported attachment types.

To render an attachment (as an image) you can utilize the `getFigureFromAttachment()`
function present in the templates. It allows passing in an alternative image size as
second argument:
```php
  $figure = $this->getFigureFromAttachment($realEstate->getTitlePictureAttachment());

  $figure = $this->getFigureFromAttachment(
      $realEstate->getTitlePictureAttachment(),
      $this->alternativeImageSize
  );
```

To output the `Figure`, pass its data to the template you want render. In case of the
legacy `image` template, make sure to expand the image data beforehand by calling
`getLegacyTemplateData()`:
```php
  $this->insert('image', $titlePictureFigure->getLegacyTemplateData());
```

Here is the full example how to output the title picture with the default image size
in a failure-tolerant way:
```php
    <div>
        <h2>Title Picture</h2>
        <?php if(null !== ($titlePictureFigure = $this->getFigureFromAttachment($this->realEstate->getTitlePictureAttachment()))): ?>
            <?php $this->insert('image', $titlePictureFigure->getLegacyTemplateData()) ?>
        <?php else: ?>
            <span>There is no title picture.</span>
        <?php endif; ?>
    </div>
```
