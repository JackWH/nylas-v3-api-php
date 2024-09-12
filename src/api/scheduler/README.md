# OpenAPIClient-php

Scheduler v3 is a [public beta release](https:///docs/support/product-lifecycle/#beta-release). It is generally stable, but some features might be added or changed before it is generally available.
This API reference documentation covers the **Nylas Scheduler API**. See the see the [<b>Administration API documentation</b>](https:///docs/api/v3/admin/) for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.

Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.


## Installation & Usage

### Requirements

PHP 8.1 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure Bearer authorization: bearerAuth
$config = JackWH\NylasV3\Scheduler\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\Scheduler\Api\V3GrantsGrantIdSchedulingConfigurationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$grant_id = {{grant_id}}; // string | (Required) ID of the grant to access. Use `/me/` to refer to the grant associated with an access token.
$accept = application/json; // string
$limit = 50; // int | The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information.
$page_token = {{page_token}}; // string | An identifier that specifies which page of data to return. You can get this value from the `next_cursor` response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information.

try {
    $result = $apiInstance->v3GrantsGrantIdSchedulingConfigurationsGet($grant_id, $accept, $limit, $page_token);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling V3GrantsGrantIdSchedulingConfigurationsApi->v3GrantsGrantIdSchedulingConfigurationsGet: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*V3GrantsGrantIdSchedulingConfigurationsApi* | [**v3GrantsGrantIdSchedulingConfigurationsGet**](docs/Api/V3GrantsGrantIdSchedulingConfigurationsApi.md#v3grantsgrantidschedulingconfigurationsget) | **GET** /v3/grants/{grant_id}/scheduling/configurations | Return all Configuration objects
*V3GrantsGrantIdSchedulingConfigurationsApi* | [**v3GrantsGrantIdSchedulingConfigurationsPost**](docs/Api/V3GrantsGrantIdSchedulingConfigurationsApi.md#v3grantsgrantidschedulingconfigurationspost) | **POST** /v3/grants/{grant_id}/scheduling/configurations | Create a Configuration object
*V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi* | [**v3GrantsGrantIdSchedulingConfigurationsConfigurationIdDelete**](docs/Api/V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi.md#v3grantsgrantidschedulingconfigurationsconfigurationiddelete) | **DELETE** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Delete a Configuration object
*V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi* | [**v3GrantsGrantIdSchedulingConfigurationsConfigurationIdGet**](docs/Api/V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi.md#v3grantsgrantidschedulingconfigurationsconfigurationidget) | **GET** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Return a Configuration object
*V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi* | [**v3GrantsGrantIdSchedulingConfigurationsConfigurationIdPut**](docs/Api/V3GrantsGrantIdSchedulingConfigurationsConfigurationIdApi.md#v3grantsgrantidschedulingconfigurationsconfigurationidput) | **PUT** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Update a Configuration object
*V3SchedulingApi* | [**v3SchedulingAvailabilityGet**](docs/Api/V3SchedulingApi.md#v3schedulingavailabilityget) | **GET** /v3/scheduling/availability | Get Availability
*V3SchedulingBookingsApi* | [**v3SchedulingBookingsPost**](docs/Api/V3SchedulingBookingsApi.md#v3schedulingbookingspost) | **POST** /v3/scheduling/bookings | Book an event
*V3SchedulingBookingsBookingIdApi* | [**v3SchedulingBookingsBookingIdDelete**](docs/Api/V3SchedulingBookingsBookingIdApi.md#v3schedulingbookingsbookingiddelete) | **DELETE** /v3/scheduling/bookings/{booking_id} | Delete a booking
*V3SchedulingBookingsBookingIdApi* | [**v3SchedulingBookingsBookingIdGet**](docs/Api/V3SchedulingBookingsBookingIdApi.md#v3schedulingbookingsbookingidget) | **GET** /v3/scheduling/bookings/{booking_id} | Return a Booking object
*V3SchedulingBookingsBookingIdApi* | [**v3SchedulingBookingsBookingIdPatch**](docs/Api/V3SchedulingBookingsBookingIdApi.md#v3schedulingbookingsbookingidpatch) | **PATCH** /v3/scheduling/bookings/{booking_id} | Reschedule a booking
*V3SchedulingBookingsBookingIdApi* | [**v3SchedulingBookingsBookingIdPut**](docs/Api/V3SchedulingBookingsBookingIdApi.md#v3schedulingbookingsbookingidput) | **PUT** /v3/scheduling/bookings/{booking_id} | Confirm a booking
*V3SchedulingSessionsApi* | [**v3SchedulingSessionsPost**](docs/Api/V3SchedulingSessionsApi.md#v3schedulingsessionspost) | **POST** /v3/scheduling/sessions | Create a session
*V3SchedulingSessionsApi* | [**v3SchedulingSessionsSessionIdDelete**](docs/Api/V3SchedulingSessionsApi.md#v3schedulingsessionssessioniddelete) | **DELETE** /v3/scheduling/sessions/{session_id} | Delete a session

## Models


## Authorization

### bearerAuth

- **Type**: Bearer authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Generator version: `7.8.0`
- Build package: `org.openapitools.codegen.languages.PhpNextgenClientCodegen`
