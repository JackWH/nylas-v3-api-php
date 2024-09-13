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

// ...

$accessToken = 'nyk_v0_xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$grantId     = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';

$api = new NylasV3\EmailCalendar\Api\V3GrantsGrantIdCalendarsApi(
    new \GuzzleHttp\Client(),
    NylasV3\EmailCalendar\Configuration::getDefaultConfiguration()->setAccessToken($accessToken)
);

$result = $api->returnAllCalendars($grantId, limit: 10);

// ...
```

When converted to JSON, `$result` looks something like this:

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

1. Export [Nylas' Postman Collections](https://www.postman.com/trynylas/nylas-api) to JSON.
2. Convert Postman's JSON files to YAML OpenAPI specs using [Postman2OpenAPI](https://p2o.defcon007.com/).
3. Convert the YAML OpenAPI specs [to JSON](https://onlineyamltools.com/convert-yaml-to-json) again (yes really).
4. Normalize the JSON-format OpenAPI specs using the [JSON Canonicalization Scheme](https://www.rfc-editor.org/rfc/rfc8785).
5. Use the normalized JSON OpenAPI specs to automatically add missing `operationID` fields. This is necessary as the OpenAPI Generator requires `operationId` fields in order to name client methods. Without these, method names are derived from the full API path and were far too verbose. Here's how I did this at the time using a utility script:

```php
/** Helper function to write an operationId from a path summary (e.g. "Return all calendars" --> returnAllCalendars) */
$generateOperationIds = fn(Collection $data) => $data->put(
    'paths',
    Collection::wrap($data->get('paths'))->mapWithKeys(fn(array $path, string $pathName) => [
        $pathName => collect($path)->mapWithKeys(fn(array $operation, string $operationName) => [
            $operationName => collect($operation)->put(
                'operationId',
                str($operation['summary'])->camel()->toString()
            )->all(),
        ])->all(),
    ])->all()
)->toArray();

// Overwrite the original spec with the new one, which now includes operationIds:
$originalSpec = file_get_contents('administration.json');
$data = collect(json_decode($originalSpec, true, 512, JSON_THROW_ON_ERROR));
$specWithOperationIds = $generateOperationIds($data);
file_put_contents('administration.json', $specWithOperationIds);
```

6. Finally, generate client code for each of the APIs using the [OpenAPI Generator](https://openapi-generator.tech):

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/administration/ \
  -i api_specs/administration.yaml \
  --invoker-package="JackWH\\NylasV3\\Administration" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/email-calendar/ \
  -i api_specs/email-calendar.yaml \
  --openapi-normalizer REF_AS_PARENT_IN_ALLOF=true,REFACTOR_ALLOF_WITH_PROPERTIES_ONLY=true,REMOVE_ANYOF_ONEOF_AND_KEEP_PROPERTIES_ONLY=true \
  --invoker-package="JackWH\\NylasV3\\EmailCalendar" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/scheduler/ \
  -i api_specs/scheduler.yaml \
  --invoker-package="JackWH\\NylasV3\\Scheduler" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```
