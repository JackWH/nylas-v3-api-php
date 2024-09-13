<?php
/**
 * InputPayload
 *
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\Administration
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Nylas v3 Administration APIs
 *
 * <div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Administration APIs</strong> only. See the <strong><a href=\"/docs/api/v3/ecc/\">Email, Calendar, and Contacts API reference</a></strong> for information on working with the Email, Calendar, and Contacts APIs.</div>  The **Nylas Administration APIs** are how you query and change your Nylas applications, including the application's authentication configuration, provider settings, and webhook subscriptions. You can also use Administration APIs to query your application to list the Grants (specific permissions to access user data) that are associated with each of your Nylas applications.  The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html).  You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas APIs. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).  ## Query parameters  Nylas allows you to include query parameters in `GET` requests that return a list of results. Query parameters let you narrow the results Nylas returns, meaning fewer requests to the provider and less data for your application to sift through. For more information, see [Rate limits in Nylas](/docs/dev-guide/platform/rate-limits/).  The table below shows the query parameters you can use for the `GET` requests in the Administration APIs.  | Endpoint | Query parameters | | :--- | :--- | | [`GET /v3/connectors`](/docs/api/v3/admin/#get-/v3/connectors) | `limit`, `offset` | | [`GET /v3/grants`](/docs/api/v3/admin/#get-/v3/grants) | `limit`, `offset`, `sort_by`, `order_by`, `since`, `before`, `email`, `grant_status`, `ip`, `provider` | | [`GET /v3/connectors/<PROVIDER>/creds`](/docs/api/v3/admin/#get-/v3/connectors/-provider-/creds) | `limit`, `offset`, `sort_by`, `order_by` |  You can use the `limit` parameter to set the maximum number of results Nylas returns for your request. Nylas recommends setting a lower `limit` if you encounter rate limits on the provider. For more information, see [Avoiding rate limits in Nylas](/docs/dev-guide/best-practices/rate-limits/).  ## Updating objects  `PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.  Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.  ## Authentication documentation  You can find more information about the Nylas Administration APIs in the main documentation set:  - [Authentication in v3](/docs/v3/auth/)   - [Create grants with OAuth authentication + API key](/docs/v3/auth/hosted-oauth-apikey/)   - [Create grants with OAuth authentication + Access token](/docs/v3/auth/hosted-oauth-accesstoken/)   - [Create grants with custom authentication](/docs/v3/auth/custom/) (called \"native\" authentication in v2)   - [Create grants with IMAP authentication](/docs/v3/auth/imap/) - [Bulk authentication in v3](/docs/v3/auth/bulk-auth-grants/) - [v3 event codes](/docs/v3/api-references/event-codes/) - [Virtual Calendars in v3](/docs/v3/auth/virtual-calendars/)  ## Nylas v3 encoding  Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.
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

namespace JackWH\NylasV3\Administration\Model;

use ArrayAccess;
use JsonSerializable;
use InvalidArgumentException;
use ReturnTypeWillChange;
use JackWH\NylasV3\Administration\ObjectSerializer;

/**
 * InputPayload Class Doc Comment
 *
 * @package  JackWH\NylasV3\Administration
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class InputPayload implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'Input_Payload';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'trigger_type' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'trigger_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'trigger_type' => false
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
        'trigger_type' => 'trigger_type'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'trigger_type' => 'setTriggerType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'trigger_type' => 'getTriggerType'
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

    public const TRIGGER_TYPE_CALENDAR_CREATED = 'calendar.created';
    public const TRIGGER_TYPE_CALENDAR_UPDATED = 'calendar.updated';
    public const TRIGGER_TYPE_CALENDAR_DELETED = 'calendar.deleted';
    public const TRIGGER_TYPE_EVENT_CREATED = 'event.created';
    public const TRIGGER_TYPE_EVENT_UPDATED = 'event.updated';
    public const TRIGGER_TYPE_EVENT_DELETED = 'event.deleted';
    public const TRIGGER_TYPE_GRANT_CREATED = 'grant.created';
    public const TRIGGER_TYPE_GRANT_UPDATED = 'grant.updated';
    public const TRIGGER_TYPE_GRANT_DELETED = 'grant.deleted';
    public const TRIGGER_TYPE_GRANT_EXPIRED = 'grant.expired';
    public const TRIGGER_TYPE_MESSAGE_SEND_SUCCESS = 'message.send_success';
    public const TRIGGER_TYPE_MESSAGE_SEND_FAILED = 'message.send_failed';
    public const TRIGGER_TYPE_MESSAGE_BOUNCE_DETECTED = 'message.bounce_detected';
    public const TRIGGER_TYPE_MESSAGE_CREATED = 'message.created';
    public const TRIGGER_TYPE_MESSAGE_CREATED_TRUNCATED = 'message.created.truncated';
    public const TRIGGER_TYPE_MESSAGE_UPDATED = 'message.updated';
    public const TRIGGER_TYPE_MESSAGE_UPDATED_TRUNCATED = 'message.updated.truncated';
    public const TRIGGER_TYPE_CONTACT_UPDATED = 'contact.updated';
    public const TRIGGER_TYPE_CONTACT_DELETED = 'contact.deleted';
    public const TRIGGER_TYPE_FOLDER_CREATED = 'folder.created';
    public const TRIGGER_TYPE_FOLDER_UPDATED = 'folder.updated';
    public const TRIGGER_TYPE_FOLDER_DELETED = 'folder.deleted';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTriggerTypeAllowableValues()
    {
        return [
            self::TRIGGER_TYPE_CALENDAR_CREATED,
            self::TRIGGER_TYPE_CALENDAR_UPDATED,
            self::TRIGGER_TYPE_CALENDAR_DELETED,
            self::TRIGGER_TYPE_EVENT_CREATED,
            self::TRIGGER_TYPE_EVENT_UPDATED,
            self::TRIGGER_TYPE_EVENT_DELETED,
            self::TRIGGER_TYPE_GRANT_CREATED,
            self::TRIGGER_TYPE_GRANT_UPDATED,
            self::TRIGGER_TYPE_GRANT_DELETED,
            self::TRIGGER_TYPE_GRANT_EXPIRED,
            self::TRIGGER_TYPE_MESSAGE_SEND_SUCCESS,
            self::TRIGGER_TYPE_MESSAGE_SEND_FAILED,
            self::TRIGGER_TYPE_MESSAGE_BOUNCE_DETECTED,
            self::TRIGGER_TYPE_MESSAGE_CREATED,
            self::TRIGGER_TYPE_MESSAGE_CREATED_TRUNCATED,
            self::TRIGGER_TYPE_MESSAGE_UPDATED,
            self::TRIGGER_TYPE_MESSAGE_UPDATED_TRUNCATED,
            self::TRIGGER_TYPE_CONTACT_UPDATED,
            self::TRIGGER_TYPE_CONTACT_DELETED,
            self::TRIGGER_TYPE_FOLDER_CREATED,
            self::TRIGGER_TYPE_FOLDER_UPDATED,
            self::TRIGGER_TYPE_FOLDER_DELETED,
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
        $this->setIfExists('trigger_type', $data ?? [], null);
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

        if ($this->container['trigger_type'] === null) {
            $invalidProperties[] = "'trigger_type' can't be null";
        }
        $allowedValues = $this->getTriggerTypeAllowableValues();
        if (!is_null($this->container['trigger_type']) && !in_array($this->container['trigger_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'trigger_type', must be one of '%s'",
                $this->container['trigger_type'],
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
     * Gets trigger_type
     *
     * @return string
     */
    public function getTriggerType(): string
    {
        return $this->container['trigger_type'];
    }

    /**
     * Sets trigger_type
     *
     * @param string $trigger_type Select the event that triggers the webhook. See the [notification schema documentation](/docs/v3/notifications/notification-schemas/) for details about each trigger type.  See the [Calendar](/docs/api/v3/ecc/#tag--Calendar), [Events](/docs/api/v3/ecc/#tag--Events), [Grants](/docs/api/v3/admin/#tag--Grants), and [Messages](/docs/api/v3/ecc/#tag--Messages) reference documentation for details on how to trigger each event type.  You can also test the `message.created.truncated` and `message.updated.truncated` webhooks using this endpoint. For more information about truncated webhook notifications, see the [Webhooks documentation](/docs/v3/notifications/webhooks/#truncated-webhooks).
     *
     * @return $this
     */
    public function setTriggerType(string $trigger_type): static
    {
        if (is_null($trigger_type)) {
            throw new InvalidArgumentException('non-nullable trigger_type cannot be null');
        }
        $allowedValues = $this->getTriggerTypeAllowableValues();
        if (!in_array($trigger_type, $allowedValues, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'trigger_type', must be one of '%s'",
                    $trigger_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['trigger_type'] = $trigger_type;

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


