# OpenAPIClient-php

<div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Nylas Email, Calendar, and Contacts APIs</strong>. See the see the <strong><a href=\"/docs/api/v3/admin/\">Administration API documentation</a></strong> for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.</div>

The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.

You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas APIs. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).

## Query parameters

Nylas allows you to include query parameters in `GET` requests that return a list of results. Query parameters let you narrow the results Nylas returns, meaning fewer requests to the provider and less data for your application to sift through. For more information, see [Rate limits in Nylas](/docs/dev-guide/platform/rate-limits/).

The table below shows the query parameters you can use for the `GET` requests in the Email, Calendar, and Contacts APIs.

| Endpoint | Query parameters |
| :--- | :--- |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/calendars`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/calendars) | `limit`, `page_token`, `metadata_pair` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/events`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/events) | `limit`, `page_token`, `show_cancelled`, `title`, `description`, `ical_uid`, `location`, `start`, `end`, `master_event_id`, `metadata_pair`, `busy`, `updated_before`, `updated_after`, `attendees`, `event_type`, `select` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/drafts`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/drafts) | `limit`, `page_token`, `subject`, `any_email`, `to`, `cc`, `bcc`, `starred`, `thread_id`, `has_attachment` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/messages`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/messages) | `limit`, `page_token`, `subject`, `any_email`, `to`, `from`, `cc`, `bcc`, `in`, `unread`, `starred`, `thread_id`, `received_before`, `received_after`, `has_attachment`, `fields`, `search_query_native` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/threads`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/threads) | `limit`, `page_token`, `subject`, `any_email`, `to`, `from`, `cc`, `bcc`, `in`, `unread`, `starred`, `latest_message_before`, `latest_message_after`, `has_attachment`, `search_query_native` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/folders`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/folders) | `limit`, `page_token`, `parent_id` |
| [`GET /v3/grants/<NYLAS_GRANT_ID>/contacts`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/contacts) | `limit`, `page_token`, `email`, `phone_number`, `source`, `group`, `recurse` |

You can use the `limit` parameter to set the maximum number of results Nylas returns for your request. Nylas recommends setting a lower `limit` if you encounter rate limits on the provider. For more information, see [Avoiding rate limits in Nylas](/docs/dev-guide/best-practices/rate-limits/).

## Pagination

Some requests can result in Nylas returning multiple pages of data. Nylas includes a `next_cursor` field when there is more than one page of results. To get the next page, pass the `next_cursor` value as the `page_token` query parameter in another request.

You can use the `limit` parameter to specify the maximum number of results you want in one page of data. Nylas encourages using smaller value for `limit` parameter if you encounter rate limits from provider (Google/Microsoft).

| Query Parameter | Type    | Description |
| :-------------- | :------ | :---------- |
| `limit`         | integer | The number of objects to return, up to a maximum of `200` (defaults to `50`). |
| `page_token`    | string  | An identifier that specifies which page of data to return. This value should be taken from the `next_cursor` response body field. |

## Updating objects

`PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.

Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.

## /me/ syntax for API calls

Nylas v3 includes new `/me/` syntax that you can use in access-token authorized API calls, instead of specifying a user's grant ID (for example, `GET /v3/grants/me/messages`).

The `/me/` syntax looks up the grant associated with the request's access token, and uses the `grant_id` as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no grant associated with an API key.

For more information, see the [v3 features and changes documentation](/docs/v2/upgrade-to-v3/features-and-changes/#changing-account_id-to-grant_id).

## Metadata

You can use the `metadata` object to add a list of key-value pairs to Calendar and Event objects so you can store custom data with them. Both keys and values can be any string. If you want to filter on metadata, however, you must write values to one of the five [Nylas-specific keys](/docs/api/v3/ecc/#overview--metadata-keys-and-filtering).
</br></br>
<div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">🚀 <b>Metadata support for Messages and Drafts is coming soon</b>.</div>

For more information, see the [Metadata documentation](/docs/dev-guide/metadata/).

### Metadata keys and filtering

Nylas reserves five metadata keys (`key1`, `key2`, `key3`, `key4`, `key5`) and indexes their contents. Nylas uses `key5` to identify events that count towards the `max-fairness` round-robin calculation for event availability. For more information, see [Group availability and booking best practices](/docs/v3/calendar/group-booking/#round-robin-max-fairness-groups).

You can add values to each of these reserved keys, and reference them in a query to filter the objects that Nylas returns. You can also add these filters as query parameters, as in the following examples:

- `https://api.us.nylas.com/calendar?metadata_pair=key1:on-site`
- `https://api.us.nylas.com/events?calendar_id=<CALENDAR_ID>&metadata_pair=key1:on-site`

