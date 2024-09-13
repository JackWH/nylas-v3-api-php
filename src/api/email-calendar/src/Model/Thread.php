<?php
/**
 * Thread
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
use JsonSerializable;
use InvalidArgumentException;
use ReturnTypeWillChange;
use JackWH\NylasV3\EmailCalendar\ObjectSerializer;

/**
 * Thread Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class Thread implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'Thread';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'grant_id' => 'string',
        'id' => 'string',
        'object' => 'string',
        'latest_draft_or_message' => '\JackWH\NylasV3\EmailCalendar\Model\Message1',
        'has_attachments' => 'bool',
        'has_drafts' => 'bool',
        'earliest_message_date' => 'int',
        'latest_message_received_date' => 'int',
        'latest_message_sent_date' => 'int',
        'participants' => '\JackWH\NylasV3\EmailCalendar\Model\ThreadParticipantsInner[]',
        'snippet' => 'string',
        'starred' => 'bool',
        'subject' => 'string',
        'unread' => 'bool',
        'message_ids' => 'string[]',
        'draft_ids' => 'string[]',
        'folders' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'grant_id' => null,
        'id' => null,
        'object' => null,
        'latest_draft_or_message' => null,
        'has_attachments' => null,
        'has_drafts' => null,
        'earliest_message_date' => null,
        'latest_message_received_date' => null,
        'latest_message_sent_date' => null,
        'participants' => null,
        'snippet' => null,
        'starred' => null,
        'subject' => null,
        'unread' => null,
        'message_ids' => null,
        'draft_ids' => null,
        'folders' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'grant_id' => false,
        'id' => false,
        'object' => false,
        'latest_draft_or_message' => false,
        'has_attachments' => false,
        'has_drafts' => false,
        'earliest_message_date' => false,
        'latest_message_received_date' => false,
        'latest_message_sent_date' => false,
        'participants' => false,
        'snippet' => false,
        'starred' => false,
        'subject' => false,
        'unread' => false,
        'message_ids' => false,
        'draft_ids' => false,
        'folders' => false
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
        'grant_id' => 'grant_id',
        'id' => 'id',
        'object' => 'object',
        'latest_draft_or_message' => 'latest_draft_or_message',
        'has_attachments' => 'has_attachments',
        'has_drafts' => 'has_drafts',
        'earliest_message_date' => 'earliest_message_date',
        'latest_message_received_date' => 'latest_message_received_date',
        'latest_message_sent_date' => 'latest_message_sent_date',
        'participants' => 'participants',
        'snippet' => 'snippet',
        'starred' => 'starred',
        'subject' => 'subject',
        'unread' => 'unread',
        'message_ids' => 'message_ids',
        'draft_ids' => 'draft_ids',
        'folders' => 'folders'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'grant_id' => 'setGrantId',
        'id' => 'setId',
        'object' => 'setObject',
        'latest_draft_or_message' => 'setLatestDraftOrMessage',
        'has_attachments' => 'setHasAttachments',
        'has_drafts' => 'setHasDrafts',
        'earliest_message_date' => 'setEarliestMessageDate',
        'latest_message_received_date' => 'setLatestMessageReceivedDate',
        'latest_message_sent_date' => 'setLatestMessageSentDate',
        'participants' => 'setParticipants',
        'snippet' => 'setSnippet',
        'starred' => 'setStarred',
        'subject' => 'setSubject',
        'unread' => 'setUnread',
        'message_ids' => 'setMessageIds',
        'draft_ids' => 'setDraftIds',
        'folders' => 'setFolders'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'grant_id' => 'getGrantId',
        'id' => 'getId',
        'object' => 'getObject',
        'latest_draft_or_message' => 'getLatestDraftOrMessage',
        'has_attachments' => 'getHasAttachments',
        'has_drafts' => 'getHasDrafts',
        'earliest_message_date' => 'getEarliestMessageDate',
        'latest_message_received_date' => 'getLatestMessageReceivedDate',
        'latest_message_sent_date' => 'getLatestMessageSentDate',
        'participants' => 'getParticipants',
        'snippet' => 'getSnippet',
        'starred' => 'getStarred',
        'subject' => 'getSubject',
        'unread' => 'getUnread',
        'message_ids' => 'getMessageIds',
        'draft_ids' => 'getDraftIds',
        'folders' => 'getFolders'
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
        $this->setIfExists('grant_id', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('object', $data ?? [], null);
        $this->setIfExists('latest_draft_or_message', $data ?? [], null);
        $this->setIfExists('has_attachments', $data ?? [], null);
        $this->setIfExists('has_drafts', $data ?? [], null);
        $this->setIfExists('earliest_message_date', $data ?? [], null);
        $this->setIfExists('latest_message_received_date', $data ?? [], null);
        $this->setIfExists('latest_message_sent_date', $data ?? [], null);
        $this->setIfExists('participants', $data ?? [], null);
        $this->setIfExists('snippet', $data ?? [], null);
        $this->setIfExists('starred', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('unread', $data ?? [], null);
        $this->setIfExists('message_ids', $data ?? [], null);
        $this->setIfExists('draft_ids', $data ?? [], null);
        $this->setIfExists('folders', $data ?? [], null);
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

        if (!is_null($this->container['id']) && (mb_strlen($this->container['id']) < 1)) {
            $invalidProperties[] = "invalid value for 'id', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['snippet']) && (mb_strlen($this->container['snippet']) < 1)) {
            $invalidProperties[] = "invalid value for 'snippet', the character length must be bigger than or equal to 1.";
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
     * @param string|null $id A globally unique object identifier.
     *
     * @return $this
     */
    public function setId(?string $id): static
    {
        if (is_null($id)) {
            throw new InvalidArgumentException('non-nullable id cannot be null');
        }

        if ((mb_strlen($id) < 1)) {
            throw new InvalidArgumentException('invalid length for $id when calling Thread., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

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
     * @param string|null $object The type of object (in this case, `thread`).
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
     * Gets latest_draft_or_message
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\Message1|null
     */
    public function getLatestDraftOrMessage(): ?\JackWH\NylasV3\EmailCalendar\Model\Message1
    {
        return $this->container['latest_draft_or_message'];
    }

    /**
     * Sets latest_draft_or_message
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\Message1|null $latest_draft_or_message latest_draft_or_message
     *
     * @return $this
     */
    public function setLatestDraftOrMessage(?\JackWH\NylasV3\EmailCalendar\Model\Message1 $latest_draft_or_message): static
    {
        if (is_null($latest_draft_or_message)) {
            throw new InvalidArgumentException('non-nullable latest_draft_or_message cannot be null');
        }
        $this->container['latest_draft_or_message'] = $latest_draft_or_message;

        return $this;
    }

    /**
     * Gets has_attachments
     *
     * @return bool|null
     */
    public function getHasAttachments(): ?bool
    {
        return $this->container['has_attachments'];
    }

    /**
     * Sets has_attachments
     *
     * @param bool|null $has_attachments When `true`, indicates that the email message has attachments.
     *
     * @return $this
     */
    public function setHasAttachments(?bool $has_attachments): static
    {
        if (is_null($has_attachments)) {
            throw new InvalidArgumentException('non-nullable has_attachments cannot be null');
        }
        $this->container['has_attachments'] = $has_attachments;

        return $this;
    }

    /**
     * Gets has_drafts
     *
     * @return bool|null
     */
    public function getHasDrafts(): ?bool
    {
        return $this->container['has_drafts'];
    }

    /**
     * Sets has_drafts
     *
     * @param bool|null $has_drafts When `true`, indicates that the email message is a draft.
     *
     * @return $this
     */
    public function setHasDrafts(?bool $has_drafts): static
    {
        if (is_null($has_drafts)) {
            throw new InvalidArgumentException('non-nullable has_drafts cannot be null');
        }
        $this->container['has_drafts'] = $has_drafts;

        return $this;
    }

    /**
     * Gets earliest_message_date
     *
     * @return int|null
     */
    public function getEarliestMessageDate(): ?int
    {
        return $this->container['earliest_message_date'];
    }

    /**
     * Sets earliest_message_date
     *
     * @param int|null $earliest_message_date The date when the earliest or first email message in the thread was sent or received, in Unix epoch format.
     *
     * @return $this
     */
    public function setEarliestMessageDate(?int $earliest_message_date): static
    {
        if (is_null($earliest_message_date)) {
            throw new InvalidArgumentException('non-nullable earliest_message_date cannot be null');
        }
        $this->container['earliest_message_date'] = $earliest_message_date;

        return $this;
    }

    /**
     * Gets latest_message_received_date
     *
     * @return int|null
     */
    public function getLatestMessageReceivedDate(): ?int
    {
        return $this->container['latest_message_received_date'];
    }

    /**
     * Sets latest_message_received_date
     *
     * @param int|null $latest_message_received_date The date when the most recent incoming email message in the thread was received, in Unix epoch format.
     *
     * @return $this
     */
    public function setLatestMessageReceivedDate(?int $latest_message_received_date): static
    {
        if (is_null($latest_message_received_date)) {
            throw new InvalidArgumentException('non-nullable latest_message_received_date cannot be null');
        }
        $this->container['latest_message_received_date'] = $latest_message_received_date;

        return $this;
    }

    /**
     * Gets latest_message_sent_date
     *
     * @return int|null
     */
    public function getLatestMessageSentDate(): ?int
    {
        return $this->container['latest_message_sent_date'];
    }

    /**
     * Sets latest_message_sent_date
     *
     * @param int|null $latest_message_sent_date The date when the most recent outgoing email message in the thread was sent, in Unix epoch format.
     *
     * @return $this
     */
    public function setLatestMessageSentDate(?int $latest_message_sent_date): static
    {
        if (is_null($latest_message_sent_date)) {
            throw new InvalidArgumentException('non-nullable latest_message_sent_date cannot be null');
        }
        $this->container['latest_message_sent_date'] = $latest_message_sent_date;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ThreadParticipantsInner[]|null
     */
    public function getParticipants(): ?array
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ThreadParticipantsInner[]|null $participants A sub-object that contains the names and email addresses of all participants in the thread.
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
     * Gets snippet
     *
     * @return string|null
     */
    public function getSnippet(): ?string
    {
        return $this->container['snippet'];
    }

    /**
     * Sets snippet
     *
     * @param string|null $snippet A short snippet (the first 100 characters, with HTML tags removed) of the body of the last received email message. This is useful for displaying a preview of an email message.
     *
     * @return $this
     */
    public function setSnippet(?string $snippet): static
    {
        if (is_null($snippet)) {
            throw new InvalidArgumentException('non-nullable snippet cannot be null');
        }

        if ((mb_strlen($snippet) < 1)) {
            throw new InvalidArgumentException('invalid length for $snippet when calling Thread., must be bigger than or equal to 1.');
        }

        $this->container['snippet'] = $snippet;

        return $this;
    }

    /**
     * Gets starred
     *
     * @return bool|null
     */
    public function getStarred(): ?bool
    {
        return $this->container['starred'];
    }

    /**
     * Sets starred
     *
     * @param bool|null $starred When `true`, indicates that the thread is starred. For EWS, this is only supported for Microsoft Exchange 2010 or later.
     *
     * @return $this
     */
    public function setStarred(?bool $starred): static
    {
        if (is_null($starred)) {
            throw new InvalidArgumentException('non-nullable starred cannot be null');
        }
        $this->container['starred'] = $starred;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string|null $subject The subject line of the thread.
     *
     * @return $this
     */
    public function setSubject(?string $subject): static
    {
        if (is_null($subject)) {
            throw new InvalidArgumentException('non-nullable subject cannot be null');
        }
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets unread
     *
     * @return bool|null
     */
    public function getUnread(): ?bool
    {
        return $this->container['unread'];
    }

    /**
     * Sets unread
     *
     * @param bool|null $unread When `false`, indicates that all email messages in the thread have been read.
     *
     * @return $this
     */
    public function setUnread(?bool $unread): static
    {
        if (is_null($unread)) {
            throw new InvalidArgumentException('non-nullable unread cannot be null');
        }
        $this->container['unread'] = $unread;

        return $this;
    }

    /**
     * Gets message_ids
     *
     * @return string[]|null
     */
    public function getMessageIds(): ?array
    {
        return $this->container['message_ids'];
    }

    /**
     * Sets message_ids
     *
     * @param string[]|null $message_ids An array of IDs for all email messages in the thread.
     *
     * @return $this
     */
    public function setMessageIds(?array $message_ids): static
    {
        if (is_null($message_ids)) {
            throw new InvalidArgumentException('non-nullable message_ids cannot be null');
        }
        $this->container['message_ids'] = $message_ids;

        return $this;
    }

    /**
     * Gets draft_ids
     *
     * @return string[]|null
     */
    public function getDraftIds(): ?array
    {
        return $this->container['draft_ids'];
    }

    /**
     * Sets draft_ids
     *
     * @param string[]|null $draft_ids An array of IDs for all drafts in the thread.
     *
     * @return $this
     */
    public function setDraftIds(?array $draft_ids): static
    {
        if (is_null($draft_ids)) {
            throw new InvalidArgumentException('non-nullable draft_ids cannot be null');
        }
        $this->container['draft_ids'] = $draft_ids;

        return $this;
    }

    /**
     * Gets folders
     *
     * @return string[]|null
     */
    public function getFolders(): ?array
    {
        return $this->container['folders'];
    }

    /**
     * Sets folders
     *
     * @param string[]|null $folders An array of folder IDs for all folders that the email messages in the thread appear in.  Microsoft email messages can only be in one folder at a time.  Google email messages can be in multiple folders.
     *
     * @return $this
     */
    public function setFolders(?array $folders): static
    {
        if (is_null($folders)) {
            throw new InvalidArgumentException('non-nullable folders cannot be null');
        }


        $this->container['folders'] = $folders;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
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
     * @param integer $offset Offset
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


