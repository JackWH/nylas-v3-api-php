<?php
/**
 * GetConsolidatedOrder200ResponseAllOfData
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
 * GetConsolidatedOrder200ResponseAllOfData Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class GetConsolidatedOrder200ResponseAllOfData implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'get_consolidated_order_200_response_allOf_data';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'id' => 'string',
        'grant_id' => 'string',
        'application_id' => 'string',
        'object' => 'string',
        'created_at' => 'int',
        'updated_at' => 'int',
        'order_id' => 'string',
        'purchase_date' => '\DateTime',
        'currency' => 'string',
        'merchant_name' => 'string',
        'merchant_domain' => 'string',
        'order_total' => 'float',
        'tax_total' => 'float',
        'discount_total' => 'float',
        'shipping_total' => 'float',
        'gift_card_total' => 'float',
        'products' => '\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedOrder200ResponseAllOfDataAllOfProductsInner[]',
        'order_provider_message_ids' => 'string[]',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'id' => null,
        'grant_id' => null,
        'application_id' => null,
        'object' => null,
        'created_at' => null,
        'updated_at' => null,
        'order_id' => null,
        'purchase_date' => 'date',
        'currency' => null,
        'merchant_name' => null,
        'merchant_domain' => null,
        'order_total' => null,
        'tax_total' => null,
        'discount_total' => null,
        'shipping_total' => null,
        'gift_card_total' => null,
        'products' => null,
        'order_provider_message_ids' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'id' => false,
        'grant_id' => false,
        'application_id' => false,
        'object' => false,
        'created_at' => false,
        'updated_at' => false,
        'order_id' => false,
        'purchase_date' => false,
        'currency' => false,
        'merchant_name' => false,
        'merchant_domain' => false,
        'order_total' => false,
        'tax_total' => false,
        'discount_total' => false,
        'shipping_total' => false,
        'gift_card_total' => false,
        'products' => false,
        'order_provider_message_ids' => false,
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
        'id' => 'id',
        'grant_id' => 'grant_id',
        'application_id' => 'application_id',
        'object' => 'object',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'order_id' => 'order_id',
        'purchase_date' => 'purchase_date',
        'currency' => 'currency',
        'merchant_name' => 'merchant_name',
        'merchant_domain' => 'merchant_domain',
        'order_total' => 'order_total',
        'tax_total' => 'tax_total',
        'discount_total' => 'discount_total',
        'shipping_total' => 'shipping_total',
        'gift_card_total' => 'gift_card_total',
        'products' => 'products',
        'order_provider_message_ids' => 'order_provider_message_ids',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'id' => 'setId',
        'grant_id' => 'setGrantId',
        'application_id' => 'setApplicationId',
        'object' => 'setObject',
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'order_id' => 'setOrderId',
        'purchase_date' => 'setPurchaseDate',
        'currency' => 'setCurrency',
        'merchant_name' => 'setMerchantName',
        'merchant_domain' => 'setMerchantDomain',
        'order_total' => 'setOrderTotal',
        'tax_total' => 'setTaxTotal',
        'discount_total' => 'setDiscountTotal',
        'shipping_total' => 'setShippingTotal',
        'gift_card_total' => 'setGiftCardTotal',
        'products' => 'setProducts',
        'order_provider_message_ids' => 'setOrderProviderMessageIds',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'id' => 'getId',
        'grant_id' => 'getGrantId',
        'application_id' => 'getApplicationId',
        'object' => 'getObject',
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'order_id' => 'getOrderId',
        'purchase_date' => 'getPurchaseDate',
        'currency' => 'getCurrency',
        'merchant_name' => 'getMerchantName',
        'merchant_domain' => 'getMerchantDomain',
        'order_total' => 'getOrderTotal',
        'tax_total' => 'getTaxTotal',
        'discount_total' => 'getDiscountTotal',
        'shipping_total' => 'getShippingTotal',
        'gift_card_total' => 'getGiftCardTotal',
        'products' => 'getProducts',
        'order_provider_message_ids' => 'getOrderProviderMessageIds',
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('grant_id', $data ?? [], null);
        $this->setIfExists('application_id', $data ?? [], null);
        $this->setIfExists('object', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('order_id', $data ?? [], null);
        $this->setIfExists('purchase_date', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('merchant_name', $data ?? [], null);
        $this->setIfExists('merchant_domain', $data ?? [], null);
        $this->setIfExists('order_total', $data ?? [], null);
        $this->setIfExists('tax_total', $data ?? [], null);
        $this->setIfExists('discount_total', $data ?? [], null);
        $this->setIfExists('shipping_total', $data ?? [], null);
        $this->setIfExists('gift_card_total', $data ?? [], null);
        $this->setIfExists('products', $data ?? [], null);
        $this->setIfExists('order_provider_message_ids', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ((mb_strlen($this->container['id']) < 1)) {
            $invalidProperties[] = "invalid value for 'id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['grant_id'] === null) {
            $invalidProperties[] = "'grant_id' can't be null";
        }
        if ($this->container['application_id'] === null) {
            $invalidProperties[] = "'application_id' can't be null";
        }
        if ($this->container['object'] === null) {
            $invalidProperties[] = "'object' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['updated_at'] === null) {
            $invalidProperties[] = "'updated_at' can't be null";
        }
        if ($this->container['order_id'] === null) {
            $invalidProperties[] = "'order_id' can't be null";
        }
        if ($this->container['purchase_date'] === null) {
            $invalidProperties[] = "'purchase_date' can't be null";
        }
        if ($this->container['merchant_name'] === null) {
            $invalidProperties[] = "'merchant_name' can't be null";
        }
        if ($this->container['merchant_domain'] === null) {
            $invalidProperties[] = "'merchant_domain' can't be null";
        }
        if ($this->container['products'] === null) {
            $invalidProperties[] = "'products' can't be null";
        }
        if ($this->container['order_provider_message_ids'] === null) {
            $invalidProperties[] = "'order_provider_message_ids' can't be null";
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
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id A globally unique object identifier.
     *
     * @return $this
     */
    public function setId(string $id): static
    {
        if (is_null($id)) {
            throw new InvalidArgumentException('non-nullable id cannot be null');
        }

        if ((mb_strlen($id) < 1)) {
            throw new InvalidArgumentException('invalid length for $id when calling GetConsolidatedOrder200ResponseAllOfData., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets grant_id
     *
     * @return string
     */
    public function getGrantId(): string
    {
        return $this->container['grant_id'];
    }

    /**
     * Sets grant_id
     *
     * @param string $grant_id The ID of the end user's grant.
     *
     * @return $this
     */
    public function setGrantId(string $grant_id): static
    {
        if (is_null($grant_id)) {
            throw new InvalidArgumentException('non-nullable grant_id cannot be null');
        }
        $this->container['grant_id'] = $grant_id;

        return $this;
    }

    /**
     * Gets application_id
     *
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->container['application_id'];
    }

    /**
     * Sets application_id
     *
     * @param string $application_id A reference to the parent Application object.
     *
     * @return $this
     */
    public function setApplicationId(string $application_id): static
    {
        if (is_null($application_id)) {
            throw new InvalidArgumentException('non-nullable application_id cannot be null');
        }
        $this->container['application_id'] = $application_id;

        return $this;
    }

    /**
     * Gets object
     *
     * @return string
     */
    public function getObject(): string
    {
        return $this->container['object'];
    }

    /**
     * Sets object
     *
     * @param string $object The response object type.
     *
     * @return $this
     */
    public function setObject(string $object): static
    {
        if (is_null($object)) {
            throw new InvalidArgumentException('non-nullable object cannot be null');
        }
        $this->container['object'] = $object;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param int $created_at The time when the object was created, in Unix epoch format.
     *
     * @return $this
     */
    public function setCreatedAt(int $created_at): static
    {
        if (is_null($created_at)) {
            throw new InvalidArgumentException('non-nullable created_at cannot be null');
        }
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param int $updated_at The time when the object was last updated, in Unix epoch format.
     *
     * @return $this
     */
    public function setUpdatedAt(int $updated_at): static
    {
        if (is_null($updated_at)) {
            throw new InvalidArgumentException('non-nullable updated_at cannot be null');
        }
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets order_id
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param string $order_id The order ID generated from the merchant.
     *
     * @return $this
     */
    public function setOrderId(string $order_id): static
    {
        if (is_null($order_id)) {
            throw new InvalidArgumentException('non-nullable order_id cannot be null');
        }
        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets purchase_date
     *
     * @return \DateTime
     */
    public function getPurchaseDate(): \DateTime
    {
        return $this->container['purchase_date'];
    }

    /**
     * Sets purchase_date
     *
     * @param \DateTime $purchase_date The purchase date.
     *
     * @return $this
     */
    public function setPurchaseDate(\DateTime $purchase_date): static
    {
        if (is_null($purchase_date)) {
            throw new InvalidArgumentException('non-nullable purchase_date cannot be null');
        }
        $this->container['purchase_date'] = $purchase_date;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency The currency of the order.
     *
     * @return $this
     */
    public function setCurrency(?string $currency): static
    {
        if (is_null($currency)) {
            throw new InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets merchant_name
     *
     * @return string
     */
    public function getMerchantName(): string
    {
        return $this->container['merchant_name'];
    }

    /**
     * Sets merchant_name
     *
     * @param string $merchant_name The name of the merchant.
     *
     * @return $this
     */
    public function setMerchantName(string $merchant_name): static
    {
        if (is_null($merchant_name)) {
            throw new InvalidArgumentException('non-nullable merchant_name cannot be null');
        }
        $this->container['merchant_name'] = $merchant_name;

        return $this;
    }

    /**
     * Gets merchant_domain
     *
     * @return string
     */
    public function getMerchantDomain(): string
    {
        return $this->container['merchant_domain'];
    }

    /**
     * Sets merchant_domain
     *
     * @param string $merchant_domain The merchant's domain and top-level domain.
     *
     * @return $this
     */
    public function setMerchantDomain(string $merchant_domain): static
    {
        if (is_null($merchant_domain)) {
            throw new InvalidArgumentException('non-nullable merchant_domain cannot be null');
        }
        $this->container['merchant_domain'] = $merchant_domain;

        return $this;
    }

    /**
     * Gets order_total
     *
     * @return float|null
     */
    public function getOrderTotal(): ?float
    {
        return $this->container['order_total'];
    }

    /**
     * Sets order_total
     *
     * @param float|null $order_total The total cost of the order from the order email message.
     *
     * @return $this
     */
    public function setOrderTotal(?float $order_total): static
    {
        if (is_null($order_total)) {
            throw new InvalidArgumentException('non-nullable order_total cannot be null');
        }
        $this->container['order_total'] = $order_total;

        return $this;
    }

    /**
     * Gets tax_total
     *
     * @return float|null
     */
    public function getTaxTotal(): ?float
    {
        return $this->container['tax_total'];
    }

    /**
     * Sets tax_total
     *
     * @param float|null $tax_total The total amount paid in tax from the order email message.
     *
     * @return $this
     */
    public function setTaxTotal(?float $tax_total): static
    {
        if (is_null($tax_total)) {
            throw new InvalidArgumentException('non-nullable tax_total cannot be null');
        }
        $this->container['tax_total'] = $tax_total;

        return $this;
    }

    /**
     * Gets discount_total
     *
     * @return float|null
     */
    public function getDiscountTotal(): ?float
    {
        return $this->container['discount_total'];
    }

    /**
     * Sets discount_total
     *
     * @param float|null $discount_total The total discount amount from the order email message, if applicable.
     *
     * @return $this
     */
    public function setDiscountTotal(?float $discount_total): static
    {
        if (is_null($discount_total)) {
            throw new InvalidArgumentException('non-nullable discount_total cannot be null');
        }
        $this->container['discount_total'] = $discount_total;

        return $this;
    }

    /**
     * Gets shipping_total
     *
     * @return float|null
     */
    public function getShippingTotal(): ?float
    {
        return $this->container['shipping_total'];
    }

    /**
     * Sets shipping_total
     *
     * @param float|null $shipping_total The total cost of shipping from the order email message.
     *
     * @return $this
     */
    public function setShippingTotal(?float $shipping_total): static
    {
        if (is_null($shipping_total)) {
            throw new InvalidArgumentException('non-nullable shipping_total cannot be null');
        }
        $this->container['shipping_total'] = $shipping_total;

        return $this;
    }

    /**
     * Gets gift_card_total
     *
     * @return float|null
     */
    public function getGiftCardTotal(): ?float
    {
        return $this->container['gift_card_total'];
    }

    /**
     * Sets gift_card_total
     *
     * @param float|null $gift_card_total The total gift card amount credited, if applicable.
     *
     * @return $this
     */
    public function setGiftCardTotal(?float $gift_card_total): static
    {
        if (is_null($gift_card_total)) {
            throw new InvalidArgumentException('non-nullable gift_card_total cannot be null');
        }
        $this->container['gift_card_total'] = $gift_card_total;

        return $this;
    }

    /**
     * Gets products
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedOrder200ResponseAllOfDataAllOfProductsInner[]
     */
    public function getProducts(): array
    {
        return $this->container['products'];
    }

    /**
     * Sets products
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedOrder200ResponseAllOfDataAllOfProductsInner[] $products A list of products in the order. Nylas might return this as an empty array.
     *
     * @return $this
     */
    public function setProducts(array $products): static
    {
        if (is_null($products)) {
            throw new InvalidArgumentException('non-nullable products cannot be null');
        }
        $this->container['products'] = $products;

        return $this;
    }

    /**
     * Gets order_provider_message_ids
     *
     * @return string[]
     */
    public function getOrderProviderMessageIds(): array
    {
        return $this->container['order_provider_message_ids'];
    }

    /**
     * Sets order_provider_message_ids
     *
     * @param string[] $order_provider_message_ids order_provider_message_ids
     *
     * @return $this
     */
    public function setOrderProviderMessageIds(array $order_provider_message_ids): static
    {
        if (is_null($order_provider_message_ids)) {
            throw new InvalidArgumentException('non-nullable order_provider_message_ids cannot be null');
        }
        $this->container['order_provider_message_ids'] = $order_provider_message_ids;

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