You cannot create a query that contains both a provider and metadata filter, other than `calendar_id`. For example, `https://api.us.nylas.com/calendar?metadata_pair=key1:plan-party&title=Birthday` returns an error.

## Reduce response size with field selection

Field selection allows you to use the `select` query parameter to specify which fields you want Nylas to include in the response.

You can use field selection for all Nylas API endpoints, _except_ the following:

- All `DELETE` endpoints.
- All Attachments endpoints.
- All Smart Compose endpoints.
- The Send Message endpoint.
- The Create a Draft endpoint.

Field selection helps to reduce the size of the response, improves latency, and helps you avoid rate limiting issues. You can also use it in cases where you want to avoid working with information from your end users that you think might be sensitive.

Field selection can evaluate top-level object fields only. You cannot use it to return only nested fields.

<div style=\"padding:24px; background-color: #F0F3FF; border: 1px solid #002DB4; color: #161717\">📝 <b>Note</b>: Nylas strongly suggests you always use field selection, so you only get the data that you need.</div>

For example, the following request specifies Nylas should return only the `id` and `name` fields of the Calendar object.

```bash
curl --request GET \\
  --url 'https://api.us.nylas.com/v3/grants/me/calendars?select=id,name'
```

The response payload includes only the `id` and `name` fields in the `data` object, as in the example below.

```json
{
  \"request_id\": \"5fa64c92-e840-4357-86b9-2aa364d35b88\",
  \"data\": [
    {
      \"id\": \"5d3qmne77v32r8l4phyuksl2x\",
      \"name\": \"My Calendar\"
    },
    {
      \"id\": \"5d3qmne77v32r23aphyuksl2x\",
      \"name\": \"My Calendar 2\"
    }
  ]
}
```

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



// Configure Bearer (Access token) authorization: ACCESS_TOKEN
$config = JackWH\NylasV3\EmailCalendar\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer (API key) authorization: NYLAS_API_KEY
$config = JackWH\NylasV3\EmailCalendar\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\EmailCalendar\Api\AttachmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$grant_id = 'grant_id_example'; // string | ID of the grant to access. Use `/me/` to refer to the grant associated with an access token.
$attachment_id = 'attachment_id_example'; // string | ID of the attachment to access. Nylas recommends you URL-encode this field, or you might receive a [`404` error](/docs/api/errors/400-response/) if the ID contains special characters (for example, `#`).
$message_id = 'message_id_example'; // string | ID of the message the specified attachment belongs to.
$select = 'select_example'; // string | Specify fields that you want Nylas to return, as a comma-separated list (for example, `select=id,updated_at`). This allows you to receive only the portion of object data that you're interested in. You can use `select` to optimize response size and reduce latency by limiting queries to only the information that you need.

