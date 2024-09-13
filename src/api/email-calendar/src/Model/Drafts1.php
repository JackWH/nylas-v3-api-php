<?php
/**
 * Drafts1
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
 * Drafts1 Class Doc Comment
 *
 * @description A draft of an email message. You can edit a draft until you send it as an email message.
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class Drafts1 implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'Drafts_1';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'bcc' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'body' => 'string',
        'cc' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'tracking_options' => '\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestTrackingOptions',
        'attachments' => '\JackWH\NylasV3\EmailCalendar\Model\Drafts1AttachmentsInner[]',
        'reply_to' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'reply_to_message_id' => 'string',
        'starred' => 'bool',
        'subject' => 'string',
        'to' => '\JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]',
        'custom_headers' => '\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestCustomHeadersInner[]'
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
        'tracking_options' => null,
        'attachments' => null,
        'reply_to' => null,
        'reply_to_message_id' => null,
        'starred' => null,
        'subject' => null,
        'to' => null,
        'custom_headers' => null
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
        'tracking_options' => false,
        'attachments' => false,
        'reply_to' => false,
        'reply_to_message_id' => false,
        'starred' => false,
        'subject' => false,
        'to' => false,
        'custom_headers' => false
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
        'tracking_options' => 'tracking_options',
        'attachments' => 'attachments',
        'reply_to' => 'reply_to',
        'reply_to_message_id' => 'reply_to_message_id',
        'starred' => 'starred',
        'subject' => 'subject',
        'to' => 'to',
        'custom_headers' => 'custom_headers'
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
        'tracking_options' => 'setTrackingOptions',
        'attachments' => 'setAttachments',
        'reply_to' => 'setReplyTo',
        'reply_to_message_id' => 'setReplyToMessageId',
        'starred' => 'setStarred',
        'subject' => 'setSubject',
        'to' => 'setTo',
        'custom_headers' => 'setCustomHeaders'
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
        'tracking_options' => 'getTrackingOptions',
        'attachments' => 'getAttachments',
        'reply_to' => 'getReplyTo',
        'reply_to_message_id' => 'getReplyToMessageId',
        'starred' => 'getStarred',
        'subject' => 'getSubject',
        'to' => 'getTo',
        'custom_headers' => 'getCustomHeaders'
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
        $this->setIfExists('tracking_options', $data ?? [], null);
        $this->setIfExists('attachments', $data ?? [], null);
        $this->setIfExists('reply_to', $data ?? [], null);
        $this->setIfExists('reply_to_message_id', $data ?? [], null);
        $this->setIfExists('starred', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('to', $data ?? [], null);
        $this->setIfExists('custom_headers', $data ?? [], null);
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
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $bcc The name/email address pairs of the recipients to be BCC'd.
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
     * @param string|null $body The full HTML body of the draft. Messages with only plain-text representations are up-converted to HTML.
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
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $cc The name/email address pairs of the recipients to be CC'd.
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
     * Gets tracking_options
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestTrackingOptions|null
     */
    public function getTrackingOptions(): ?\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestTrackingOptions
    {
        return $this->container['tracking_options'];
    }

    /**
     * Sets tracking_options
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestTrackingOptions|null $tracking_options tracking_options
     *
     * @return $this
     */
    public function setTrackingOptions(?\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestTrackingOptions $tracking_options): static
    {
        if (is_null($tracking_options)) {
            throw new InvalidArgumentException('non-nullable tracking_options cannot be null');
        }
        $this->container['tracking_options'] = $tracking_options;

        return $this;
    }

    /**
     * Gets attachments
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\Drafts1AttachmentsInner[]|null
     */
    public function getAttachments(): ?array
    {
        return $this->container['attachments'];
    }

    /**
     * Sets attachments
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\Drafts1AttachmentsInner[]|null $attachments An array of file attachments to include in the draft. You can use either the `application/json` or `multipart/form-data` schema, depending on attachment size. The `application/json` format is limited to 3MB including the message body, and the `content` must be Base64 encoded. The `multipart/form-data` format size is limited by the provider to 25MB.  See [Attachments](/#tag--Attachments) for more information.
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
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $reply_to An array of name/email address pairs that should receive replies to the email message. This is used to set an alternative `Reply-To` header in the sent email message. Not all providers support setting this in a Draft.
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
     * Gets reply_to_message_id
     *
     * @return string|null
     */
    public function getReplyToMessageId(): ?string
    {
        return $this->container['reply_to_message_id'];
    }

    /**
     * Sets reply_to_message_id
     *
     * @param string|null $reply_to_message_id The unique identifier of the message to which you want to draft a reply.
     *
     * @return $this
     */
    public function setReplyToMessageId(?string $reply_to_message_id): static
    {
        if (is_null($reply_to_message_id)) {
            throw new InvalidArgumentException('non-nullable reply_to_message_id cannot be null');
        }
        $this->container['reply_to_message_id'] = $reply_to_message_id;

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
     * @param bool|null $starred If `true`, the draft is starred.
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
     * @param string|null $subject The subject line of the draft.
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
     * @param \JackWH\NylasV3\EmailCalendar\Model\MessageParticipant[]|null $to The name/email address pairs of the recipients.
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
     * Gets custom_headers
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestCustomHeadersInner[]|null
     */
    public function getCustomHeaders(): ?array
    {
        return $this->container['custom_headers'];
    }

    /**
     * Sets custom_headers
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequestCustomHeadersInner[]|null $custom_headers An array of custom headers to add to the message.
     *
     * @return $this
     */
    public function setCustomHeaders(?array $custom_headers): static
    {
        if (is_null($custom_headers)) {
            throw new InvalidArgumentException('non-nullable custom_headers cannot be null');
        }
        $this->container['custom_headers'] = $custom_headers;

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


