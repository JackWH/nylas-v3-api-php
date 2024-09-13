<?php
/**
 * When1
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
 * When1 Class Doc Comment
 *
 * @description An object that represents the time and duration of an event.  You can format &#x60;when&#x60; as one of four sub-objects: &#x60;time&#x60;, &#x60;timespan&#x60;, &#x60;date&#x60;, or &#x60;datespan&#x60;. These sub-objects allow you to capture and represent specific points in time.  &#x60;time&#x60; and &#x60;timespan&#x60; objects include optional timezone support.
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class When1 implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'When_1';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'time' => 'int',
        'timezone' => 'string',
        'start_time' => 'int',
        'end_time' => 'int',
        'start_timezone' => 'string',
        'end_timezone' => 'string',
        'date' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'time' => null,
        'timezone' => null,
        'start_time' => null,
        'end_time' => null,
        'start_timezone' => null,
        'end_timezone' => null,
        'date' => null,
        'start_date' => null,
        'end_date' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'time' => false,
        'timezone' => false,
        'start_time' => false,
        'end_time' => false,
        'start_timezone' => false,
        'end_timezone' => false,
        'date' => false,
        'start_date' => false,
        'end_date' => false,
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
        'time' => 'time',
        'timezone' => 'timezone',
        'start_time' => 'start_time',
        'end_time' => 'end_time',
        'start_timezone' => 'start_timezone',
        'end_timezone' => 'end_timezone',
        'date' => 'date',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'time' => 'setTime',
        'timezone' => 'setTimezone',
        'start_time' => 'setStartTime',
        'end_time' => 'setEndTime',
        'start_timezone' => 'setStartTimezone',
        'end_timezone' => 'setEndTimezone',
        'date' => 'setDate',
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'time' => 'getTime',
        'timezone' => 'getTimezone',
        'start_time' => 'getStartTime',
        'end_time' => 'getEndTime',
        'start_timezone' => 'getStartTimezone',
        'end_timezone' => 'getEndTimezone',
        'date' => 'getDate',
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
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
        $this->setIfExists('time', $data ?? [], null);
        $this->setIfExists('timezone', $data ?? [], null);
        $this->setIfExists('start_time', $data ?? [], null);
        $this->setIfExists('end_time', $data ?? [], null);
        $this->setIfExists('start_timezone', $data ?? [], null);
        $this->setIfExists('end_timezone', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('start_date', $data ?? [], null);
        $this->setIfExists('end_date', $data ?? [], null);
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

        if (! is_null($this->container['start_timezone']) && (mb_strlen($this->container['start_timezone']) < 1)) {
            $invalidProperties[] = "invalid value for 'start_timezone', the character length must be bigger than or equal to 1.";
        }

        if (! is_null($this->container['end_timezone']) && (mb_strlen($this->container['end_timezone']) < 1)) {
            $invalidProperties[] = "invalid value for 'end_timezone', the character length must be bigger than or equal to 1.";
        }

        if (! is_null($this->container['start_date']) && (mb_strlen($this->container['start_date']) < 1)) {
            $invalidProperties[] = "invalid value for 'start_date', the character length must be bigger than or equal to 1.";
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
     * Gets time
     *
     * @return int|null
     */
    public function getTime(): ?int
    {
        return $this->container['time'];
    }

    /**
     * Sets time
     *
     * @param int|null $time The time that the meeting occurs, in Unix epoch format.
     *
     * @return $this
     */
    public function setTime(?int $time): static
    {
        if (is_null($time)) {
            throw new InvalidArgumentException('non-nullable time cannot be null');
        }
        $this->container['time'] = $time;

        return $this;
    }

    /**
     * Gets timezone
     *
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        return $this->container['timezone'];
    }

    /**
     * Sets timezone
     *
     * @param string|null $timezone The timezone of the event as an [IANA-formatted](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones) string. If populated, Nylas reads the value of `time` with the provided timezone.
     *
     * @return $this
     */
    public function setTimezone(?string $timezone): static
    {
        if (is_null($timezone)) {
            throw new InvalidArgumentException('non-nullable timezone cannot be null');
        }
        $this->container['timezone'] = $timezone;

        return $this;
    }

    /**
     * Gets start_time
     *
     * @return int|null
     */
    public function getStartTime(): ?int
    {
        return $this->container['start_time'];
    }

    /**
     * Sets start_time
     *
     * @param int|null $start_time The event's start time, in Unix epoch format.
     *
     * @return $this
     */
    public function setStartTime(?int $start_time): static
    {
        if (is_null($start_time)) {
            throw new InvalidArgumentException('non-nullable start_time cannot be null');
        }
        $this->container['start_time'] = $start_time;

        return $this;
    }

    /**
     * Gets end_time
     *
     * @return int|null
     */
    public function getEndTime(): ?int
    {
        return $this->container['end_time'];
    }

    /**
     * Sets end_time
     *
     * @param int|null $end_time The event's end time, in Unix epoch format.
     *
     * @return $this
     */
    public function setEndTime(?int $end_time): static
    {
        if (is_null($end_time)) {
            throw new InvalidArgumentException('non-nullable end_time cannot be null');
        }
        $this->container['end_time'] = $end_time;

        return $this;
    }

    /**
     * Gets start_timezone
     *
     * @return string|null
     */
    public function getStartTimezone(): ?string
    {
        return $this->container['start_timezone'];
    }

    /**
     * Sets start_timezone
     *
     * @param string|null $start_timezone The timezone of the event's `start_time` as an [IANA-formatted](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones) string.  If you define `start_timezone` in your request, you must also define `end_timezone`.
     *
     * @return $this
     */
    public function setStartTimezone(?string $start_timezone): static
    {
        if (is_null($start_timezone)) {
            throw new InvalidArgumentException('non-nullable start_timezone cannot be null');
        }

        if ((mb_strlen($start_timezone) < 1)) {
            throw new InvalidArgumentException('invalid length for $start_timezone when calling When1., must be bigger than or equal to 1.');
        }

        $this->container['start_timezone'] = $start_timezone;

        return $this;
    }

    /**
     * Gets end_timezone
     *
     * @return string|null
     */
    public function getEndTimezone(): ?string
    {
        return $this->container['end_timezone'];
    }

    /**
     * Sets end_timezone
     *
     * @param string|null $end_timezone The timezone of the event's `end_time` as an [IANA-formatted](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones) string.  If you define `end_timezone` in your request, you must also define `start_timezone`.
     *
     * @return $this
     */
    public function setEndTimezone(?string $end_timezone): static
    {
        if (is_null($end_timezone)) {
            throw new InvalidArgumentException('non-nullable end_timezone cannot be null');
        }

        if ((mb_strlen($end_timezone) < 1)) {
            throw new InvalidArgumentException('invalid length for $end_timezone when calling When1., must be bigger than or equal to 1.');
        }

        $this->container['end_timezone'] = $end_timezone;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date The date of the event, in [ISO 8601 format](https://en.wikipedia.org/wiki/ISO_8601#Calendar_dates).
     *
     * @return $this
     */
    public function setDate(?string $date): static
    {
        if (is_null($date)) {
            throw new InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string|null $start_date The event's start date, in [ISO 8601 format](https://en.wikipedia.org/wiki/ISO_8601#Calendar_dates).
     *
     * @return $this
     */
    public function setStartDate(?string $start_date): static
    {
        if (is_null($start_date)) {
            throw new InvalidArgumentException('non-nullable start_date cannot be null');
        }

        if ((mb_strlen($start_date) < 1)) {
            throw new InvalidArgumentException('invalid length for $start_date when calling When1., must be bigger than or equal to 1.');
        }

        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string|null $end_date The event's end date, in [ISO 8601 format](https://en.wikipedia.org/wiki/ISO_8601#Calendar_dates).
     *
     * @return $this
     */
    public function setEndDate(?string $end_date): static
    {
        if (is_null($end_date)) {
            throw new InvalidArgumentException('non-nullable end_date cannot be null');
        }
        $this->container['end_date'] = $end_date;

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
