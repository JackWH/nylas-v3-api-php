# OpenAPIClient-php

<div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Nylas Scheduler API</strong>. See the see the <strong><a href=\"/docs/api/v3/admin/\">Administration API documentation</a></strong> for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.</div>

The **Nylas Scheduler API** is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.

## Updating objects

`PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.

Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.

## Nylas Postman collection

You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas Scheduler API. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).

## Scheduler documentation

You can find more information about Scheduler in the main documentation set:

- [Scheduler overview](/docs/v3/scheduler/)
- [Scheduler Quickstart guide](/docs/v3/quickstart/scheduler/)

## Nylas v3 encoding

Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.


For more information, please visit [https://www.nylas.com/](https://www.nylas.com/).

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



// Configure Bearer (Session ID) authorization: SCHEDULER_SESSION_TOKEN
$config = JackWH\NylasV3\Scheduler\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\Scheduler\Api\AvailabilityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$start_time = 'start_time_example'; // string | A Unix timestamp for the start time to check availability for.
$end_time = 'end_time_example'; // string | A Unix timestamp for the end time to check availability for.
$configuration_id = 'configuration_id_example'; // string | The ID of the Configuration object whose settings are used for calculating availability. If you're using session authentication (`requires_session_auth` is set to `true`), `configuration_id` is not required.
$slug = 'slug_example'; // string | The slug of the Configuration object. You can use this with the `client_id` instead of using the `configuration_id`. If you're using session authentication (`requires_session_auth` is set to `true`) or using the `configuration_id`, `slug` is not required.
$client_id = 'client_id_example'; // string | The client ID that was used to create the Configuration object. `client_id` is required only if you're using `slug`.
$booking_id = 'booking_id_example'; // string | This is the ID of the booking to reschedule, if you are checking availability to reschedule a round-robin booking. Required only if `availability_method` is `max-fairness` or `max-availability`. See [Retrieving booking IDs](/docs/v3/scheduler/retrieve-booking-ids/) for more information.

try {
    $result = $apiInstance->getAvailability($start_time, $end_time, $configuration_id, $slug, $client_id, $booking_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AvailabilityApi->getAvailability: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AvailabilityApi* | [**getAvailability**](docs/Api/AvailabilityApi.md#getavailability) | **GET** /v3/scheduling/availability | Get Availability
*BookingsApi* | [**deleteBookingsId**](docs/Api/BookingsApi.md#deletebookingsid) | **DELETE** /v3/scheduling/bookings/{booking_id} | Delete a booking
*BookingsApi* | [**getBookingsId**](docs/Api/BookingsApi.md#getbookingsid) | **GET** /v3/scheduling/bookings/{booking_id} | Return a Booking object
*BookingsApi* | [**patchBookingsId**](docs/Api/BookingsApi.md#patchbookingsid) | **PATCH** /v3/scheduling/bookings/{booking_id} | Reschedule a booking
*BookingsApi* | [**postBookings**](docs/Api/BookingsApi.md#postbookings) | **POST** /v3/scheduling/bookings | Book an event
*BookingsApi* | [**putBookingsId**](docs/Api/BookingsApi.md#putbookingsid) | **PUT** /v3/scheduling/bookings/{booking_id} | Confirm a booking
*ConfigurationsApi* | [**deleteConfigurationsId**](docs/Api/ConfigurationsApi.md#deleteconfigurationsid) | **DELETE** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Delete a Configuration object
*ConfigurationsApi* | [**getConfigurations**](docs/Api/ConfigurationsApi.md#getconfigurations) | **GET** /v3/grants/{grant_id}/scheduling/configurations | Return all Configuration objects
*ConfigurationsApi* | [**getConfigurationsId**](docs/Api/ConfigurationsApi.md#getconfigurationsid) | **GET** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Return a Configuration object
*ConfigurationsApi* | [**postConfigurations**](docs/Api/ConfigurationsApi.md#postconfigurations) | **POST** /v3/grants/{grant_id}/scheduling/configurations | Create a Configuration object
*ConfigurationsApi* | [**putConfigurationsId**](docs/Api/ConfigurationsApi.md#putconfigurationsid) | **PUT** /v3/grants/{grant_id}/scheduling/configurations/{configuration_id} | Update a configuration
*SessionsApi* | [**deleteSession**](docs/Api/SessionsApi.md#deletesession) | **DELETE** /v3/scheduling/sessions/{session_id} | Delete a session
*SessionsApi* | [**postSessions**](docs/Api/SessionsApi.md#postsessions) | **POST** /v3/scheduling/sessions | Create a session

## Models

- [AvailabilityBuffer](docs/Model/AvailabilityBuffer.md)
- [AvailabilityResponse](docs/Model/AvailabilityResponse.md)
- [AvailabilityTimeSlot](docs/Model/AvailabilityTimeSlot.md)
- [Booking](docs/Model/Booking.md)
- [BookingConfirm](docs/Model/BookingConfirm.md)
- [BookingCreate](docs/Model/BookingCreate.md)
- [BookingUpdate](docs/Model/BookingUpdate.md)
- [Buffer](docs/Model/Buffer.md)
- [CommonResponse](docs/Model/CommonResponse.md)
- [CommonResponseWithCursor](docs/Model/CommonResponseWithCursor.md)
- [Configuration](docs/Model/Configuration.md)
- [ConfigurationAppearance](docs/Model/ConfigurationAppearance.md)
- [ConfigurationAvailability](docs/Model/ConfigurationAvailability.md)
- [ConfigurationAvailabilityOpenHours](docs/Model/ConfigurationAvailabilityOpenHours.md)
- [ConfigurationAvailabilityRules](docs/Model/ConfigurationAvailabilityRules.md)
- [ConfigurationEventBooking](docs/Model/ConfigurationEventBooking.md)
- [ConfigurationParticipants](docs/Model/ConfigurationParticipants.md)
- [ConfigurationParticipantsAvailability](docs/Model/ConfigurationParticipantsAvailability.md)
- [ConfigurationParticipantsBooking](docs/Model/ConfigurationParticipantsBooking.md)
- [ConfigurationScheduler](docs/Model/ConfigurationScheduler.md)
- [ConfigurationSchedulerAdditionalFields](docs/Model/ConfigurationSchedulerAdditionalFields.md)
- [ConfigurationSchedulerEmailTemplate](docs/Model/ConfigurationSchedulerEmailTemplate.md)
- [ConfigurationSchedulerEmailTemplateBookingConfirmed](docs/Model/ConfigurationSchedulerEmailTemplateBookingConfirmed.md)
- [ConfirmBookingResponse](docs/Model/ConfirmBookingResponse.md)
- [DeleteBookingsIdRequest](docs/Model/DeleteBookingsIdRequest.md)
- [DeleteConfigurationsId200Response](docs/Model/DeleteConfigurationsId200Response.md)
- [DeleteSession200Response](docs/Model/DeleteSession200Response.md)
- [Error](docs/Model/Error.md)
- [Error1](docs/Model/Error1.md)
- [Error1Error](docs/Model/Error1Error.md)
- [ErrorError](docs/Model/ErrorError.md)
- [EventConferencingRequest](docs/Model/EventConferencingRequest.md)
- [GetAvailability200Response](docs/Model/GetAvailability200Response.md)
- [GetAvailability200ResponseAllOfData](docs/Model/GetAvailability200ResponseAllOfData.md)
- [GetConfigurations200Response](docs/Model/GetConfigurations200Response.md)
- [GetConfigurations200ResponseAllOfDataInner](docs/Model/GetConfigurations200ResponseAllOfDataInner.md)
- [GetConfigurations200ResponseAllOfDataInnerAppearanceValue](docs/Model/GetConfigurations200ResponseAllOfDataInnerAppearanceValue.md)
- [GetConfigurations200ResponseAllOfDataInnerAvailability](docs/Model/GetConfigurations200ResponseAllOfDataInnerAvailability.md)
- [GetConfigurations200ResponseAllOfDataInnerAvailabilityAvailabilityRules](docs/Model/GetConfigurations200ResponseAllOfDataInnerAvailabilityAvailabilityRules.md)
- [GetConfigurations200ResponseAllOfDataInnerEventBooking](docs/Model/GetConfigurations200ResponseAllOfDataInnerEventBooking.md)
- [GetConfigurations200ResponseAllOfDataInnerEventBookingConferencing](docs/Model/GetConfigurations200ResponseAllOfDataInnerEventBookingConferencing.md)
- [GetConfigurations200ResponseAllOfDataInnerParticipantsInner](docs/Model/GetConfigurations200ResponseAllOfDataInnerParticipantsInner.md)
- [GetConfigurations200ResponseAllOfDataInnerParticipantsInnerAvailability](docs/Model/GetConfigurations200ResponseAllOfDataInnerParticipantsInnerAvailability.md)
- [GetConfigurations200ResponseAllOfDataInnerParticipantsInnerBooking](docs/Model/GetConfigurations200ResponseAllOfDataInnerParticipantsInnerBooking.md)
- [GetConfigurations200ResponseAllOfDataInnerScheduler](docs/Model/GetConfigurations200ResponseAllOfDataInnerScheduler.md)
- [GetConfigurations200ResponseAllOfDataInnerSchedulerAdditionalFieldsValue](docs/Model/GetConfigurations200ResponseAllOfDataInnerSchedulerAdditionalFieldsValue.md)
- [GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate](docs/Model/GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate.md)
- [GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplateBookingConfirmed](docs/Model/GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplateBookingConfirmed.md)
- [OpenHours](docs/Model/OpenHours.md)
- [PatchBookingsId200Response](docs/Model/PatchBookingsId200Response.md)
- [PatchBookingsIdRequest](docs/Model/PatchBookingsIdRequest.md)
- [PostBookings200Response](docs/Model/PostBookings200Response.md)
- [PostBookings200ResponseAllOfData](docs/Model/PostBookings200ResponseAllOfData.md)
- [PostBookings200ResponseAllOfDataOrganizer](docs/Model/PostBookings200ResponseAllOfDataOrganizer.md)
- [PostBookingsRequest](docs/Model/PostBookingsRequest.md)
- [PostBookingsRequestAdditionalGuestsInner](docs/Model/PostBookingsRequestAdditionalGuestsInner.md)
- [PostBookingsRequestGuest](docs/Model/PostBookingsRequestGuest.md)
- [PostBookingsRequestParticipantsInner](docs/Model/PostBookingsRequestParticipantsInner.md)
- [PostConfigurations200Response](docs/Model/PostConfigurations200Response.md)
- [PostSessions200Response](docs/Model/PostSessions200Response.md)
- [PostSessions200ResponseAllOfData](docs/Model/PostSessions200ResponseAllOfData.md)
- [PostSessionsRequest](docs/Model/PostSessionsRequest.md)
- [PutBookingsId200Response](docs/Model/PutBookingsId200Response.md)
- [PutBookingsIdRequest](docs/Model/PutBookingsIdRequest.md)
- [TimeSlot](docs/Model/TimeSlot.md)

## Authorization

### ACCESS_TOKEN

- **Type**: Bearer authentication (Access token)


### NYLAS_API_KEY

- **Type**: Bearer authentication (API key)


### SCHEDULER_SESSION_TOKEN

- **Type**: Bearer authentication (Session ID)

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v3`
    - Generator version: `7.8.0`
- Build package: `org.openapitools.codegen.languages.PhpNextgenClientCodegen`
