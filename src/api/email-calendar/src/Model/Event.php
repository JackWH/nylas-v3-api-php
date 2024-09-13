<?php
/**
 * Event
 *
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Nylas v3 Email, Calendar, and Contacts APIs
 *
 * <div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Nylas Email, Calendar, and Contacts APIs</strong>. See the see the <strong><a href=\"/docs/api/v3/admin/\">Administration API documentation</a></strong> for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.</div>  The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.  You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas APIs. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).  ## Query parameters  Nylas allows you to include query parameters in `GET` requests that return a list of results. Query parameters let you narrow the results Nylas returns, meaning fewer requests to the provider and less data for your application to sift through. For more information, see [Rate limits in Nylas](/docs/dev-guide/platform/rate-limits/).  The table below shows the query parameters you can use for the `GET` requests in the Email, Calendar, and Contacts APIs.  | Endpoint | Query parameters | | :--- | :--- | | [`GET /v3/grants/<NYLAS_GRANT_ID>/calendars`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/calendars) | `limit`, `page_token`, `metadata_pair` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/events`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/events) | `limit`, `page_token`, `show_cancelled`, `title`, `description`, `ical_uid`, `location`, `start`, `end`, `master_event_id`, `metadata_pair`, `busy`, `updated_before`, `updated_after`, `attendees`, `event_type`, `select` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/drafts`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/drafts) | `limit`, `page_token`, `subject`, `any_email`, `to`, `cc`, `bcc`, `starred`, `thread_id`, `has_attachment` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/messages`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/messages) | `limit`, `page_token`, `subject`, `any_email`, `to`, `from`, `cc`, `bcc`, `in`, `unread`, `starred`, `thread_id`, `received_before`, `received_after`, `has_attachment`, `fields`, `search_query_native` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/threads`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/threads) | `limit`, `page_token`, `subject`, `any_email`, `to`, `from`, `cc`, `bcc`, `in`, `unread`, `starred`, `latest_message_before`, `latest_message_after`, `has_attachment`, `search_query_native` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/folders`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/folders) | `limit`, `page_token`, `parent_id` | | [`GET /v3/grants/<NYLAS_GRANT_ID>/contacts`](/docs/api/v3/ecc/#get-/v3/grants/-grant_id-/contacts) | `limit`, `page_token`, `email`, `phone_number`, `source`, `group`, `recurse` |  You can use the `limit` parameter to set the maximum number of results Nylas returns for your request. Nylas recommends setting a lower `limit` if you encounter rate limits on the provider. For more information, see [Avoiding rate limits in Nylas](/docs/dev-guide/best-practices/rate-limits/).  ## Pagination  Some requests can result in Nylas returning multiple pages of data. Nylas includes a `next_cursor` field when there is more than one page of results. To get the next page, pass the `next_cursor` value as the `page_token` query parameter in another request.  You can use the `limit` parameter to specify the maximum number of results you want in one page of data. Nylas encourages using smaller value for `limit` parameter if you encounter rate limits from provider (Google/Microsoft).  | Query Parameter | Type    | Description | | :-------------- | :------ | :---------- | | `limit`         | integer | The number of objects to return, up to a maximum of `200` (defaults to `50`). | | `page_token`    | string  | An identifier that specifies which page of data to return. This value should be taken from the `next_cursor` response body field. |  ## Updating objects  `PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.  Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.  ## /me/ syntax for API calls  Nylas v3 includes new `/me/` syntax that you can use in access-token authorized API calls, instead of specifying a user's grant ID (for example, `GET /v3/grants/me/messages`).  The `/me/` syntax looks up the grant associated with the request's access token, and uses the `grant_id` as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no grant associated with an API key.  For more information, see the [v3 features and changes documentation](/docs/v2/upgrade-to-v3/features-and-changes/#changing-account_id-to-grant_id).  ## Metadata  You can use the `metadata` object to add a list of key-value pairs to Calendar and Event objects so you can store custom data with them. Both keys and values can be any string. If you want to filter on metadata, however, you must write values to one of the five [Nylas-specific keys](/docs/api/v3/ecc/#overview--metadata-keys-and-filtering). </br></br> <div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">🚀 <b>Metadata support for Messages and Drafts is coming soon</b>.</div>  For more information, see the [Metadata documentation](/docs/dev-guide/metadata/).  ### Metadata keys and filtering  Nylas reserves five metadata keys (`key1`, `key2`, `key3`, `key4`, `key5`) and indexes their contents. Nylas uses `key5` to identify events that count towards the `max-fairness` round-robin calculation for event availability. For more information, see [Group availability and booking best practices](/docs/v3/calendar/group-booking/#round-robin-max-fairness-groups).  You can add values to each of these reserved keys, and reference them in a query to filter the objects that Nylas returns. You can also add these filters as query parameters, as in the following examples:  - `https://api.us.nylas.com/calendar?metadata_pair=key1:on-site` - `https://api.us.nylas.com/events?calendar_id=<CALENDAR_ID>&metadata_pair=key1:on-site`  You cannot create a query that contains both a provider and metadata filter, other than `calendar_id`. For example, `https://api.us.nylas.com/calendar?metadata_pair=key1:plan-party&title=Birthday` returns an error.  ## Reduce response size with field selection  Field selection allows you to use the `select` query parameter to specify which fields you want Nylas to include in the response.  You can use field selection for all Nylas API endpoints, _except_ the following:  - All `DELETE` endpoints. - All Attachments endpoints. - All Smart Compose endpoints. - The Send Message endpoint. - The Create a Draft endpoint.  Field selection helps to reduce the size of the response, improves latency, and helps you avoid rate limiting issues. You can also use it in cases where you want to avoid working with information from your end users that you think might be sensitive.  Field selection can evaluate top-level object fields only. You cannot use it to return only nested fields.  <div style=\"padding:24px; background-color: #F0F3FF; border: 1px solid #002DB4; color: #161717\">📝 <b>Note</b>: Nylas strongly suggests you always use field selection, so you only get the data that you need.</div>  For example, the following request specifies Nylas should return only the `id` and `name` fields of the Calendar object.  ```bash curl --request GET \\   --url 'https://api.us.nylas.com/v3/grants/me/calendars?select=id,name' ```  The response payload includes only the `id` and `name` fields in the `data` object, as in the example below.  ```json {   \"request_id\": \"5fa64c92-e840-4357-86b9-2aa364d35b88\",   \"data\": [     {       \"id\": \"5d3qmne77v32r8l4phyuksl2x\",       \"name\": \"My Calendar\"     },     {       \"id\": \"5d3qmne77v32r23aphyuksl2x\",       \"name\": \"My Calendar 2\"     }   ] } ```  ## Nylas v3 encoding  Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.
 *
 * The version of the OpenAPI document: v3
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.8.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace JackWH\NylasV3\EmailCalendar\Model;

use ArrayAccess;
use InvalidArgumentException;
use JackWH\NylasV3\EmailCalendar\ObjectSerializer;
use JsonSerializable;
use ReturnTypeWillChange;

/**
 * Event Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class Event implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'Event';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'busy' => 'bool',
        'calendar_id' => 'string',
        'conferencing' => '\JackWH\NylasV3\EmailCalendar\Model\EventConferencing',
        'created_at' => 'int',
        'description' => 'string',
        'hide_participants' => 'bool',
        'grant_id' => 'string',
        'html_link' => 'string',
        'ical_uid' => 'string',
        'id' => 'string',
        'location' => 'string',
        'master_event_id' => 'string',
        'metadata' => '\JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata',
        'object' => 'string',
        'organizer' => '\JackWH\NylasV3\EmailCalendar\Model\EventOrganizer',
        'participants' => '\JackWH\NylasV3\EmailCalendar\Model\EventParticipantsInner[]',
        'resources' => '\JackWH\NylasV3\EmailCalendar\Model\EventResourcesInner[]',
        'read_only' => 'bool',
        'reminders' => '\JackWH\NylasV3\EmailCalendar\Model\EventReminders',
        'recurrence' => 'string[]',
        'status' => 'string',
        'title' => 'string',
        'updated_at' => 'int',
        'visibility' => 'string',
        'when' => '\JackWH\NylasV3\EmailCalendar\Model\When',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'busy' => null,
        'calendar_id' => null,
        'conferencing' => null,
        'created_at' => null,
        'description' => null,
        'hide_participants' => null,
        'grant_id' => null,
        'html_link' => null,
        'ical_uid' => null,
        'id' => null,
        'location' => null,
        'master_event_id' => null,
        'metadata' => null,
        'object' => null,
        'organizer' => null,
        'participants' => null,
        'resources' => null,
        'read_only' => null,
        'reminders' => null,
        'recurrence' => null,
        'status' => null,
        'title' => null,
        'updated_at' => null,
        'visibility' => null,
        'when' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'busy' => false,
        'calendar_id' => false,
        'conferencing' => false,
        'created_at' => true,
        'description' => true,
        'hide_participants' => false,
        'grant_id' => false,
        'html_link' => false,
        'ical_uid' => true,
        'id' => false,
        'location' => true,
        'master_event_id' => true,
        'metadata' => false,
        'object' => false,
        'organizer' => false,
        'participants' => false,
        'resources' => false,
        'read_only' => false,
        'reminders' => false,
        'recurrence' => false,
        'status' => false,
        'title' => false,
        'updated_at' => true,
        'visibility' => true,
        'when' => false,
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var array<string, bool>
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array<string, string>
     */
    public static function openAPITypes(): array
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array<string, string>
     */
    public static function openAPIFormats(): array
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array<string, bool>
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return array<string, bool>
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param array<string, bool> $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var array<string, string>
     */
    protected static array $attributeMap = [
        'busy' => 'busy',
        'calendar_id' => 'calendar_id',
        'conferencing' => 'conferencing',
        'created_at' => 'created_at',
        'description' => 'description',
        'hide_participants' => 'hide_participants',
        'grant_id' => 'grant_id',
        'html_link' => 'html_link',
        'ical_uid' => 'ical_uid',
        'id' => 'id',
        'location' => 'location',
        'master_event_id' => 'master_event_id',
        'metadata' => 'metadata',
        'object' => 'object',
        'organizer' => 'organizer',
        'participants' => 'participants',
        'resources' => 'resources',
        'read_only' => 'read_only',
        'reminders' => 'reminders',
        'recurrence' => 'recurrence',
        'status' => 'status',
        'title' => 'title',
        'updated_at' => 'updated_at',
        'visibility' => 'visibility',
        'when' => 'when',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'busy' => 'setBusy',
        'calendar_id' => 'setCalendarId',
        'conferencing' => 'setConferencing',
        'created_at' => 'setCreatedAt',
        'description' => 'setDescription',
        'hide_participants' => 'setHideParticipants',
        'grant_id' => 'setGrantId',
        'html_link' => 'setHtmlLink',
        'ical_uid' => 'setIcalUid',
        'id' => 'setId',
        'location' => 'setLocation',
        'master_event_id' => 'setMasterEventId',
        'metadata' => 'setMetadata',
        'object' => 'setObject',
        'organizer' => 'setOrganizer',
        'participants' => 'setParticipants',
        'resources' => 'setResources',
        'read_only' => 'setReadOnly',
        'reminders' => 'setReminders',
        'recurrence' => 'setRecurrence',
        'status' => 'setStatus',
        'title' => 'setTitle',
        'updated_at' => 'setUpdatedAt',
        'visibility' => 'setVisibility',
        'when' => 'setWhen',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'busy' => 'getBusy',
        'calendar_id' => 'getCalendarId',
        'conferencing' => 'getConferencing',
        'created_at' => 'getCreatedAt',
        'description' => 'getDescription',
        'hide_participants' => 'getHideParticipants',
        'grant_id' => 'getGrantId',
        'html_link' => 'getHtmlLink',
        'ical_uid' => 'getIcalUid',
        'id' => 'getId',
        'location' => 'getLocation',
        'master_event_id' => 'getMasterEventId',
        'metadata' => 'getMetadata',
        'object' => 'getObject',
        'organizer' => 'getOrganizer',
        'participants' => 'getParticipants',
        'resources' => 'getResources',
        'read_only' => 'getReadOnly',
        'reminders' => 'getReminders',
        'recurrence' => 'getRecurrence',
        'status' => 'getStatus',
        'title' => 'getTitle',
        'updated_at' => 'getUpdatedAt',
        'visibility' => 'getVisibility',
        'when' => 'getWhen',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array<string, string>
     */
    public static function attributeMap(): array
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array<string, string>
     */
    public static function setters(): array
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array<string, string>
     */
    public static function getters(): array
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return self::$openAPIModelName;
    }

    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_MAYBE = 'maybe';
    public const VISIBILITY__PRIVATE = 'private';
    public const VISIBILITY__PUBLIC = 'public';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_CONFIRMED,
            self::STATUS_CANCELLED,
            self::STATUS_MAYBE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVisibilityAllowableValues()
    {
        return [
            self::VISIBILITY__PRIVATE,
            self::VISIBILITY__PUBLIC,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var array
     */
    protected array $container = [];

    /**
     * Constructor
     *
     * @param array $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('busy', $data ?? [], null);
        $this->setIfExists('calendar_id', $data ?? [], null);
        $this->setIfExists('conferencing', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('hide_participants', $data ?? [], null);
        $this->setIfExists('grant_id', $data ?? [], null);
        $this->setIfExists('html_link', $data ?? [], null);
        $this->setIfExists('ical_uid', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('location', $data ?? [], null);
        $this->setIfExists('master_event_id', $data ?? [], null);
        $this->setIfExists('metadata', $data ?? [], null);
        $this->setIfExists('object', $data ?? [], null);
        $this->setIfExists('organizer', $data ?? [], null);
        $this->setIfExists('participants', $data ?? [], null);
        $this->setIfExists('resources', $data ?? [], null);
        $this->setIfExists('read_only', $data ?? [], null);
        $this->setIfExists('reminders', $data ?? [], null);
        $this->setIfExists('recurrence', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('visibility', $data ?? [], null);
        $this->setIfExists('when', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, mixed $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return string[] invalid properties with reasons
     */
    public function listInvalidProperties(): array
    {
        $invalidProperties = [];

        if (! is_null($this->container['description']) && (mb_strlen($this->container['description']) > 8192)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 8192.";
        }

        if (! is_null($this->container['description']) && (mb_strlen($this->container['description']) < 0)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be bigger than or equal to 0.";
        }

        if (! is_null($this->container['id']) && (mb_strlen($this->container['id']) < 1)) {
            $invalidProperties[] = "invalid value for 'id', the character length must be bigger than or equal to 1.";
        }

        if (! is_null($this->container['participants']) && (count($this->container['participants']) < 1)) {
            $invalidProperties[] = "invalid value for 'participants', number of items must be greater than or equal to 1.";
        }

        $allowedValues = $this->getStatusAllowableValues();
        if (! is_null($this->container['status']) && ! in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if (! is_null($this->container['title']) && (mb_strlen($this->container['title']) > 1024)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be smaller than or equal to 1024.";
        }

        if (! is_null($this->container['title']) && (mb_strlen($this->container['title']) < 1)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getVisibilityAllowableValues();
        if (! is_null($this->container['visibility']) && ! in_array($this->container['visibility'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'visibility', must be one of '%s'",
                $this->container['visibility'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid(): bool
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets busy
     *
     * @return bool|null
     */
    public function getBusy(): ?bool
    {
        return $this->container['busy'];
    }

    /**
     * Sets busy
     *
     * @param bool|null $busy If `true`, shows the event's time block as `busy` on shared or public calendars. This may be called \"transparency\" in some systems.
     *
     * @return $this
     */
    public function setBusy(?bool $busy): static
    {
        if (is_null($busy)) {
            throw new InvalidArgumentException('non-nullable busy cannot be null');
        }
        $this->container['busy'] = $busy;

        return $this;
    }

    /**
     * Gets calendar_id
     *
     * @return string|null
     */
    public function getCalendarId(): ?string
    {
        return $this->container['calendar_id'];
    }

    /**
     * Sets calendar_id
     *
     * @param string|null $calendar_id The calendar ID associated with the event.
     *
     * @return $this
     */
    public function setCalendarId(?string $calendar_id): static
    {
        if (is_null($calendar_id)) {
            throw new InvalidArgumentException('non-nullable calendar_id cannot be null');
        }
        $this->container['calendar_id'] = $calendar_id;

        return $this;
    }

    /**
     * Gets conferencing
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\EventConferencing|null
     */
    public function getConferencing(): ?\JackWH\NylasV3\EmailCalendar\Model\EventConferencing
    {
        return $this->container['conferencing'];
    }

    /**
     * Sets conferencing
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventConferencing|null $conferencing conferencing
     *
     * @return $this
     */
    public function setConferencing(?\JackWH\NylasV3\EmailCalendar\Model\EventConferencing $conferencing): static
    {
        if (is_null($conferencing)) {
            throw new InvalidArgumentException('non-nullable conferencing cannot be null');
        }
        $this->container['conferencing'] = $conferencing;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param int|null $created_at When the event was created, in Unix epoch format.
     *
     * @return $this
     */
    public function setCreatedAt(?int $created_at): static
    {
        if (is_null($created_at)) {
            array_push($this->openAPINullablesSetToNull, 'created_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('created_at', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description A brief description of the event (for example, its agenda). The description might be returned as an HTML string depending on how the provider formats it.
     *
     * @return $this
     */
    public function setDescription(?string $description): static
    {
        if (is_null($description)) {
            array_push($this->openAPINullablesSetToNull, 'description');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('description', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (! is_null($description) && (mb_strlen($description) > 8192)) {
            throw new InvalidArgumentException('invalid length for $description when calling Event., must be smaller than or equal to 8192.');
        }
        if (! is_null($description) && (mb_strlen($description) < 0)) {
            throw new InvalidArgumentException('invalid length for $description when calling Event., must be bigger than or equal to 0.');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets hide_participants
     *
     * @return bool|null
     */
    public function getHideParticipants(): ?bool
    {
        return $this->container['hide_participants'];
    }

    /**
     * Sets hide_participants
     *
     * @param bool|null $hide_participants (Not supported for iCloud or EWS events) When `true`, hides the event's list of participants.
     *
     * @return $this
     */
    public function setHideParticipants(?bool $hide_participants): static
    {
        if (is_null($hide_participants)) {
            throw new InvalidArgumentException('non-nullable hide_participants cannot be null');
        }
        $this->container['hide_participants'] = $hide_participants;

        return $this;
    }

    /**
     * Gets grant_id
     *
     * @return string|null
     */
    public function getGrantId(): ?string
    {
        return $this->container['grant_id'];
    }

    /**
     * Sets grant_id
     *
     * @param string|null $grant_id The ID of the end user's grant.
     *
     * @return $this
     */
    public function setGrantId(?string $grant_id): static
    {
        if (is_null($grant_id)) {
            throw new InvalidArgumentException('non-nullable grant_id cannot be null');
        }
        $this->container['grant_id'] = $grant_id;

        return $this;
    }

    /**
     * Gets html_link
     *
     * @return string|null
     */
    public function getHtmlLink(): ?string
    {
        return $this->container['html_link'];
    }

    /**
     * Sets html_link
     *
     * @param string|null $html_link (Not supported for EWS events) A link to the event on the provider.
     *
     * @return $this
     */
    public function setHtmlLink(?string $html_link): static
    {
        if (is_null($html_link)) {
            throw new InvalidArgumentException('non-nullable html_link cannot be null');
        }
        $this->container['html_link'] = $html_link;

        return $this;
    }

    /**
     * Gets ical_uid
     *
     * @return string|null
     */
    public function getIcalUid(): ?string
    {
        return $this->container['ical_uid'];
    }

    /**
     * Sets ical_uid
     *
     * @param string|null $ical_uid A unique ID that you can use to identify events across calendaring systems, in [iCalendar format](https://datatracker.ietf.org/doc/html/rfc5545#section-3.8.4.7). Recurring events might share the same ID.  Can be `null` for events synced before the year 2020.
     *
     * @return $this
     */
    public function setIcalUid(?string $ical_uid): static
    {
        if (is_null($ical_uid)) {
            array_push($this->openAPINullablesSetToNull, 'ical_uid');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('ical_uid', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['ical_uid'] = $ical_uid;

        return $this;
    }

    /**
     * Gets id
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id The ID of the event. Generally, event IDs are unique to each user. However, Google maintains the same event ID for an event regardless of the user querying it.
     *
     * @return $this
     */
    public function setId(?string $id): static
    {
        if (is_null($id)) {
            throw new InvalidArgumentException('non-nullable id cannot be null');
        }

        if ((mb_strlen($id) < 1)) {
            throw new InvalidArgumentException('invalid length for $id when calling Event., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets location
     *
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->container['location'];
    }

    /**
     * Sets location
     *
     * @param string|null $location The location of the event (for example, a physical address or the name of a meeting room).
     *
     * @return $this
     */
    public function setLocation(?string $location): static
    {
        if (is_null($location)) {
            array_push($this->openAPINullablesSetToNull, 'location');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('location', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['location'] = $location;

        return $this;
    }

    /**
     * Gets master_event_id
     *
     * @return string|null
     */
    public function getMasterEventId(): ?string
    {
        return $this->container['master_event_id'];
    }

    /**
     * Sets master_event_id
     *
     * @param string|null $master_event_id If the event is an instance of a recurring event series, this field contains the main (master) event's ID.
     *
     * @return $this
     */
    public function setMasterEventId(?string $master_event_id): static
    {
        if (is_null($master_event_id)) {
            array_push($this->openAPINullablesSetToNull, 'master_event_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('master_event_id', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['master_event_id'] = $master_event_id;

        return $this;
    }

    /**
     * Gets metadata
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata|null
     */
    public function getMetadata(): ?\JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata|null $metadata metadata
     *
     * @return $this
     */
    public function setMetadata(?\JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata $metadata): static
    {
        if (is_null($metadata)) {
            throw new InvalidArgumentException('non-nullable metadata cannot be null');
        }
        $this->container['metadata'] = $metadata;

        return $this;
    }

    /**
     * Gets object
     *
     * @return string|null
     */
    public function getObject(): ?string
    {
        return $this->container['object'];
    }

    /**
     * Sets object
     *
     * @param string|null $object The type of object.
     *
     * @return $this
     */
    public function setObject(?string $object): static
    {
        if (is_null($object)) {
            throw new InvalidArgumentException('non-nullable object cannot be null');
        }
        $this->container['object'] = $object;

        return $this;
    }

    /**
     * Gets organizer
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\EventOrganizer|null
     */
    public function getOrganizer(): ?\JackWH\NylasV3\EmailCalendar\Model\EventOrganizer
    {
        return $this->container['organizer'];
    }

    /**
     * Sets organizer
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventOrganizer|null $organizer organizer
     *
     * @return $this
     */
    public function setOrganizer(?\JackWH\NylasV3\EmailCalendar\Model\EventOrganizer $organizer): static
    {
        if (is_null($organizer)) {
            throw new InvalidArgumentException('non-nullable organizer cannot be null');
        }
        $this->container['organizer'] = $organizer;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\EventParticipantsInner[]|null
     */
    public function getParticipants(): ?array
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventParticipantsInner[]|null $participants An array of participants invited to the event. The organizer doesn't need to be explicitly included in this list.
     *
     * @return $this
     */
    public function setParticipants(?array $participants): static
    {
        if (is_null($participants)) {
            throw new InvalidArgumentException('non-nullable participants cannot be null');
        }


        if ((count($participants) < 1)) {
            throw new InvalidArgumentException('invalid length for $participants when calling Event., number of items must be greater than or equal to 1.');
        }
        $this->container['participants'] = $participants;

        return $this;
    }

    /**
     * Gets resources
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\EventResourcesInner[]|null
     */
    public function getResources(): ?array
    {
        return $this->container['resources'];
    }

    /**
     * Sets resources
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventResourcesInner[]|null $resources An array of room resources added to the event.
     *
     * @return $this
     */
    public function setResources(?array $resources): static
    {
        if (is_null($resources)) {
            throw new InvalidArgumentException('non-nullable resources cannot be null');
        }
        $this->container['resources'] = $resources;

        return $this;
    }

    /**
     * Gets read_only
     *
     * @return bool|null
     */
    public function getReadOnly(): ?bool
    {
        return $this->container['read_only'];
    }

    /**
     * Sets read_only
     *
     * @param bool|null $read_only If `true`, indicates that the event is read-only. The provider sets the `read_only` value based on the connected calendar, and you cannot modify it.  If the calendar is read-only, all events on the calendar have `read_only` set to `true`.
     *
     * @return $this
     */
    public function setReadOnly(?bool $read_only): static
    {
        if (is_null($read_only)) {
            throw new InvalidArgumentException('non-nullable read_only cannot be null');
        }
        $this->container['read_only'] = $read_only;

        return $this;
    }

    /**
     * Gets reminders
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\EventReminders|null
     */
    public function getReminders(): ?\JackWH\NylasV3\EmailCalendar\Model\EventReminders
    {
        return $this->container['reminders'];
    }

    /**
     * Sets reminders
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventReminders|null $reminders reminders
     *
     * @return $this
     */
    public function setReminders(?\JackWH\NylasV3\EmailCalendar\Model\EventReminders $reminders): static
    {
        if (is_null($reminders)) {
            throw new InvalidArgumentException('non-nullable reminders cannot be null');
        }
        $this->container['reminders'] = $reminders;

        return $this;
    }

    /**
     * Gets recurrence
     *
     * @return string[]|null
     */
    public function getRecurrence(): ?array
    {
        return $this->container['recurrence'];
    }

    /**
     * Sets recurrence
     *
     * @param string[]|null $recurrence An array of `RRULE` and `EXDATE` strings. Nylas includes this field only if the event is the main (master) event. See [RFC-5545](https://tools.ietf.org/html/rfc5545#section-3.8.5) for more details. You can use [this tool](https://jkbrzt.github.io/rrule/) to learn more about the `RRULE` spec.  Virtual calendars don't support `DTSTART` or `TZID`.  Events inherit their timezone from the `when` object. Nylas recommends that you use the `when` object to specify the event's start and end time.  iCloud accounts do _not_ support changing an event from recurring to non-recurring. You can create, update, or delete information on recurring events.
     *
     * @return $this
     */
    public function setRecurrence(?array $recurrence): static
    {
        if (is_null($recurrence)) {
            throw new InvalidArgumentException('non-nullable recurrence cannot be null');
        }
        $this->container['recurrence'] = $recurrence;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status (Not supported for iCloud events) The status of the event.
     *
     * @return $this
     */
    public function setStatus(?string $status): static
    {
        if (is_null($status)) {
            throw new InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (! in_array($status, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The name of the event.
     *
     * @return $this
     */
    public function setTitle(?string $title): static
    {
        if (is_null($title)) {
            throw new InvalidArgumentException('non-nullable title cannot be null');
        }
        if ((mb_strlen($title) > 1024)) {
            throw new InvalidArgumentException('invalid length for $title when calling Event., must be smaller than or equal to 1024.');
        }
        if ((mb_strlen($title) < 1)) {
            throw new InvalidArgumentException('invalid length for $title when calling Event., must be bigger than or equal to 1.');
        }

        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param int|null $updated_at When the event was last updated, in Unix epoch format.
     *
     * @return $this
     */
    public function setUpdatedAt(?int $updated_at): static
    {
        if (is_null($updated_at)) {
            array_push($this->openAPINullablesSetToNull, 'updated_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('updated_at', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return string|null
     */
    public function getVisibility(): ?string
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param string|null $visibility (Not supported for iCloud events) Specifies whether the event is `public` or `private`. If not defined, Nylas uses the account's default provider settings.
     *
     * @return $this
     */
    public function setVisibility(?string $visibility): static
    {
        if (is_null($visibility)) {
            array_push($this->openAPINullablesSetToNull, 'visibility');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('visibility', $nullablesSetToNull);
            if ($index !== false) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $allowedValues = $this->getVisibilityAllowableValues();
        if (! is_null($visibility) && ! in_array($visibility, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'visibility', must be one of '%s'",
                    $visibility,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets when
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\When|null
     */
    public function getWhen(): ?\JackWH\NylasV3\EmailCalendar\Model\When
    {
        return $this->container['when'];
    }

    /**
     * Sets when
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\When|null $when when
     *
     * @return $this
     */
    public function setWhen(?\JackWH\NylasV3\EmailCalendar\Model\When $when): static
    {
        if (is_null($when)) {
            throw new InvalidArgumentException('non-nullable when cannot be null');
        }
        $this->container['when'] = $when;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return mixed|null
     */
    #[ReturnTypeWillChange]
    public function offsetGet(mixed $offset): mixed
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param int $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[ReturnTypeWillChange]
    public function jsonSerialize(): mixed
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString(): string
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue(): string
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
