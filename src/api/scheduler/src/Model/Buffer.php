<?php
/**
 * Buffer
 *
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\Scheduler
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Nylas v3 Scheduler APIs
 *
 * <div style=\"padding:24px; background-color: #F5FFFD; border: 1px solid #00A88C; color: #161717\">This API reference documentation covers the <strong>Nylas Scheduler API</strong>. See the see the <strong><a href=\"/docs/api/v3/admin/\">Administration API documentation</a></strong> for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.</div>  The **Nylas Scheduler API** is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like `GET`, `PUT`, `POST`, and `DELETE`, and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.  ## Updating objects  `PUT` and `PATCH` requests behave similarly in Nylas v3: when you make a request, Nylas replaces all data in the nested object with the information you define. Because of this, your request might fail if you don't include all mandatory fields.  Nylas doesn't erase the data from fields that you don't include in your request, so you can define only the mandatory fields and any that you want to update.  ## Nylas Postman collection  You can use the [Nylas Postman collection](https://www.postman.com/trynylas/workspace/nylas-api/overview) to quickly start using the Nylas Scheduler API. For more information, check out the [Nylas Postman collection documentation](/docs/v3/api-references/postman/).  ## Scheduler documentation  You can find more information about Scheduler in the main documentation set:  - [Scheduler overview](/docs/v3/scheduler/) - [Scheduler Quickstart guide](/docs/v3/quickstart/scheduler/)  ## Nylas v3 encoding  Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.
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

namespace JackWH\NylasV3\Scheduler\Model;

use ArrayAccess;
use InvalidArgumentException;
use JackWH\NylasV3\Scheduler\ObjectSerializer;
use JsonSerializable;
use ReturnTypeWillChange;

/**
 * Buffer Class Doc Comment
 *
 * @description The amount of buffer time to add around existing meetings, in minutes. For example, if an account has a meeting scheduled from 10–11a.m., and you set a buffer of 30 minutes, Nylas treats 9:30–11:30a.m. as busy.
 * @package  JackWH\NylasV3\Scheduler
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class Buffer implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'buffer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'before' => 'int',
        'after' => 'int',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'before' => null,
        'after' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'before' => false,
        'after' => false,
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
        'before' => 'before',
        'after' => 'after',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'before' => 'setBefore',
        'after' => 'setAfter',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'before' => 'getBefore',
        'after' => 'getAfter',
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
        $this->setIfExists('before', $data ?? [], 0);
        $this->setIfExists('after', $data ?? [], 0);
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

        if (! is_null($this->container['before']) && ($this->container['before'] > 120)) {
            $invalidProperties[] = "invalid value for 'before', must be smaller than or equal to 120.";
        }

        if (! is_null($this->container['before']) && ($this->container['before'] < 0)) {
            $invalidProperties[] = "invalid value for 'before', must be bigger than or equal to 0.";
        }

        if (! is_null($this->container['after']) && ($this->container['after'] > 120)) {
            $invalidProperties[] = "invalid value for 'after', must be smaller than or equal to 120.";
        }

        if (! is_null($this->container['after']) && ($this->container['after'] < 0)) {
            $invalidProperties[] = "invalid value for 'after', must be bigger than or equal to 0.";
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
     * Gets before
     *
     * @return int|null
     */
    public function getBefore(): ?int
    {
        return $this->container['before'];
    }

    /**
     * Sets before
     *
     * @param int|null $before The amount of buffer time to add before meetings, in increments of five minutes. For example, if an account has a meeting scheduled from 10:00–11:00a.m., and you set a `before` buffer of 30 minutes, Nylas treats 9:30–11:00a.m. as busy.  This value must be between 0 and 120, and must be divisible by 5.
     *
     * @return $this
     */
    public function setBefore(?int $before): static
    {
        if (is_null($before)) {
            throw new InvalidArgumentException('non-nullable before cannot be null');
        }

        if (($before > 120)) {
            throw new InvalidArgumentException('invalid value for $before when calling Buffer., must be smaller than or equal to 120.');
        }
        if (($before < 0)) {
            throw new InvalidArgumentException('invalid value for $before when calling Buffer., must be bigger than or equal to 0.');
        }

        $this->container['before'] = $before;

        return $this;
    }

    /**
     * Gets after
     *
     * @return int|null
     */
    public function getAfter(): ?int
    {
        return $this->container['after'];
    }

    /**
     * Sets after
     *
     * @param int|null $after The amount of buffer time to add after meetings, in increments of five minutes. For example, if an account has a meeting scheduled from 10:00–11:00a.m., and you set an `after` buffer of 15 minutes, Nylas treats 10:00–11:15a.m. as busy.  This value must be between 0 and 120, and must be divisible by 5.
     *
     * @return $this
     */
    public function setAfter(?int $after): static
    {
        if (is_null($after)) {
            throw new InvalidArgumentException('non-nullable after cannot be null');
        }

        if (($after > 120)) {
            throw new InvalidArgumentException('invalid value for $after when calling Buffer., must be smaller than or equal to 120.');
        }
        if (($after < 0)) {
            throw new InvalidArgumentException('invalid value for $after when calling Buffer., must be bigger than or equal to 0.');
        }

        $this->container['after'] = $after;

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
