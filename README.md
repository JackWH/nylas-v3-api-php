# Nylas V3 API for PHP

PHP API clients for the [Nylas V3 API](https://developer.nylas.com/docs/v3/).

> This is an experimental package and is not officially endorsed by Nylas. I've released this as their PHP SDK [is no longer actively maintained](https://github.com/nylas/nylas-php?tab=readme-ov-file#note-the-nylas-php-sdk-is-currently-not-actively-maintained-and-may-need-some-tlc-however-our-ruby-node-or-python-sdks-are-fully-supported), and the only other PHP clients available are for V2. Please refer to the notes below for how the API clients were generated.

## Installation and Usage

Install the project using Composer:

```bash
composer require "jackwh/nylas-v3-api-php":"dev-main"
```

You can then use the relevant API clients like so:

```php
use JackWH\NylasV3;

$accessToken = '**********';
$grantId     = '##########';

$api = new NylasV3\EmailCalendar\Api\CalendarApi(
    new \GuzzleHttp\Client(),
    NylasV3\EmailCalendar\Configuration::getDefaultConfiguration()->setAccessToken($accessToken)
);

$result = $api->getCalendars($grantId, limit: 10);
```

In this example you'll receive back a `NylasV3\EmailCalendar\Model\GetCalendars200Response` object, with entries mapped to `NylasV3\EmailCalendar\Model\Calendar` objects. When converted to JSON the output will look something like this:

```json
{
    "request_id": "17262346...",
    "data": [
        {
            "name": "My Calendar",
            "timezone": "Europe\/London",
            "hex_color": "#0e61b9",
            "hex_foreground_color": "#ffffff",
            "grant_id": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            "id": "example.com_vj9230@group.calendar.google.com",
            "object": "calendar",
            "is_primary": false,
            "read_only": false,
            "is_owned_by_user": true
        },
        {
            "description": "Holidays and Observances in United Kingdom",
            "name": "Holidays in United Kingdom",
            "timezone": "Europe\/London",
            "hex_color": "#711a76",
            "hex_foreground_color": "#ffffff",
            "grant_id": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            "id": "en.uk#holiday@group.v.calendar.google.com",
            "object": "calendar",
            "is_primary": false,
            "read_only": true,
            "is_owned_by_user": false
        }
    ],
    "next_cursor": "EiIKDAj..."
}
```

## About This Repository

As there's no official v3 API client for PHP, I've done my best to semi-automatically generate this one. There were a few hoops to jump through, I'm sure there must be an easier/simpler way to do this (if anybody knows, please explain!). Here's how I went about it...

1. Export [OpenAPI specs](https://developer.nylas.com/docs/api/v3/scheduler/) from Nylas' documentation for each API, and save to `api_specs/yaml`.
2. Take the YAML specs and [convert them to JSON](https://onlineyamltools.com/convert-yaml-to-json), place these alongside the originals in `api_specs/yaml`. 
3. Due to a [bug in the PHP OpenAPI generator](https://github.com/OpenAPITools/openapi-generator/issues/3136), we need to [dereference `$ref` pointers](https://github.com/APIDevTools/json-schema-ref-parser) using the `npm` script below. This calls the `api_specs/utilities/dereference-json.js` script, which recursively dereferences all `$ref` pointers in each JSON OpenAPI spec. The final JSON specs are saved to `api_specs`:

```bash
npm run dereference-json
```

4. Finally we can generate client code for each of the APIs using the [OpenAPI Generator](https://openapi-generator.tech):

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/administration/ \
  -i api_specs/administration.json \
  --openapi-normalizer REF_AS_PARENT_IN_ALLOF=true,REFACTOR_ALLOF_WITH_PROPERTIES_ONLY=true,REMOVE_ANYOF_ONEOF_AND_KEEP_PROPERTIES_ONLY=true \
  --invoker-package="JackWH\\NylasV3\\Administration" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/email-calendar/ \
  -i api_specs/email-calendar.json \
  --openapi-normalizer REF_AS_PARENT_IN_ALLOF=true,REFACTOR_ALLOF_WITH_PROPERTIES_ONLY=true,REMOVE_ANYOF_ONEOF_AND_KEEP_PROPERTIES_ONLY=true \
  --invoker-package="JackWH\\NylasV3\\EmailCalendar" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/scheduler/ \
  -i api_specs/scheduler.json \
  --openapi-normalizer REF_AS_PARENT_IN_ALLOF=true,REFACTOR_ALLOF_WITH_PROPERTIES_ONLY=true,REMOVE_ANYOF_ONEOF_AND_KEEP_PROPERTIES_ONLY=true \
  --invoker-package="JackWH\\NylasV3\\Scheduler" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```

## Changes to the OpenAPI spec

Any small changes I've made to the OpenAPI specs since first generating the clients are detailed below:

- `email-calendar.yaml`:
  - Remove `"minItems": *"` constraints from Event `participants` and Draft `to` arrays, as the generated client was throwing `InvalidArgumentException`s when trying to serialize these objects. (I assume this was an error from the original spec.)
