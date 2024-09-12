# OpenAPIClient-php

This API reference covers the **Nylas Email and Calendar APIs**.
See the see the [<b>Administration API documentation</b>](https:///docs/api/v3-beta/admin/) for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.

The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like GET, PUT, POST, and DELETE and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.

# Pagination

Some queries result in multiple pages of data. Nylas includes a `next_cursor` response body field when there are more pages of results. To get the next page, pass the value of this header as the `page_token` query parameter on your next request.

You can use the `limit` query parameter to specify the maximum number of results you want in the page. A page might have less than `limit` results, but that doesn't mean that it's the last page. Use the presences of the `next_cursor` response body field to determine if there are additional pages.

| Query Parameter | Type | Description |
| --- | --- | --- |
| `limit` | integer | The number of objects to return. This defaults to 50 and has a maximum of 200. |
| `page_token` | string | An identifier that specifies which page of data to return. This value should be taken from the `next_cursor` response body field. |

# /me/ syntax for API calls

The Nylas API v3 Beta includes new `/me/` syntax that you can use in access-token authorized API calls, instead of specifying a user's Grant ID (for example, `GET /v3/grants/me/messages`).

The `/me/` syntax looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.

For more information, see the [API v3 Beta features and changes documentation](https:///docs/v3-beta/features-and-changes/#changing-account_id-to-grant_id).

# Metadata

You can add key-value pairs to certain objects to store data against them. You can currently create, read, update, and delete metadata on Calendars and Events. Metadata is coming soon for message drafts and messages.

The `metadata` object is made of a list of key-value pairs. Keys and values can be any string.

Nylas also reserves five specific keys that you can include in the JSON payload of a query to filter the returned objects.

## Metadata keys and filtering

Nylas reserves five metadata keys (`key1`, `key2`, `key3`, `key4`, `key5`) and indexes their contents. If you add metadata values to these keys, you can then add a metadata filter to a query so that only items with matching metadata are returned. You can also add these filters as URI parameters to a query, as in the examples below.

- `https://api.nylas.com/calendar?metadata_pair=key1:value`
- `https://api.nylas.com/events?calendar_id=CALENDAR_ID&metadata_pair=key1:value`

You cannot create a query that contains **both** a provider and metadata filter. Filters like the example below return an error message.

- `https://api.nylas.com/calendar?metadata_pair=key1:value&title=Birthday`\"

You do not need to include an `event_id` when filtering with `metadata_filters`.
What's this about? It seems a random

## Example: Add metadata

The following example cURL request adds metadata to a Calendar. You can add metadata to Calendars and Events using a `POST` request with a `--data-raw` object for both.

In the example below, we add `key1`, which is one of the Nylas-indexed keys that you can use for filtering.

``` bash
curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\
--header 'Content-Type: application/json' \\
--data-raw '{
    \"name\" : \"Name of a calendar with metadata\",
    \"metadata\":{
        \"key1\": \"value to filter on\"
    }
}'

 ```

The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.

## Example: Query metadata

You can query the metadata you added by including a JSON object like the example below to a query that would return metadata-enabled objects. At this time calendars and events support metadata.

``` json
\"metadata\": {
    \"key1\": \"value\"
}

 ```

### Example: Update and delete metadata

The example cURL command below creates a new Calendar that includes metadata.

``` bash
curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\
--data-raw '{
    \"metadata\": {
        \"key1\": \"Initial metadata value\"
    }
}'

 ```

The example below updates the calendar `metadata` using a `PUT` command.

**Note**: The `PUT` command overwrites the entire `metadata` object. (The `PATCH` command behaves in the same way, and overwrites the entire `metadata` object.)

``` bash
curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\
--data-raw '{
    \"metadata\": {
        \"key1\": \"This key has been updated\",
        \"key2\": \"Added this new key\"
    }
}'

 ```

The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.

The response will be similar to the following example.
Is this Nylas' response confirming the change? Or is this the response if you query for that metadata later?

``` json
\"metadata\": {
    \"key1\": \"This key has been updated\",
    \"key2\": \"Added this new key\"
}

 ```

If you update the above example with the `PUT` call below that does _not_ include both metadata keys, Nylas deletes `key2` from the `metadata` object.

``` bash
curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\
--data-raw '{
    \"metadata\": {
        \"key1\": \"New Value\"
    }
}'

 ```

The response will then be similar to the example below.
Same question re: what kind of response.

``` json
\"metadata\": {
    \"key1\": \"New Value\"
}

 ```


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
$config = JackWH\NylasV3\EmailCalendar\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\EmailCalendar\Api\V3Api(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$content_type = application/json; // string
$accept = application/json; // string
$body = array('key' => new \stdClass); // object

try {
    $result = $apiInstance->v3CalendarsAvailabilityPost($content_type, $accept, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling V3Api->v3CalendarsAvailabilityPost: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*V3Api* | [**v3CalendarsAvailabilityPost**](docs/Api/V3Api.md#v3calendarsavailabilitypost) | **POST** /v3/calendars/availability | Get Availability
*V3GrantsGrantIdApi* | [**v3GrantsGrantIdResourcesGet**](docs/Api/V3GrantsGrantIdApi.md#v3grantsgrantidresourcesget) | **GET** /v3/grants/{grant_id}/resources | Return all room resources
*V3GrantsGrantIdAttachmentsAttachmentIdApi* | [**v3GrantsGrantIdAttachmentsAttachmentIdDownloadGet**](docs/Api/V3GrantsGrantIdAttachmentsAttachmentIdApi.md#v3grantsgrantidattachmentsattachmentiddownloadget) | **GET** /v3/grants/{grant_id}/attachments/{attachment_id}/download | Download an Attachment
*V3GrantsGrantIdAttachmentsAttachmentIdApi* | [**v3GrantsGrantIdAttachmentsAttachmentIdGet**](docs/Api/V3GrantsGrantIdAttachmentsAttachmentIdApi.md#v3grantsgrantidattachmentsattachmentidget) | **GET** /v3/grants/{grant_id}/attachments/{attachment_id} | Return metadata of an Attachment
*V3GrantsGrantIdCalendarsApi* | [**v3GrantsGrantIdCalendarsFreeBusyPost**](docs/Api/V3GrantsGrantIdCalendarsApi.md#v3grantsgrantidcalendarsfreebusypost) | **POST** /v3/grants/{grant_id}/calendars/free-busy | Get Free/Busy Schedule
*V3GrantsGrantIdCalendarsApi* | [**v3GrantsGrantIdCalendarsGet**](docs/Api/V3GrantsGrantIdCalendarsApi.md#v3grantsgrantidcalendarsget) | **GET** /v3/grants/{grantId}/calendars | Return all Calendars
*V3GrantsGrantIdCalendarsApi* | [**v3GrantsGrantIdCalendarsPost**](docs/Api/V3GrantsGrantIdCalendarsApi.md#v3grantsgrantidcalendarspost) | **POST** /v3/grants/{grant_id}/calendars | Create a Calendar
*V3GrantsGrantIdCalendarsCalendarIdApi* | [**v3GrantsGrantIdCalendarsCalendarIdDelete**](docs/Api/V3GrantsGrantIdCalendarsCalendarIdApi.md#v3grantsgrantidcalendarscalendariddelete) | **DELETE** /v3/grants/{grant_id}/calendars/{calendar_id} | Delete a Calendar
*V3GrantsGrantIdCalendarsCalendarIdApi* | [**v3GrantsGrantIdCalendarsCalendarIdGet**](docs/Api/V3GrantsGrantIdCalendarsCalendarIdApi.md#v3grantsgrantidcalendarscalendaridget) | **GET** /v3/grants/{grant_id}/calendars/{calendar_id} | Return a Calendar
*V3GrantsGrantIdCalendarsCalendarIdApi* | [**v3GrantsGrantIdCalendarsCalendarIdPut**](docs/Api/V3GrantsGrantIdCalendarsCalendarIdApi.md#v3grantsgrantidcalendarscalendaridput) | **PUT** /v3/grants/{grant_id}/calendars/{calendar_id} | Update a Calendar
*V3GrantsGrantIdDraftsApi* | [**v3GrantsGrantIdDraftsGet**](docs/Api/V3GrantsGrantIdDraftsApi.md#v3grantsgrantiddraftsget) | **GET** /v3/grants/{grant_id}/drafts | Return all Drafts
*V3GrantsGrantIdDraftsApi* | [**v3GrantsGrantIdDraftsPost**](docs/Api/V3GrantsGrantIdDraftsApi.md#v3grantsgrantiddraftspost) | **POST** /v3/grants/{grant_id}/drafts | Create a Draft
*V3GrantsGrantIdDraftsDraftIdApi* | [**v3GrantsGrantIdDraftsDraftIdDelete**](docs/Api/V3GrantsGrantIdDraftsDraftIdApi.md#v3grantsgrantiddraftsdraftiddelete) | **DELETE** /v3/grants/{grant_id}/drafts/{draft_id} | Delete a Draft
*V3GrantsGrantIdDraftsDraftIdApi* | [**v3GrantsGrantIdDraftsDraftIdGet**](docs/Api/V3GrantsGrantIdDraftsDraftIdApi.md#v3grantsgrantiddraftsdraftidget) | **GET** /v3/grants/{grant_id}/drafts/{draft_id} | Return a Draft
*V3GrantsGrantIdDraftsDraftIdApi* | [**v3GrantsGrantIdDraftsDraftIdPost**](docs/Api/V3GrantsGrantIdDraftsDraftIdApi.md#v3grantsgrantiddraftsdraftidpost) | **POST** /v3/grants/{grant_id}/drafts/{draft_id} | Send a Draft
*V3GrantsGrantIdDraftsDraftIdApi* | [**v3GrantsGrantIdDraftsDraftIdPut**](docs/Api/V3GrantsGrantIdDraftsDraftIdApi.md#v3grantsgrantiddraftsdraftidput) | **PUT** /v3/grants/{grant_id}/drafts/{draft_id} | Update a Draft
*V3GrantsGrantIdEventsApi* | [**v3GrantsGrantIdEventsGet**](docs/Api/V3GrantsGrantIdEventsApi.md#v3grantsgrantideventsget) | **GET** /v3/grants/{grant_id}/events | Return all Events
*V3GrantsGrantIdEventsApi* | [**v3GrantsGrantIdEventsPost**](docs/Api/V3GrantsGrantIdEventsApi.md#v3grantsgrantideventspost) | **POST** /v3/grants/{grant_id}/events | Create an Event
*V3GrantsGrantIdEventsEventIdApi* | [**v3GrantsGrantIdEventsEventIdDelete**](docs/Api/V3GrantsGrantIdEventsEventIdApi.md#v3grantsgrantideventseventiddelete) | **DELETE** /v3/grants/{grant_id}/events/{event_id} | Delete an Event
*V3GrantsGrantIdEventsEventIdApi* | [**v3GrantsGrantIdEventsEventIdGet**](docs/Api/V3GrantsGrantIdEventsEventIdApi.md#v3grantsgrantideventseventidget) | **GET** /v3/grants/{grant_id}/events/{event_id} | Return an Event
*V3GrantsGrantIdEventsEventIdApi* | [**v3GrantsGrantIdEventsEventIdPut**](docs/Api/V3GrantsGrantIdEventsEventIdApi.md#v3grantsgrantideventseventidput) | **PUT** /v3/grants/{grant_id}/events/{event_id} | Update an Event
*V3GrantsGrantIdEventsEventIdApi* | [**v3GrantsGrantIdEventsEventIdSendRsvpPost**](docs/Api/V3GrantsGrantIdEventsEventIdApi.md#v3grantsgrantideventseventidsendrsvppost) | **POST** /v3/grants/{grant_id}/events/{event_id}/send-rsvp | Send RSVP
*V3GrantsGrantIdFoldersApi* | [**v3GrantsGrantIdFoldersGet**](docs/Api/V3GrantsGrantIdFoldersApi.md#v3grantsgrantidfoldersget) | **GET** /v3/grants/{grant_id}/folders | Return all Folders
*V3GrantsGrantIdFoldersApi* | [**v3GrantsGrantIdFoldersPost**](docs/Api/V3GrantsGrantIdFoldersApi.md#v3grantsgrantidfolderspost) | **POST** /v3/grants/{grant_id}/folders | Create a Folder
*V3GrantsGrantIdFoldersFolderIdApi* | [**v3GrantsGrantIdFoldersFolderIdDelete**](docs/Api/V3GrantsGrantIdFoldersFolderIdApi.md#v3grantsgrantidfoldersfolderiddelete) | **DELETE** /v3/grants/{grant_id}/folders/{folder_id} | Delete a Folder
*V3GrantsGrantIdFoldersFolderIdApi* | [**v3GrantsGrantIdFoldersFolderIdGet**](docs/Api/V3GrantsGrantIdFoldersFolderIdApi.md#v3grantsgrantidfoldersfolderidget) | **GET** /v3/grants/{grant_id}/folders/{folder_id} | Return a Folder
*V3GrantsGrantIdFoldersFolderIdApi* | [**v3GrantsGrantIdFoldersFolderIdPut**](docs/Api/V3GrantsGrantIdFoldersFolderIdApi.md#v3grantsgrantidfoldersfolderidput) | **PUT** /v3/grants/{grant_id}/folders/{folder_id} | Update a Folder
*V3GrantsGrantIdMessagesApi* | [**v3GrantsGrantIdMessagesCleanPut**](docs/Api/V3GrantsGrantIdMessagesApi.md#v3grantsgrantidmessagescleanput) | **PUT** /v3/grants/{grant_id}/messages/clean | Clean email messages
*V3GrantsGrantIdMessagesApi* | [**v3GrantsGrantIdMessagesGet**](docs/Api/V3GrantsGrantIdMessagesApi.md#v3grantsgrantidmessagesget) | **GET** /v3/grants/{grant_id}/messages | Return all Messages
*V3GrantsGrantIdMessagesApi* | [**v3GrantsGrantIdMessagesSendPost**](docs/Api/V3GrantsGrantIdMessagesApi.md#v3grantsgrantidmessagessendpost) | **POST** /v3/grants/{grant_id}/messages/send | Send a message
*V3GrantsGrantIdMessagesApi* | [**v3GrantsGrantIdMessagesSmartComposePost**](docs/Api/V3GrantsGrantIdMessagesApi.md#v3grantsgrantidmessagessmartcomposepost) | **POST** /v3/grants/{grant_id}/messages/smart-compose | Compose a message
*V3GrantsGrantIdMessagesMessageIdApi* | [**v3GrantsGrantIdMessagesMessageIdDelete**](docs/Api/V3GrantsGrantIdMessagesMessageIdApi.md#v3grantsgrantidmessagesmessageiddelete) | **DELETE** /v3/grants/{grant_id}/messages/{message_id} | Delete a Message
*V3GrantsGrantIdMessagesMessageIdApi* | [**v3GrantsGrantIdMessagesMessageIdGet**](docs/Api/V3GrantsGrantIdMessagesMessageIdApi.md#v3grantsgrantidmessagesmessageidget) | **GET** /v3/grants/{grant_id}/messages/{message_id} | Return a Message
*V3GrantsGrantIdMessagesMessageIdApi* | [**v3GrantsGrantIdMessagesMessageIdPut**](docs/Api/V3GrantsGrantIdMessagesMessageIdApi.md#v3grantsgrantidmessagesmessageidput) | **PUT** /v3/grants/{grant_id}/messages/{message_id} | Update a Message
*V3GrantsGrantIdMessagesMessageIdApi* | [**v3GrantsGrantIdMessagesMessageIdSmartComposePost**](docs/Api/V3GrantsGrantIdMessagesMessageIdApi.md#v3grantsgrantidmessagesmessageidsmartcomposepost) | **POST** /v3/grants/{grant_id}/messages/{message_id}/smart-compose | Compose a message reply
*V3GrantsGrantIdMessagesSchedulesApi* | [**v3GrantsGrantIdMessagesSchedulesGet**](docs/Api/V3GrantsGrantIdMessagesSchedulesApi.md#v3grantsgrantidmessagesschedulesget) | **GET** /v3/grants/{grant_id}/messages/schedules | Retrieve Your Scheduled Messages
*V3GrantsGrantIdMessagesSchedulesScheduleIdApi* | [**v3GrantsGrantIdMessagesSchedulesScheduleIdDelete**](docs/Api/V3GrantsGrantIdMessagesSchedulesScheduleIdApi.md#v3grantsgrantidmessagesschedulesscheduleiddelete) | **DELETE** /v3/grants/{grant_id}/messages/schedules/{scheduleId} | Stop a Scheduled Message
*V3GrantsGrantIdMessagesSchedulesScheduleIdApi* | [**v3GrantsGrantIdMessagesSchedulesScheduleIdGet**](docs/Api/V3GrantsGrantIdMessagesSchedulesScheduleIdApi.md#v3grantsgrantidmessagesschedulesscheduleidget) | **GET** /v3/grants/{grant_id}/messages/schedules/{scheduleId} | Retrieve a Scheduled Message
*V3GrantsGrantIdThreadsApi* | [**v3GrantsGrantIdThreadsGet**](docs/Api/V3GrantsGrantIdThreadsApi.md#v3grantsgrantidthreadsget) | **GET** /v3/grants/{grant_id}/threads | Return all Threads
*V3GrantsGrantIdThreadsThreadIdApi* | [**v3GrantsGrantIdThreadsThreadIdDelete**](docs/Api/V3GrantsGrantIdThreadsThreadIdApi.md#v3grantsgrantidthreadsthreadiddelete) | **DELETE** /v3/grants/{grant_id}/threads/{thread_id} | Delete a Thread
*V3GrantsGrantIdThreadsThreadIdApi* | [**v3GrantsGrantIdThreadsThreadIdGet**](docs/Api/V3GrantsGrantIdThreadsThreadIdApi.md#v3grantsgrantidthreadsthreadidget) | **GET** /v3/grants/{grant_id}/threads/{thread_id} | Return a Thread
*V3GrantsGrantIdThreadsThreadIdApi* | [**v3GrantsGrantIdThreadsThreadIdPut**](docs/Api/V3GrantsGrantIdThreadsThreadIdApi.md#v3grantsgrantidthreadsthreadidput) | **PUT** /v3/grants/{grant_id}/threads/{thread_id} | Update a Thread

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