try {
    $result = $apiInstance->getAttachmentsId($grant_id, $attachment_id, $message_id, $select);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AttachmentsApi->getAttachmentsId: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AttachmentsApi* | [**getAttachmentsId**](docs/Api/AttachmentsApi.md#getattachmentsid) | **GET** /v3/grants/{grant_id}/attachments/{attachment_id} | Return Attachment metadata
*AttachmentsApi* | [**getAttachmentsIdDownload**](docs/Api/AttachmentsApi.md#getattachmentsiddownload) | **GET** /v3/grants/{grant_id}/attachments/{attachment_id}/download | Download an Attachment
*CalendarApi* | [**deleteCalendarsId**](docs/Api/CalendarApi.md#deletecalendarsid) | **DELETE** /v3/grants/{grant_id}/calendars/{calendar_id} | Delete a calendar
*CalendarApi* | [**getCalendars**](docs/Api/CalendarApi.md#getcalendars) | **GET** /v3/grants/{grant_id}/calendars | Return all calendars
*CalendarApi* | [**getCalendarsId**](docs/Api/CalendarApi.md#getcalendarsid) | **GET** /v3/grants/{grant_id}/calendars/{calendar_id} | Return a calendar
*CalendarApi* | [**postAvailability**](docs/Api/CalendarApi.md#postavailability) | **POST** /v3/calendars/availability | Get availability
*CalendarApi* | [**postCalendars**](docs/Api/CalendarApi.md#postcalendars) | **POST** /v3/grants/{grant_id}/calendars | Create a calendar
*CalendarApi* | [**postCalendarsFreeBusy**](docs/Api/CalendarApi.md#postcalendarsfreebusy) | **POST** /v3/grants/{grant_id}/calendars/free-busy | Get free/busy schedule
*CalendarApi* | [**putCalendarsId**](docs/Api/CalendarApi.md#putcalendarsid) | **PUT** /v3/grants/{grant_id}/calendars/{calendar_id} | Update a calendar
*ContactsApi* | [**deleteContact**](docs/Api/ContactsApi.md#deletecontact) | **DELETE** /v3/grants/{grant_id}/contacts/{contact_id} | Delete a contact
*ContactsApi* | [**getContact**](docs/Api/ContactsApi.md#getcontact) | **GET** /v3/grants/{grant_id}/contacts/{contact_id} | Return a contact
*ContactsApi* | [**listContact**](docs/Api/ContactsApi.md#listcontact) | **GET** /v3/grants/{grant_id}/contacts | Return all contacts
*ContactsApi* | [**listContactGroups**](docs/Api/ContactsApi.md#listcontactgroups) | **GET** /v3/grants/{grant_id}/contacts/groups | Return all Contact Groups
*ContactsApi* | [**postContact**](docs/Api/ContactsApi.md#postcontact) | **POST** /v3/grants/{grant_id}/contacts | Create contact
*ContactsApi* | [**putContact**](docs/Api/ContactsApi.md#putcontact) | **PUT** /v3/grants/{grant_id}/contacts/{contact_id} | Update a contact
*DraftsApi* | [**deleteDraftsId**](docs/Api/DraftsApi.md#deletedraftsid) | **DELETE** /v3/grants/{grant_id}/drafts/{draft_id} | Delete a Draft
*DraftsApi* | [**getDraftId**](docs/Api/DraftsApi.md#getdraftid) | **GET** /v3/grants/{grant_id}/drafts/{draft_id} | Return a Draft
*DraftsApi* | [**getDrafts**](docs/Api/DraftsApi.md#getdrafts) | **GET** /v3/grants/{grant_id}/drafts | Return all Drafts
*DraftsApi* | [**postDraft**](docs/Api/DraftsApi.md#postdraft) | **POST** /v3/grants/{grant_id}/drafts | Create a Draft
*DraftsApi* | [**putDraftsId**](docs/Api/DraftsApi.md#putdraftsid) | **PUT** /v3/grants/{grant_id}/drafts/{draft_id} | Update a draft
*DraftsApi* | [**sendDraftId**](docs/Api/DraftsApi.md#senddraftid) | **POST** /v3/grants/{grant_id}/drafts/{draft_id} | Send a Draft
*EventsApi* | [**deleteEventsId**](docs/Api/EventsApi.md#deleteeventsid) | **DELETE** /v3/grants/{grant_id}/events/{event_id} | Delete an event
*EventsApi* | [**getEvents**](docs/Api/EventsApi.md#getevents) | **GET** /v3/grants/{grant_id}/events | Return all events
*EventsApi* | [**getEventsId**](docs/Api/EventsApi.md#geteventsid) | **GET** /v3/grants/{grant_id}/events/{event_id} | Return an event
*EventsApi* | [**postEvents**](docs/Api/EventsApi.md#postevents) | **POST** /v3/grants/{grant_id}/events | Create an event
*EventsApi* | [**putEventsId**](docs/Api/EventsApi.md#puteventsid) | **PUT** /v3/grants/{grant_id}/events/{event_id} | Update an event
*EventsApi* | [**sendRsvp**](docs/Api/EventsApi.md#sendrsvp) | **POST** /v3/grants/{grant_id}/events/{event_id}/send-rsvp | Send RSVP
*ExtractAIOrderConsolidationApi* | [**getConsolidatedOrder**](docs/Api/ExtractAIOrderConsolidationApi.md#getconsolidatedorder) | **GET** /v3/grants/{grant_id}/consolidated-order | Return extracted orders
*ExtractAIOrderConsolidationApi* | [**getConsolidatedShipment**](docs/Api/ExtractAIOrderConsolidationApi.md#getconsolidatedshipment) | **GET** /v3/grants/{grant_id}/consolidated-shipment | Return extracted shipments
*FoldersApi* | [**deleteFoldersId**](docs/Api/FoldersApi.md#deletefoldersid) | **DELETE** /v3/grants/{grant_id}/folders/{folder_id} | Delete a Folder
*FoldersApi* | [**getFolder**](docs/Api/FoldersApi.md#getfolder) | **GET** /v3/grants/{grant_id}/folders | Return all folders
*FoldersApi* | [**getFoldersId**](docs/Api/FoldersApi.md#getfoldersid) | **GET** /v3/grants/{grant_id}/folders/{folder_id} | Return a Folder
*FoldersApi* | [**postFolder**](docs/Api/FoldersApi.md#postfolder) | **POST** /v3/grants/{grant_id}/folders | Create a Folder
*FoldersApi* | [**putFoldersId**](docs/Api/FoldersApi.md#putfoldersid) | **PUT** /v3/grants/{grant_id}/folders/{folder_id} | Update a folder
*MessagesApi* | [**cleanMessages**](docs/Api/MessagesApi.md#cleanmessages) | **PUT** /v3/grants/{grant_id}/messages/clean | Clean email messages
*MessagesApi* | [**deleteAScheduledMessage**](docs/Api/MessagesApi.md#deleteascheduledmessage) | **DELETE** /v3/grants/{grant_id}/messages/schedules/{scheduleId} | Cancel a scheduled message
*MessagesApi* | [**deleteMessagesId**](docs/Api/MessagesApi.md#deletemessagesid) | **DELETE** /v3/grants/{grant_id}/messages/{message_id} | Delete a Message
*MessagesApi* | [**getMessages**](docs/Api/MessagesApi.md#getmessages) | **GET** /v3/grants/{grant_id}/messages | Return all Messages
*MessagesApi* | [**getMessagesId**](docs/Api/MessagesApi.md#getmessagesid) | **GET** /v3/grants/{grant_id}/messages/{message_id} | Return a Message
*MessagesApi* | [**getScheduleById**](docs/Api/MessagesApi.md#getschedulebyid) | **GET** /v3/grants/{grant_id}/messages/schedules/{scheduleId} | Return a scheduled message
*MessagesApi* | [**getSchedules**](docs/Api/MessagesApi.md#getschedules) | **GET** /v3/grants/{grant_id}/messages/schedules | Return scheduled messages
*MessagesApi* | [**putMessagesId**](docs/Api/MessagesApi.md#putmessagesid) | **PUT** /v3/grants/{grant_id}/messages/{message_id} | Update message attributes
*MessagesApi* | [**sendMailNow**](docs/Api/MessagesApi.md#sendmailnow) | **POST** /v3/grants/{grant_id}/messages/send | Send a Message
*RoomResourcesApi* | [**listRoomResources**](docs/Api/RoomResourcesApi.md#listroomresources) | **GET** /v3/grants/{grant_id}/resources | Return all room resources
*SmartComposeApi* | [**postSmartCompose**](docs/Api/SmartComposeApi.md#postsmartcompose) | **POST** /v3/grants/{grant_id}/messages/smart-compose | Compose a message
*SmartComposeApi* | [**postSmartComposeReply**](docs/Api/SmartComposeApi.md#postsmartcomposereply) | **POST** /v3/grants/{grant_id}/messages/{message_id}/smart-compose | Compose a reply
*ThreadsApi* | [**deleteThreadsId**](docs/Api/ThreadsApi.md#deletethreadsid) | **DELETE** /v3/grants/{grant_id}/threads/{thread_id} | Delete a thread
*ThreadsApi* | [**getThreads**](docs/Api/ThreadsApi.md#getthreads) | **GET** /v3/grants/{grant_id}/threads | Return all threads
*ThreadsApi* | [**getThreadsId**](docs/Api/ThreadsApi.md#getthreadsid) | **GET** /v3/grants/{grant_id}/threads/{thread_id} | Return a thread
*ThreadsApi* | [**putThreadsId**](docs/Api/ThreadsApi.md#putthreadsid) | **PUT** /v3/grants/{grant_id}/threads/{thread_id} | Update a thread

## Models

- [Attachment](docs/Model/Attachment.md)
- [AttachmentMetadata](docs/Model/AttachmentMetadata.md)
- [AttachmentSend](docs/Model/AttachmentSend.md)
- [Availability](docs/Model/Availability.md)
- [AvailabilityAvailabilityRules](docs/Model/AvailabilityAvailabilityRules.md)
- [AvailabilityBuffer](docs/Model/AvailabilityBuffer.md)
- [AvailabilityOpenHours](docs/Model/AvailabilityOpenHours.md)
- [AvailabilityParticipantsInner](docs/Model/AvailabilityParticipantsInner.md)
- [AvailabilityRequest](docs/Model/AvailabilityRequest.md)
- [AvailabilityResponse](docs/Model/AvailabilityResponse.md)
- [AvailabilityRules](docs/Model/AvailabilityRules.md)
- [AvailabilityTimeSlot](docs/Model/AvailabilityTimeSlot.md)
- [Buffer](docs/Model/Buffer.md)
- [Calendar](docs/Model/Calendar.md)
- [CalendarMetadata](docs/Model/CalendarMetadata.md)
- [CarrierEnrichment](docs/Model/CarrierEnrichment.md)
- [CleanMessages200Response](docs/Model/CleanMessages200Response.md)
- [CleanMessages200ResponseAllOfDataInner](docs/Model/CleanMessages200ResponseAllOfDataInner.md)
- [CleanMessagesRequest](docs/Model/CleanMessagesRequest.md)
- [CommonResponse](docs/Model/CommonResponse.md)
- [CommonResponseWithCursor](docs/Model/CommonResponseWithCursor.md)
- [Contact](docs/Model/Contact.md)
- [ContactEmail](docs/Model/ContactEmail.md)
- [ContactGroup](docs/Model/ContactGroup.md)
- [ContactGroupID](docs/Model/ContactGroupID.md)
- [ContactGroupId](docs/Model/ContactGroupId.md)
- [ContactIMAddress](docs/Model/ContactIMAddress.md)
- [ContactImAddress](docs/Model/ContactImAddress.md)
- [ContactPhoneNumber](docs/Model/ContactPhoneNumber.md)
- [ContactPhysicalAddress](docs/Model/ContactPhysicalAddress.md)
- [ContactWebPage](docs/Model/ContactWebPage.md)
- [ContactWithPicture](docs/Model/ContactWithPicture.md)
- [CreateEvent](docs/Model/CreateEvent.md)
- [CreateEventConferencing](docs/Model/CreateEventConferencing.md)
- [CreateEventParticipantsInner](docs/Model/CreateEventParticipantsInner.md)
- [CreateEventReminders](docs/Model/CreateEventReminders.md)
- [CreateEventRemindersOverridesInner](docs/Model/CreateEventRemindersOverridesInner.md)
- [CreateFolder](docs/Model/CreateFolder.md)
- [CreateFolder1](docs/Model/CreateFolder1.md)
- [DeleteAScheduledMessage202Response](docs/Model/DeleteAScheduledMessage202Response.md)
- [DeleteAScheduledMessage202ResponseData](docs/Model/DeleteAScheduledMessage202ResponseData.md)
- [DeleteCalendarsId200Response](docs/Model/DeleteCalendarsId200Response.md)
- [Draft](docs/Model/Draft.md)
- [Drafts](docs/Model/Drafts.md)
- [Drafts1](docs/Model/Drafts1.md)
- [Drafts1AttachmentsInner](docs/Model/Drafts1AttachmentsInner.md)
- [Drafts2](docs/Model/Drafts2.md)
- [Drafts2AttachmentsInner](docs/Model/Drafts2AttachmentsInner.md)
- [Error](docs/Model/Error.md)
- [Error1](docs/Model/Error1.md)
- [Error1Error](docs/Model/Error1Error.md)
- [Error2](docs/Model/Error2.md)
- [Error2Error](docs/Model/Error2Error.md)
- [Error3](docs/Model/Error3.md)
- [Error3Error](docs/Model/Error3Error.md)
- [Error4](docs/Model/Error4.md)
- [Error4Error](docs/Model/Error4Error.md)
- [Error4ErrorDetailsInner](docs/Model/Error4ErrorDetailsInner.md)
- [Error4ErrorDetailsInnerLocInner](docs/Model/Error4ErrorDetailsInnerLocInner.md)
- [ErrorError](docs/Model/ErrorError.md)
- [Event](docs/Model/Event.md)
- [EventConferencing](docs/Model/EventConferencing.md)
- [EventConferencingRequest](docs/Model/EventConferencingRequest.md)
- [EventConferencingResponse](docs/Model/EventConferencingResponse.md)
- [EventCreate](docs/Model/EventCreate.md)
- [EventDate](docs/Model/EventDate.md)
- [EventDatespan](docs/Model/EventDatespan.md)
- [EventOrganizer](docs/Model/EventOrganizer.md)
- [EventParticipants](docs/Model/EventParticipants.md)
- [EventParticipantsCreateUpdate](docs/Model/EventParticipantsCreateUpdate.md)
- [EventParticipantsInner](docs/Model/EventParticipantsInner.md)
- [EventReminders](docs/Model/EventReminders.md)
- [EventRemindersCreate](docs/Model/EventRemindersCreate.md)
- [EventRemindersOverridesInner](docs/Model/EventRemindersOverridesInner.md)
- [EventResources](docs/Model/EventResources.md)
- [EventResourcesInner](docs/Model/EventResourcesInner.md)
- [EventSendRsvp](docs/Model/EventSendRsvp.md)
- [EventStatus](docs/Model/EventStatus.md)
- [EventTime](docs/Model/EventTime.md)
- [EventTimespan](docs/Model/EventTimespan.md)
- [EventUpdate](docs/Model/EventUpdate.md)
- [EventVisibility](docs/Model/EventVisibility.md)
- [EventWhen](docs/Model/EventWhen.md)
- [EventWhenResponse](docs/Model/EventWhenResponse.md)
- [Folder](docs/Model/Folder.md)
- [FreeBusy](docs/Model/FreeBusy.md)
- [FreebusyRequest](docs/Model/FreebusyRequest.md)
- [GetAttachmentsId200Response](docs/Model/GetAttachmentsId200Response.md)
- [GetAttachmentsId200ResponseAllOfData](docs/Model/GetAttachmentsId200ResponseAllOfData.md)
- [GetCalendars200Response](docs/Model/GetCalendars200Response.md)
- [GetConsolidatedOrder200Response](docs/Model/GetConsolidatedOrder200Response.md)
- [GetConsolidatedOrder200ResponseAllOfData](docs/Model/GetConsolidatedOrder200ResponseAllOfData.md)
- [GetConsolidatedOrder200ResponseAllOfDataAllOfProductsInner](docs/Model/GetConsolidatedOrder200ResponseAllOfDataAllOfProductsInner.md)
- [GetConsolidatedOrder400Response](docs/Model/GetConsolidatedOrder400Response.md)
- [GetConsolidatedOrder400ResponseError](docs/Model/GetConsolidatedOrder400ResponseError.md)
- [GetConsolidatedShipment200Response](docs/Model/GetConsolidatedShipment200Response.md)
- [GetConsolidatedShipment200ResponseAllOfData](docs/Model/GetConsolidatedShipment200ResponseAllOfData.md)
- [GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichment](docs/Model/GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichment.md)
- [GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus](docs/Model/GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus.md)
- [GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentPackageActivityInner](docs/Model/GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentPackageActivityInner.md)
- [GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress](docs/Model/GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress.md)
- [GetConsolidatedShipment200ResponseAllOfDataAllOfOrder](docs/Model/GetConsolidatedShipment200ResponseAllOfDataAllOfOrder.md)
- [GetContact200Response](docs/Model/GetContact200Response.md)
- [GetDrafts200Response](docs/Model/GetDrafts200Response.md)
- [GetEvents200Response](docs/Model/GetEvents200Response.md)
- [GetFolder200Response](docs/Model/GetFolder200Response.md)
- [GetMessages200Response](docs/Model/GetMessages200Response.md)
- [GetMessagesId200Response](docs/Model/GetMessagesId200Response.md)
- [GetSchedules200ResponseInner](docs/Model/GetSchedules200ResponseInner.md)
- [GetSchedules200ResponseInnerStatus](docs/Model/GetSchedules200ResponseInnerStatus.md)
- [GetThreads200Response](docs/Model/GetThreads200Response.md)
- [GetThreadsId200Response](docs/Model/GetThreadsId200Response.md)
- [ListContact200Response](docs/Model/ListContact200Response.md)
- [ListContactGroups200Response](docs/Model/ListContactGroups200Response.md)
- [ListRoomResources200Response](docs/Model/ListRoomResources200Response.md)
- [Location](docs/Model/Location.md)
- [Message](docs/Model/Message.md)
- [Message1](docs/Model/Message1.md)
- [MessageAttachmentsInner](docs/Model/MessageAttachmentsInner.md)
- [MessageParticipant](docs/Model/MessageParticipant.md)
- [MessageUpdatePayload](docs/Model/MessageUpdatePayload.md)
- [Metadata](docs/Model/Metadata.md)
- [OpenHours](docs/Model/OpenHours.md)
- [Order](docs/Model/Order.md)
- [Organizer](docs/Model/Organizer.md)
- [PackageActivity](docs/Model/PackageActivity.md)
- [PostAvailability200Response](docs/Model/PostAvailability200Response.md)
- [PostAvailability200ResponseAllOfData](docs/Model/PostAvailability200ResponseAllOfData.md)
- [PostCalendars200Response](docs/Model/PostCalendars200Response.md)
- [PostCalendarsFreeBusy200Response](docs/Model/PostCalendarsFreeBusy200Response.md)
- [PostCalendarsFreeBusy200ResponseDataInner](docs/Model/PostCalendarsFreeBusy200ResponseDataInner.md)
- [PostCalendarsFreeBusy200ResponseDataInnerTimeSlotsInner](docs/Model/PostCalendarsFreeBusy200ResponseDataInnerTimeSlotsInner.md)
- [PostCalendarsRequest](docs/Model/PostCalendarsRequest.md)
- [PostContact200Response](docs/Model/PostContact200Response.md)
- [PostContactRequest](docs/Model/PostContactRequest.md)
- [PostDraft200Response](docs/Model/PostDraft200Response.md)
- [PostDraftRequestDraft](docs/Model/PostDraftRequestDraft.md)
- [PostEvents200Response](docs/Model/PostEvents200Response.md)
- [PostFolder200Response](docs/Model/PostFolder200Response.md)
- [PostSmartCompose200Response](docs/Model/PostSmartCompose200Response.md)
- [PostSmartCompose200Response1](docs/Model/PostSmartCompose200Response1.md)
- [PromptSuggestion](docs/Model/PromptSuggestion.md)
- [PutCalendarsIdRequest](docs/Model/PutCalendarsIdRequest.md)
- [PutDraftsIdRequestDraft](docs/Model/PutDraftsIdRequestDraft.md)
- [Resource](docs/Model/Resource.md)
- [ResponseObject](docs/Model/ResponseObject.md)
- [RoomResource](docs/Model/RoomResource.md)
- [Schedules](docs/Model/Schedules.md)
- [SendMailNow200Response](docs/Model/SendMailNow200Response.md)
- [SendMailNow202Response](docs/Model/SendMailNow202Response.md)
- [SendMailNowRequest](docs/Model/SendMailNowRequest.md)
- [SendMailNowRequest1Message](docs/Model/SendMailNowRequest1Message.md)
- [SendMailNowRequestAttachmentsInner](docs/Model/SendMailNowRequestAttachmentsInner.md)
- [SendMailNowRequestCustomHeadersInner](docs/Model/SendMailNowRequestCustomHeadersInner.md)
- [SendMailNowRequestTrackingOptions](docs/Model/SendMailNowRequestTrackingOptions.md)
- [SendRsvp200Response](docs/Model/SendRsvp200Response.md)
- [SendRsvp200ResponseAllOfData](docs/Model/SendRsvp200ResponseAllOfData.md)
- [SendRsvp200ResponseAllOfDataSendIcsError](docs/Model/SendRsvp200ResponseAllOfDataSendIcsError.md)
- [SendRsvpRequest](docs/Model/SendRsvpRequest.md)
- [Shipment](docs/Model/Shipment.md)
- [SmartCompose](docs/Model/SmartCompose.md)
- [SmartComposeSuggestion](docs/Model/SmartComposeSuggestion.md)
- [Status](docs/Model/Status.md)
- [Thread](docs/Model/Thread.md)
- [ThreadParticipantsInner](docs/Model/ThreadParticipantsInner.md)
- [TimeSlot](docs/Model/TimeSlot.md)
- [UpdateEvent](docs/Model/UpdateEvent.md)
- [UpdateThreadPayload](docs/Model/UpdateThreadPayload.md)
- [When](docs/Model/When.md)
- [When1](docs/Model/When1.md)
- [When1AnyOf](docs/Model/When1AnyOf.md)
- [When1AnyOf1](docs/Model/When1AnyOf1.md)
- [When1AnyOf2](docs/Model/When1AnyOf2.md)
- [When1AnyOf3](docs/Model/When1AnyOf3.md)
- [WhenAnyOf](docs/Model/WhenAnyOf.md)
- [WhenAnyOf1](docs/Model/WhenAnyOf1.md)
- [WhenAnyOf2](docs/Model/WhenAnyOf2.md)

## Authorization

### ACCESS_TOKEN

- **Type**: Bearer authentication (Access token)


### NYLAS_API_KEY

- **Type**: Bearer authentication (API key)

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
