<?php
/**
 * CleanMessages200ResponseAllOfDataInner
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
 * CleanMessages200ResponseAllOfDataInner Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class CleanMessages200ResponseAllOfDataInner implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'clean_messages_200_response_allOf_data_inner';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'bcc' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'body' => 'string',
        'cc' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'date' => 'int',
        'attachments' => '\JackWH\NylasV3\EmailCalendar\Model\MessageAttachmentsInner[]',
        'folders' => 'string[]',
        'from' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'grant_id' => 'string',
        'id' => 'string',
        'object' => 'string',
        'reply_to' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'schedule_id' => 'string',
        'snippet' => 'string',
        'starred' => 'bool',
        'subject' => 'string',
        'thread_id' => 'string',
        'to' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'unread' => 'bool',
        'use_draft' => 'bool',
        'conversation' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'bcc' => null,
        'body' => null,
        'cc' => null,
        'date' => null,
        'attachments' => null,
        'folders' => null,
        'from' => null,
        'grant_id' => null,
        'id' => null,
        'object' => null,
        'reply_to' => null,
        'schedule_id' => null,
        'snippet' => null,
        'starred' => null,
        'subject' => null,
        'thread_id' => null,
        'to' => null,
        'unread' => null,
        'use_draft' => null,
        'conversation' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'bcc' => false,
        'body' => false,
        'cc' => false,
        'date' => false,
        'attachments' => false,
        'folders' => false,
        'from' => false,
        'grant_id' => false,
        'id' => false,
        'object' => false,
        'reply_to' => false,
        'schedule_id' => false,
        'snippet' => false,
        'starred' => false,
        'subject' => false,
        'thread_id' => false,
        'to' => false,
        'unread' => false,
        'use_draft' => false,
        'conversation' => false
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
        'bcc' => 'bcc',
        'body' => 'body',
        'cc' => 'cc',
        'date' => 'date',
        'attachments' => 'attachments',
        'folders' => 'folders',
        'from' => 'from',
        'grant_id' => 'grant_id',
        'id' => 'id',
        'object' => 'object',
        'reply_to' => 'reply_to',
        'schedule_id' => 'schedule_id',
        'snippet' => 'snippet',
        'starred' => 'starred',
        'subject' => 'subject',
        'thread_id' => 'thread_id',
        'to' => 'to',
        'unread' => 'unread',
        'use_draft' => 'use_draft',
        'conversation' => 'conversation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'bcc' => 'setBcc',
        'body' => 'setBody',
        'cc' => 'setCc',
        'date' => 'setDate',
        'attachments' => 'setAttachments',
        'folders' => 'setFolders',
        'from' => 'setFrom',
        'grant_id' => 'setGrantId',
        'id' => 'setId',
        'object' => 'setObject',
        'reply_to' => 'setReplyTo',
        'schedule_id' => 'setScheduleId',
        'snippet' => 'setSnippet',
        'starred' => 'setStarred',
        'subject' => 'setSubject',
        'thread_id' => 'setThreadId',
        'to' => 'setTo',
        'unread' => 'setUnread',
        'use_draft' => 'setUseDraft',
        'conversation' => 'setConversation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'bcc' => 'getBcc',
        'body' => 'getBody',
        'cc' => 'getCc',
        'date' => 'getDate',
        'attachments' => 'getAttachments',
        'folders' => 'getFolders',
        'from' => 'getFrom',
        'grant_id' => 'getGrantId',
        'id' => 'getId',
        'object' => 'getObject',
        'reply_to' => 'getReplyTo',
        'schedule_id' => 'getScheduleId',
        'snippet' => 'getSnippet',
        'starred' => 'getStarred',
        'subject' => 'getSubject',
        'thread_id' => 'getThreadId',
        'to' => 'getTo',
        'unread' => 'getUnread',
        'use_draft' => 'getUseDraft',
        'conversation' => 'getConversation'
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
        $this->setIfExists('bcc', $data ?? [], null);
        $this->setIfExists('body', $data ?? [], null);
        $this->setIfExists('cc', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('attachments', $data ?? [], null);
        $this->setIfExists('folders', $data ?? [], null);
        $this->setIfExists('from', $data ?? [], null);
        $this->setIfExists('grant_id', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('object', $data ?? [], null);
        $this->setIfExists('reply_to', $data ?? [], null);
        $this->setIfExists('schedule_id', $data ?? [], null);
        $this->setIfExists('snippet', $data ?? [], null);
        $this->setIfExists('starred', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('thread_id', $data ?? [], null);
        $this->setIfExists('to', $data ?? [], null);
        $this->setIfExists('unread', $data ?? [], null);
        $this->setIfExists('use_draft', $data ?? [], null);
        $this->setIfExists('conversation', $data ?? [], null);
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

        if (!is_null($this->container['thread_id']) && (mb_strlen($this->container['thread_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'thread_id', the character length must be bigger than or equal to 1.";
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
     * Gets bcc
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null
     */
    public function getBcc(): ?array
    {
        return $this->container['bcc'];
    }

    /**
     * Sets bcc
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $bcc An array of name/email address pairs that the email message was BCC'd to. For received messages, this is nearly always empty.
     *
     * @return $this
     */
    public function setBcc(?array $bcc): static
    {
        if (is_null($bcc)) {
            throw new InvalidArgumentException('non-nullable bcc cannot be null');
        }
        $this->container['bcc'] = $bcc;

        return $this;
    }

    /**
     * Gets body
     *
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param string|null $body The full HTML message body. Email messages with only plain-text representations are up-converted to HTML.
     *
     * @return $this
     */
    public function setBody(?string $body): static
    {
        if (is_null($body)) {
            throw new InvalidArgumentException('non-nullable body cannot be null');
        }
        $this->container['body'] = $body;

        return $this;
    }

    /**
     * Gets cc
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null
     */
    public function getCc(): ?array
    {
        return $this->container['cc'];
    }

    /**
     * Sets cc
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $cc An array of name/email address pairs that the email message was CC'd to.
     *
     * @return $this
     */
    public function setCc(?array $cc): static
    {
        if (is_null($cc)) {
            throw new InvalidArgumentException('non-nullable cc cannot be null');
        }
        $this->container['cc'] = $cc;

        return $this;
    }

    /**
     * Gets date
     *
     * @return int|null
     */
    public function getDate(): ?int
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param int|null $date Unix timestamp that represents when _the mail server_ received the email message. This may be different from the unified `Date` header in a raw Message object.
     *
     * @return $this
     */
    public function setDate(?int $date): static
    {
        if (is_null($date)) {
            throw new InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets attachments
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageAttachmentsInner[]|null
     */
    public function getAttachments(): ?array
    {
        return $this->container['attachments'];
    }

    /**
     * Sets attachments
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageAttachmentsInner[]|null $attachments An array of Attachment objects, if the email message includes attachments.
     *
     * @return $this
     */
    public function setAttachments(?array $attachments): static
    {
        if (is_null($attachments)) {
            throw new InvalidArgumentException('non-nullable attachments cannot be null');
        }


        $this->container['attachments'] = $attachments;

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
     * @param string[]|null $folders The ID(s) of the folder(s) that the email message appears in. Microsoft messages can be in a single folder only. Google allows a single message to appear in multiple folders.
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
     * Gets from
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null
     */
    public function getFrom(): ?array
    {
        return $this->container['from'];
    }

    /**
     * Sets from
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $from A list of name/email address pairs that the email message was sent from. This is usually one pair only, but can be many.
     *
     * @return $this
     */
    public function setFrom(?array $from): static
    {
        if (is_null($from)) {
            throw new InvalidArgumentException('non-nullable from cannot be null');
        }


        $this->container['from'] = $from;

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
            throw new InvalidArgumentException('invalid length for $id when calling CleanMessages200ResponseAllOfDataInner., must be bigger than or equal to 1.');
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
     * @param string|null $object The object type of the response (in this case, `message`).
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
     * Gets reply_to
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null
     */
    public function getReplyTo(): ?array
    {
        return $this->container['reply_to'];
    }

    /**
     * Sets reply_to
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $reply_to An array of name/email address pairs that should receive replies to the email message.
     *
     * @return $this
     */
    public function setReplyTo(?array $reply_to): static
    {
        if (is_null($reply_to)) {
            throw new InvalidArgumentException('non-nullable reply_to cannot be null');
        }


        $this->container['reply_to'] = $reply_to;

        return $this;
    }

    /**
     * Gets schedule_id
     *
     * @return string|null
     */
    public function getScheduleId(): ?string
    {
        return $this->container['schedule_id'];
    }

    /**
     * Sets schedule_id
     *
     * @param string|null $schedule_id The ID of the scheduled email message. Nylas returns the `schedule_id` if `send_at` is set.
     *
     * @return $this
     */
    public function setScheduleId(?string $schedule_id): static
    {
        if (is_null($schedule_id)) {
            throw new InvalidArgumentException('non-nullable schedule_id cannot be null');
        }
        $this->container['schedule_id'] = $schedule_id;

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
     * @param string|null $snippet A short snippet (the first 100 characters, with HTML tags removed) of the email message body. This is useful for displaying a preview of the message.
     *
     * @return $this
     */
    public function setSnippet(?string $snippet): static
    {
        if (is_null($snippet)) {
            throw new InvalidArgumentException('non-nullable snippet cannot be null');
        }

        if ((mb_strlen($snippet) < 1)) {
            throw new InvalidArgumentException('invalid length for $snippet when calling CleanMessages200ResponseAllOfDataInner., must be bigger than or equal to 1.');
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
     * @param bool|null $starred If `true`, shows that the email message has been starred by the user. For EWS, this is only supported for Microsoft Exchange 2010 or later.
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
     * @param string|null $subject The subject of the email message.
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
     * Gets thread_id
     *
     * @return string|null
     */
    public function getThreadId(): ?string
    {
        return $this->container['thread_id'];
    }

    /**
     * Sets thread_id
     *
     * @param string|null $thread_id A reference to the parent Thread object. Every email message is associated with a thread, whether that thread contains only one message or many. If this is a new email message, Nylas assigns a `thread_id` to it.
     *
     * @return $this
     */
    public function setThreadId(?string $thread_id): static
    {
        if (is_null($thread_id)) {
            throw new InvalidArgumentException('non-nullable thread_id cannot be null');
        }

        if ((mb_strlen($thread_id) < 1)) {
            throw new InvalidArgumentException('invalid length for $thread_id when calling CleanMessages200ResponseAllOfDataInner., must be bigger than or equal to 1.');
        }

        $this->container['thread_id'] = $thread_id;

        return $this;
    }

    /**
     * Gets to
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null
     */
    public function getTo(): ?array
    {
        return $this->container['to'];
    }

    /**
     * Sets to
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $to An array of name/email address pairs that the email message was sent to.
     *
     * @return $this
     */
    public function setTo(?array $to): static
    {
        if (is_null($to)) {
            throw new InvalidArgumentException('non-nullable to cannot be null');
        }


        $this->container['to'] = $to;

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
     * @param bool|null $unread If `true`, shows that the email message has been read by the user.
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
     * Gets use_draft
     *
     * @return bool|null
     */
    public function getUseDraft(): ?bool
    {
        return $this->container['use_draft'];
    }

    /**
     * Sets use_draft
     *
     * @param bool|null $use_draft (Google and Microsoft only) If `true` when scheduling a message, Nylas saves the email message in the end user's Drafts folder until it's sent. For more information, see [Schedule email messages to send in the future](/docs/v3/email/scheduled-send/). The default `false` will be used if this field is omitted.
     *
     * @return $this
     */
    public function setUseDraft(?bool $use_draft): static
    {
        if (is_null($use_draft)) {
            throw new InvalidArgumentException('non-nullable use_draft cannot be null');
        }
        $this->container['use_draft'] = $use_draft;

        return $this;
    }

    /**
     * Gets conversation
     *
     * @return string|null
     */
    public function getConversation(): ?string
    {
        return $this->container['conversation'];
    }

    /**
     * Sets conversation
     *
     * @param string|null $conversation Cleaned HTML message body.
     *
     * @return $this
     */
    public function setConversation(?string $conversation): static
    {
        if (is_null($conversation)) {
            throw new InvalidArgumentException('non-nullable conversation cannot be null');
        }
        $this->container['conversation'] = $conversation;

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


