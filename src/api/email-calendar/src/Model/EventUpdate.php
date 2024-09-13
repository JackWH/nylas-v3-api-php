<?php
/**
 * EventUpdate
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
 * EventUpdate Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class EventUpdate implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'event_update';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'busy' => 'bool',
        'capacity' => 'int',
        'conferencing' => '\JackWH\NylasV3\EmailCalendar\Model\CreateEventConferencing',
        'description' => 'string',
        'hide_participants' => 'bool',
        'location' => 'string',
        'metadata' => '\JackWH\NylasV3\EmailCalendar\Model\CalendarMetadata',
        'participants' => '\JackWH\NylasV3\EmailCalendar\Model\CreateEventParticipantsInner[]',
        'resources' => '\JackWH\NylasV3\EmailCalendar\Model\EventResourcesInner[]',
        'recurrence' => 'string[]',
        'reminders' => '\JackWH\NylasV3\EmailCalendar\Model\EventReminders',
        'title' => 'string',
        'visibility' => 'string',
        'when' => '\JackWH\NylasV3\EmailCalendar\Model\When1',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'busy' => null,
        'capacity' => null,
        'conferencing' => null,
        'description' => null,
        'hide_participants' => null,
        'location' => null,
        'metadata' => null,
        'participants' => null,
        'resources' => null,
        'recurrence' => null,
        'reminders' => null,
        'title' => null,
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
        'capacity' => false,
        'conferencing' => false,
        'description' => false,
        'hide_participants' => false,
        'location' => false,
        'metadata' => false,
        'participants' => false,
        'resources' => false,
        'recurrence' => false,
        'reminders' => false,
        'title' => false,
        'visibility' => false,
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
        'capacity' => 'capacity',
        'conferencing' => 'conferencing',
        'description' => 'description',
        'hide_participants' => 'hide_participants',
        'location' => 'location',
        'metadata' => 'metadata',
        'participants' => 'participants',
        'resources' => 'resources',
        'recurrence' => 'recurrence',
        'reminders' => 'reminders',
        'title' => 'title',
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
        'capacity' => 'setCapacity',
        'conferencing' => 'setConferencing',
        'description' => 'setDescription',
        'hide_participants' => 'setHideParticipants',
        'location' => 'setLocation',
        'metadata' => 'setMetadata',
        'participants' => 'setParticipants',
        'resources' => 'setResources',
        'recurrence' => 'setRecurrence',
        'reminders' => 'setReminders',
        'title' => 'setTitle',
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
        'capacity' => 'getCapacity',
        'conferencing' => 'getConferencing',
        'description' => 'getDescription',
        'hide_participants' => 'getHideParticipants',
        'location' => 'getLocation',
        'metadata' => 'getMetadata',
        'participants' => 'getParticipants',
        'resources' => 'getResources',
        'recurrence' => 'getRecurrence',
        'reminders' => 'getReminders',
        'title' => 'getTitle',
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

    public const VISIBILITY__PUBLIC = 'public';
    public const VISIBILITY__PRIVATE = 'private';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVisibilityAllowableValues()
    {
        return [
            self::VISIBILITY__PUBLIC,
            self::VISIBILITY__PRIVATE,
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
        $this->setIfExists('capacity', $data ?? [], null);
        $this->setIfExists('conferencing', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('hide_participants', $data ?? [], null);
        $this->setIfExists('location', $data ?? [], null);
        $this->setIfExists('metadata', $data ?? [], null);
        $this->setIfExists('participants', $data ?? [], null);
        $this->setIfExists('resources', $data ?? [], null);
        $this->setIfExists('recurrence', $data ?? [], null);
        $this->setIfExists('reminders', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
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

        if (! is_null($this->container['location']) && (mb_strlen($this->container['location']) > 255)) {
            $invalidProperties[] = "invalid value for 'location', the character length must be smaller than or equal to 255.";
        }

        if (! is_null($this->container['title']) && (mb_strlen($this->container['title']) > 1024)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be smaller than or equal to 1024.";
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
     * @param bool|null $busy If `true`, shows the event's time block as \"busy\" on shared or public calendars. This might be called \"transparency\" in some systems.
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
     * Gets capacity
     *
     * @return int|null
     */
    public function getCapacity(): ?int
    {
        return $this->container['capacity'];
    }

    /**
     * Sets capacity
     *
     * @param int|null $capacity The maximum number of participants that may attend the event.
     *
     * @return $this
     */
    public function setCapacity(?int $capacity): static
    {
        if (is_null($capacity)) {
            throw new InvalidArgumentException('non-nullable capacity cannot be null');
        }
        $this->container['capacity'] = $capacity;

        return $this;
    }

    /**
     * Gets conferencing
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\CreateEventConferencing|null
     */
    public function getConferencing(): ?\JackWH\NylasV3\EmailCalendar\Model\CreateEventConferencing
    {
        return $this->container['conferencing'];
    }

    /**
     * Sets conferencing
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\CreateEventConferencing|null $conferencing conferencing
     *
     * @return $this
     */
    public function setConferencing(?\JackWH\NylasV3\EmailCalendar\Model\CreateEventConferencing $conferencing): static
    {
        if (is_null($conferencing)) {
            throw new InvalidArgumentException('non-nullable conferencing cannot be null');
        }
        $this->container['conferencing'] = $conferencing;

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
            throw new InvalidArgumentException('non-nullable description cannot be null');
        }
        if ((mb_strlen($description) > 8192)) {
            throw new InvalidArgumentException('invalid length for $description when calling EventUpdate., must be smaller than or equal to 8192.');
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
     * @param bool|null $hide_participants When `true`, hides the event's list of participants.
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
            throw new InvalidArgumentException('non-nullable location cannot be null');
        }
        if ((mb_strlen($location) > 255)) {
            throw new InvalidArgumentException('invalid length for $location when calling EventUpdate., must be smaller than or equal to 255.');
        }

        $this->container['location'] = $location;

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
     * Gets participants
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\CreateEventParticipantsInner[]|null
     */
    public function getParticipants(): ?array
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\CreateEventParticipantsInner[]|null $participants participants
     *
     * @return $this
     */
    public function setParticipants(?array $participants): static
    {
        if (is_null($participants)) {
            throw new InvalidArgumentException('non-nullable participants cannot be null');
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
     * @param \JackWH\NylasV3\EmailCalendar\Model\EventResourcesInner[]|null $resources resources
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
            throw new InvalidArgumentException('invalid length for $title when calling EventUpdate., must be smaller than or equal to 1024.');
        }

        $this->container['title'] = $title;

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
     * @param string|null $visibility The event's visibility. If not defined, Nylas uses the calendar's default settings.
     *
     * @return $this
     */
    public function setVisibility(?string $visibility): static
    {
        if (is_null($visibility)) {
            throw new InvalidArgumentException('non-nullable visibility cannot be null');
        }
        $allowedValues = $this->getVisibilityAllowableValues();
        if (! in_array($visibility, $allowedValues, true)) {
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
     * @return \JackWH\NylasV3\EmailCalendar\Model\When1|null
     */
    public function getWhen(): ?\JackWH\NylasV3\EmailCalendar\Model\When1
    {
        return $this->container['when'];
    }

    /**
     * Sets when
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\When1|null $when when
     *
     * @return $this
     */
    public function setWhen(?\JackWH\NylasV3\EmailCalendar\Model\When1 $when): static
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
