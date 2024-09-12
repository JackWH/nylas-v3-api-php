# Nylas V3 API for PHP

PHP API clients for the [Nylas V3 API](https://developer.nylas.com/docs/v3/).

> This is an experimental package and is not officially endorsed by Nylas. I set this up after seeing their PHP SDK [is no longer actively maintained](https://github.com/nylas/nylas-php?tab=readme-ov-file#note-the-nylas-php-sdk-is-currently-not-actively-maintained-and-may-need-some-tlc-however-our-ruby-node-or-python-sdks-are-fully-supported), and other PHP integrations remain on the v2 API.

## Installation and Usage

```bash
composer require "jackwh/nylas-v3-api-php":"dev-main"
```

To use the API clients, include the relevant client class and instantiate it with your Nylas API key:

```php
    // todo...
```

## Generating the API clients

If you just want to use the API, you can skip this section. The notes below explain how to re-generate the API clients again in future from the OpenAPI specs. (There's probably a better way of doing this, maybe someone can let me know how!)

- The OpenAPI specs in `api_specs/openapi` were auto-generated via [Nylas' Postman Collections](https://www.postman.com/trynylas/nylas-api).
- If the API changes, the specs will need to be updated from Postman's JSON exports by [converting to YAML](https://p2o.defcon007.com/) then back to JSON.
- PHP client code in `src/api` is generated using the [OpenAPI Generator](https://openapi-generator.tech).

From the project root, run these commands to generate the three API clients:

```bash
openapi-generator generate -g php-nextgen \
  -o src/api/administration/ \
  -i api_specs/openapi/administration.json \
  --invoker-package="JackWH\\NylasV3\\Administration" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```
  
```bash
openapi-generator generate -g php-nextgen \
  -o src/api/email-calendar/ \
  -i api_specs/openapi/email-calendar.json \
  --invoker-package="JackWH\\NylasV3\\EmailCalendar" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```
  
```bash
openapi-generator generate -g php-nextgen \
  -o src/api/scheduler/ \
  -i api_specs/openapi/scheduler.json \
  --invoker-package="JackWH\\NylasV3\\Scheduler" \
  --additional-properties=composerPackageName="jackwh/nylas-v3-api-php",variableNamingConvention="snake_case"
```
