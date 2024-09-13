<?php
/**
 * PostConfigurations200Response
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
 * PostConfigurations200Response Class Doc Comment
 *
 * @package  JackWH\NylasV3\Scheduler
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class PostConfigurations200Response implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'post_configurations_200_response';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'id' => 'string',
        'slug' => 'string',
        'requires_session_auth' => 'bool',
        'participants' => '\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerParticipantsInner[]',
        'availability' => '\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAvailability',
        'event_booking' => '\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerEventBooking',
        'scheduler' => '\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerScheduler',
        'appearance' => 'array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAppearanceValue>',
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'id' => null,
        'slug' => null,
        'requires_session_auth' => null,
        'participants' => null,
        'availability' => null,
        'event_booking' => null,
        'scheduler' => null,
        'appearance' => null,
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'id' => false,
        'slug' => false,
        'requires_session_auth' => false,
        'participants' => false,
        'availability' => false,
        'event_booking' => false,
        'scheduler' => false,
        'appearance' => false,
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
        'id' => 'ID',
        'slug' => 'slug',
        'requires_session_auth' => 'requires_session_auth',
        'participants' => 'participants',
        'availability' => 'availability',
        'event_booking' => 'event_booking',
        'scheduler' => 'scheduler',
        'appearance' => 'appearance',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'id' => 'setId',
        'slug' => 'setSlug',
        'requires_session_auth' => 'setRequiresSessionAuth',
        'participants' => 'setParticipants',
        'availability' => 'setAvailability',
        'event_booking' => 'setEventBooking',
        'scheduler' => 'setScheduler',
        'appearance' => 'setAppearance',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'id' => 'getId',
        'slug' => 'getSlug',
        'requires_session_auth' => 'getRequiresSessionAuth',
        'participants' => 'getParticipants',
        'availability' => 'getAvailability',
        'event_booking' => 'getEventBooking',
        'scheduler' => 'getScheduler',
        'appearance' => 'getAppearance',
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
        $this->setIfExists('slug', $data ?? [], null);
        $this->setIfExists('requires_session_auth', $data ?? [], false);
        $this->setIfExists('participants', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('event_booking', $data ?? [], null);
        $this->setIfExists('scheduler', $data ?? [], null);
        $this->setIfExists('appearance', $data ?? [], null);
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

        if ($this->container['participants'] === null) {
            $invalidProperties[] = "'participants' can't be null";
        }
        if ($this->container['availability'] === null) {
            $invalidProperties[] = "'availability' can't be null";
        }
        if ($this->container['event_booking'] === null) {
            $invalidProperties[] = "'event_booking' can't be null";
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
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id The Configuration object ID.
     *
     * @return $this
     */
    public function setId(?string $id): static
    {
        if (is_null($id)) {
            throw new InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets slug
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string|null $slug The slug of the Configuration object. This is an optional, unique identifier for the Configuration object, and you can use the slug instead of the `configuration_id` when making requests to other Scheduling endpoints. Slugs are unique to the Nylas application.
     *
     * @return $this
     */
    public function setSlug(?string $slug): static
    {
        if (is_null($slug)) {
            throw new InvalidArgumentException('non-nullable slug cannot be null');
        }
        $this->container['slug'] = $slug;

        return $this;
    }

    /**
     * Gets requires_session_auth
     *
     * @return bool|null
     */
    public function getRequiresSessionAuth(): ?bool
    {
        return $this->container['requires_session_auth'];
    }

    /**
     * Sets requires_session_auth
     *
     * @param bool|null $requires_session_auth If `true`, the scheduling [Availability](/docs/api/v3/scheduler/#get-/v3/scheduling/availability) and [Bookings](/docs/api/v3/scheduler/#post-/v3/scheduling/bookings) endpoints require a valid session ID to authenticate requests when you use this configuration.
     *
     * @return $this
     */
    public function setRequiresSessionAuth(?bool $requires_session_auth): static
    {
        if (is_null($requires_session_auth)) {
            throw new InvalidArgumentException('non-nullable requires_session_auth cannot be null');
        }
        $this->container['requires_session_auth'] = $requires_session_auth;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerParticipantsInner[]
     */
    public function getParticipants(): array
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerParticipantsInner[] $participants The list of participants that is included in the scheduled event. All participants must have a valid Nylas grant.
     *
     * @return $this
     */
    public function setParticipants(array $participants): static
    {
        if (is_null($participants)) {
            throw new InvalidArgumentException('non-nullable participants cannot be null');
        }
        $this->container['participants'] = $participants;

        return $this;
    }

    /**
     * Gets availability
     *
     * @return \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAvailability
     */
    public function getAvailability(): \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAvailability
    {
        return $this->container['availability'];
    }

    /**
     * Sets availability
     *
     * @param \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAvailability $availability availability
     *
     * @return $this
     */
    public function setAvailability(\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAvailability $availability): static
    {
        if (is_null($availability)) {
            throw new InvalidArgumentException('non-nullable availability cannot be null');
        }
        $this->container['availability'] = $availability;

        return $this;
    }

    /**
     * Gets event_booking
     *
     * @return \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerEventBooking
     */
    public function getEventBooking(): \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerEventBooking
    {
        return $this->container['event_booking'];
    }

    /**
     * Sets event_booking
     *
     * @param \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerEventBooking $event_booking event_booking
     *
     * @return $this
     */
    public function setEventBooking(\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerEventBooking $event_booking): static
    {
        if (is_null($event_booking)) {
            throw new InvalidArgumentException('non-nullable event_booking cannot be null');
        }
        $this->container['event_booking'] = $event_booking;

        return $this;
    }

    /**
     * Gets scheduler
     *
     * @return \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerScheduler|null
     */
    public function getScheduler(): ?\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerScheduler
    {
        return $this->container['scheduler'];
    }

    /**
     * Sets scheduler
     *
     * @param \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerScheduler|null $scheduler scheduler
     *
     * @return $this
     */
    public function setScheduler(?\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerScheduler $scheduler): static
    {
        if (is_null($scheduler)) {
            throw new InvalidArgumentException('non-nullable scheduler cannot be null');
        }
        $this->container['scheduler'] = $scheduler;

        return $this;
    }

    /**
     * Gets appearance
     *
     * @return array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAppearanceValue>|null
     */
    public function getAppearance(): ?array
    {
        return $this->container['appearance'];
    }

    /**
     * Sets appearance
     *
     * @param array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerAppearanceValue>|null $appearance appearance
     *
     * @return $this
     */
    public function setAppearance(?array $appearance): static
    {
        if (is_null($appearance)) {
            throw new InvalidArgumentException('non-nullable appearance cannot be null');
        }
        $this->container['appearance'] = $appearance;

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
