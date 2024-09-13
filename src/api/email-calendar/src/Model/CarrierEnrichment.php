<?php
/**
 * CarrierEnrichment
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
 * CarrierEnrichment Class Doc Comment
 *
 * @description
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class CarrierEnrichment implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'carrier_enrichment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'delivery_date' => 'int',
        'delivery_estimate' => 'int',
        'delivery_status' => '\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus',
        'sihp_to_address' => '\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress',
        'package_activity' => '\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentPackageActivityInner[]',
        'service_type' => 'string',
        'signature_required' => 'bool',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'delivery_date' => null,
        'delivery_estimate' => null,
        'delivery_status' => null,
        'sihp_to_address' => null,
        'package_activity' => null,
        'service_type' => null,
        'signature_required' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'delivery_date' => false,
        'delivery_estimate' => false,
        'delivery_status' => false,
        'sihp_to_address' => false,
        'package_activity' => false,
        'service_type' => false,
        'signature_required' => false,
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
        'delivery_date' => 'delivery_date',
        'delivery_estimate' => 'delivery_estimate',
        'delivery_status' => 'delivery_status',
        'sihp_to_address' => 'sihp_to_address',
        'package_activity' => 'package_activity',
        'service_type' => 'service_type',
        'signature_required' => 'signature_required',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'delivery_date' => 'setDeliveryDate',
        'delivery_estimate' => 'setDeliveryEstimate',
        'delivery_status' => 'setDeliveryStatus',
        'sihp_to_address' => 'setSihpToAddress',
        'package_activity' => 'setPackageActivity',
        'service_type' => 'setServiceType',
        'signature_required' => 'setSignatureRequired',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'delivery_date' => 'getDeliveryDate',
        'delivery_estimate' => 'getDeliveryEstimate',
        'delivery_status' => 'getDeliveryStatus',
        'sihp_to_address' => 'getSihpToAddress',
        'package_activity' => 'getPackageActivity',
        'service_type' => 'getServiceType',
        'signature_required' => 'getSignatureRequired',
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
        $this->setIfExists('delivery_date', $data ?? [], null);
        $this->setIfExists('delivery_estimate', $data ?? [], null);
        $this->setIfExists('delivery_status', $data ?? [], null);
        $this->setIfExists('sihp_to_address', $data ?? [], null);
        $this->setIfExists('package_activity', $data ?? [], null);
        $this->setIfExists('service_type', $data ?? [], null);
        $this->setIfExists('signature_required', $data ?? [], null);
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

        if ($this->container['delivery_date'] === null) {
            $invalidProperties[] = "'delivery_date' can't be null";
        }
        if ($this->container['delivery_estimate'] === null) {
            $invalidProperties[] = "'delivery_estimate' can't be null";
        }
        if ($this->container['delivery_status'] === null) {
            $invalidProperties[] = "'delivery_status' can't be null";
        }
        if ($this->container['package_activity'] === null) {
            $invalidProperties[] = "'package_activity' can't be null";
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
     * Gets delivery_date
     *
     * @return int
     */
    public function getDeliveryDate(): int
    {
        return $this->container['delivery_date'];
    }

    /**
     * Sets delivery_date
     *
     * @param int $delivery_date The date the shipment was delivered, in Unix epoch format.
     *
     * @return $this
     */
    public function setDeliveryDate(int $delivery_date): static
    {
        if (is_null($delivery_date)) {
            throw new InvalidArgumentException('non-nullable delivery_date cannot be null');
        }
        $this->container['delivery_date'] = $delivery_date;

        return $this;
    }

    /**
     * Gets delivery_estimate
     *
     * @return int
     */
    public function getDeliveryEstimate(): int
    {
        return $this->container['delivery_estimate'];
    }

    /**
     * Sets delivery_estimate
     *
     * @param int $delivery_estimate The estimated delivery date, in Unix epoch format.
     *
     * @return $this
     */
    public function setDeliveryEstimate(int $delivery_estimate): static
    {
        if (is_null($delivery_estimate)) {
            throw new InvalidArgumentException('non-nullable delivery_estimate cannot be null');
        }
        $this->container['delivery_estimate'] = $delivery_estimate;

        return $this;
    }

    /**
     * Gets delivery_status
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus
     */
    public function getDeliveryStatus(): \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus
    {
        return $this->container['delivery_status'];
    }

    /**
     * Sets delivery_status
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus $delivery_status delivery_status
     *
     * @return $this
     */
    public function setDeliveryStatus(\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentDeliveryStatus $delivery_status): static
    {
        if (is_null($delivery_status)) {
            throw new InvalidArgumentException('non-nullable delivery_status cannot be null');
        }
        $this->container['delivery_status'] = $delivery_status;

        return $this;
    }

    /**
     * Gets sihp_to_address
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress|null
     */
    public function getSihpToAddress(): ?\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress
    {
        return $this->container['sihp_to_address'];
    }

    /**
     * Sets sihp_to_address
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress|null $sihp_to_address sihp_to_address
     *
     * @return $this
     */
    public function setSihpToAddress(?\JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentSihpToAddress $sihp_to_address): static
    {
        if (is_null($sihp_to_address)) {
            throw new InvalidArgumentException('non-nullable sihp_to_address cannot be null');
        }
        $this->container['sihp_to_address'] = $sihp_to_address;

        return $this;
    }

    /**
     * Gets package_activity
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentPackageActivityInner[]
     */
    public function getPackageActivity(): array
    {
        return $this->container['package_activity'];
    }

    /**
     * Sets package_activity
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\GetConsolidatedShipment200ResponseAllOfDataAllOfCarrierEnrichmentPackageActivityInner[] $package_activity A list of activities the shipment has undergone.
     *
     * @return $this
     */
    public function setPackageActivity(array $package_activity): static
    {
        if (is_null($package_activity)) {
            throw new InvalidArgumentException('non-nullable package_activity cannot be null');
        }
        $this->container['package_activity'] = $package_activity;

        return $this;
    }

    /**
     * Gets service_type
     *
     * @return string|null
     */
    public function getServiceType(): ?string
    {
        return $this->container['service_type'];
    }

    /**
     * Sets service_type
     *
     * @param string|null $service_type The type of service used to ship the package.
     *
     * @return $this
     */
    public function setServiceType(?string $service_type): static
    {
        if (is_null($service_type)) {
            throw new InvalidArgumentException('non-nullable service_type cannot be null');
        }
        $this->container['service_type'] = $service_type;

        return $this;
    }

    /**
     * Gets signature_required
     *
     * @return bool|null
     */
    public function getSignatureRequired(): ?bool
    {
        return $this->container['signature_required'];
    }

    /**
     * Sets signature_required
     *
     * @param bool|null $signature_required If `true`, indicates that a signature is required for the package.
     *
     * @return $this
     */
    public function setSignatureRequired(?bool $signature_required): static
    {
        if (is_null($signature_required)) {
            throw new InvalidArgumentException('non-nullable signature_required cannot be null');
        }
        $this->container['signature_required'] = $signature_required;

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
