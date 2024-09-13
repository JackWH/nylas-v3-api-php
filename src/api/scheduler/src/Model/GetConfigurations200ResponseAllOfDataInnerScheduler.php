<?php
/**
 * GetConfigurations200ResponseAllOfDataInnerScheduler
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
use JsonSerializable;
use InvalidArgumentException;
use ReturnTypeWillChange;
use JackWH\NylasV3\Scheduler\ObjectSerializer;

/**
 * GetConfigurations200ResponseAllOfDataInnerScheduler Class Doc Comment
 *
 * @package  JackWH\NylasV3\Scheduler
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class GetConfigurations200ResponseAllOfDataInnerScheduler implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'get_configurations_200_response_allOf_data_inner_scheduler';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'additional_fields' => 'array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerAdditionalFieldsValue>',
        'available_days_in_future' => 'int',
        'min_booking_notice' => 'int',
        'min_cancellation_notice' => 'int',
        'cancellation_policy' => 'string',
        'rescheduling_url' => 'string',
        'cancellation_url' => 'string',
        'organizer_confirmation_url' => 'string',
        'confirmation_redirect_url' => 'string',
        'hide_rescheduling_options' => 'bool',
        'hide_cancellation_options' => 'bool',
        'hide_additional_guests' => 'bool',
        'email_template' => '\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'additional_fields' => null,
        'available_days_in_future' => null,
        'min_booking_notice' => null,
        'min_cancellation_notice' => null,
        'cancellation_policy' => null,
        'rescheduling_url' => null,
        'cancellation_url' => null,
        'organizer_confirmation_url' => null,
        'confirmation_redirect_url' => null,
        'hide_rescheduling_options' => null,
        'hide_cancellation_options' => null,
        'hide_additional_guests' => null,
        'email_template' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'additional_fields' => false,
        'available_days_in_future' => false,
        'min_booking_notice' => false,
        'min_cancellation_notice' => false,
        'cancellation_policy' => false,
        'rescheduling_url' => false,
        'cancellation_url' => false,
        'organizer_confirmation_url' => false,
        'confirmation_redirect_url' => false,
        'hide_rescheduling_options' => false,
        'hide_cancellation_options' => false,
        'hide_additional_guests' => false,
        'email_template' => false
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
        'additional_fields' => 'additional_fields',
        'available_days_in_future' => 'available_days_in_future',
        'min_booking_notice' => 'min_booking_notice',
        'min_cancellation_notice' => 'min_cancellation_notice',
        'cancellation_policy' => 'cancellation_policy',
        'rescheduling_url' => 'rescheduling_url',
        'cancellation_url' => 'cancellation_url',
        'organizer_confirmation_url' => 'organizer_confirmation_url',
        'confirmation_redirect_url' => 'confirmation_redirect_url',
        'hide_rescheduling_options' => 'hide_rescheduling_options',
        'hide_cancellation_options' => 'hide_cancellation_options',
        'hide_additional_guests' => 'hide_additional_guests',
        'email_template' => 'email_template'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'additional_fields' => 'setAdditionalFields',
        'available_days_in_future' => 'setAvailableDaysInFuture',
        'min_booking_notice' => 'setMinBookingNotice',
        'min_cancellation_notice' => 'setMinCancellationNotice',
        'cancellation_policy' => 'setCancellationPolicy',
        'rescheduling_url' => 'setReschedulingUrl',
        'cancellation_url' => 'setCancellationUrl',
        'organizer_confirmation_url' => 'setOrganizerConfirmationUrl',
        'confirmation_redirect_url' => 'setConfirmationRedirectUrl',
        'hide_rescheduling_options' => 'setHideReschedulingOptions',
        'hide_cancellation_options' => 'setHideCancellationOptions',
        'hide_additional_guests' => 'setHideAdditionalGuests',
        'email_template' => 'setEmailTemplate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'additional_fields' => 'getAdditionalFields',
        'available_days_in_future' => 'getAvailableDaysInFuture',
        'min_booking_notice' => 'getMinBookingNotice',
        'min_cancellation_notice' => 'getMinCancellationNotice',
        'cancellation_policy' => 'getCancellationPolicy',
        'rescheduling_url' => 'getReschedulingUrl',
        'cancellation_url' => 'getCancellationUrl',
        'organizer_confirmation_url' => 'getOrganizerConfirmationUrl',
        'confirmation_redirect_url' => 'getConfirmationRedirectUrl',
        'hide_rescheduling_options' => 'getHideReschedulingOptions',
        'hide_cancellation_options' => 'getHideCancellationOptions',
        'hide_additional_guests' => 'getHideAdditionalGuests',
        'email_template' => 'getEmailTemplate'
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
        $this->setIfExists('additional_fields', $data ?? [], null);
        $this->setIfExists('available_days_in_future', $data ?? [], 30);
        $this->setIfExists('min_booking_notice', $data ?? [], 60);
        $this->setIfExists('min_cancellation_notice', $data ?? [], 0);
        $this->setIfExists('cancellation_policy', $data ?? [], null);
        $this->setIfExists('rescheduling_url', $data ?? [], null);
        $this->setIfExists('cancellation_url', $data ?? [], null);
        $this->setIfExists('organizer_confirmation_url', $data ?? [], null);
        $this->setIfExists('confirmation_redirect_url', $data ?? [], null);
        $this->setIfExists('hide_rescheduling_options', $data ?? [], false);
        $this->setIfExists('hide_cancellation_options', $data ?? [], false);
        $this->setIfExists('hide_additional_guests', $data ?? [], false);
        $this->setIfExists('email_template', $data ?? [], null);
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
     * Gets additional_fields
     *
     * @return array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerAdditionalFieldsValue>|null
     */
    public function getAdditionalFields(): ?array
    {
        return $this->container['additional_fields'];
    }

    /**
     * Sets additional_fields
     *
     * @param array<string,\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerAdditionalFieldsValue>|null $additional_fields additional_fields
     *
     * @return $this
     */
    public function setAdditionalFields(?array $additional_fields): static
    {
        if (is_null($additional_fields)) {
            throw new InvalidArgumentException('non-nullable additional_fields cannot be null');
        }
        $this->container['additional_fields'] = $additional_fields;

        return $this;
    }

    /**
     * Gets available_days_in_future
     *
     * @return int|null
     */
    public function getAvailableDaysInFuture(): ?int
    {
        return $this->container['available_days_in_future'];
    }

    /**
     * Sets available_days_in_future
     *
     * @param int|null $available_days_in_future The number of days in the future that Scheduler is available for scheduling events.
     *
     * @return $this
     */
    public function setAvailableDaysInFuture(?int $available_days_in_future): static
    {
        if (is_null($available_days_in_future)) {
            throw new InvalidArgumentException('non-nullable available_days_in_future cannot be null');
        }
        $this->container['available_days_in_future'] = $available_days_in_future;

        return $this;
    }

    /**
     * Gets min_booking_notice
     *
     * @return int|null
     */
    public function getMinBookingNotice(): ?int
    {
        return $this->container['min_booking_notice'];
    }

    /**
     * Sets min_booking_notice
     *
     * @param int|null $min_booking_notice The minimum number of minutes in the future that a user can make a new booking.
     *
     * @return $this
     */
    public function setMinBookingNotice(?int $min_booking_notice): static
    {
        if (is_null($min_booking_notice)) {
            throw new InvalidArgumentException('non-nullable min_booking_notice cannot be null');
        }
        $this->container['min_booking_notice'] = $min_booking_notice;

        return $this;
    }

    /**
     * Gets min_cancellation_notice
     *
     * @return int|null
     */
    public function getMinCancellationNotice(): ?int
    {
        return $this->container['min_cancellation_notice'];
    }

    /**
     * Sets min_cancellation_notice
     *
     * @param int|null $min_cancellation_notice The minimum number of minutes before a booking can be cancelled.
     *
     * @return $this
     */
    public function setMinCancellationNotice(?int $min_cancellation_notice): static
    {
        if (is_null($min_cancellation_notice)) {
            throw new InvalidArgumentException('non-nullable min_cancellation_notice cannot be null');
        }
        $this->container['min_cancellation_notice'] = $min_cancellation_notice;

        return $this;
    }

    /**
     * Gets cancellation_policy
     *
     * @return string|null
     */
    public function getCancellationPolicy(): ?string
    {
        return $this->container['cancellation_policy'];
    }

    /**
     * Sets cancellation_policy
     *
     * @param string|null $cancellation_policy A message about the cancellation policy to display to users when booking an event.
     *
     * @return $this
     */
    public function setCancellationPolicy(?string $cancellation_policy): static
    {
        if (is_null($cancellation_policy)) {
            throw new InvalidArgumentException('non-nullable cancellation_policy cannot be null');
        }
        $this->container['cancellation_policy'] = $cancellation_policy;

        return $this;
    }

    /**
     * Gets rescheduling_url
     *
     * @return string|null
     */
    public function getReschedulingUrl(): ?string
    {
        return $this->container['rescheduling_url'];
    }

    /**
     * Sets rescheduling_url
     *
     * @param string|null $rescheduling_url The URL used to reschedule bookings. This URL is included in confirmation email messages.
     *
     * @return $this
     */
    public function setReschedulingUrl(?string $rescheduling_url): static
    {
        if (is_null($rescheduling_url)) {
            throw new InvalidArgumentException('non-nullable rescheduling_url cannot be null');
        }
        $this->container['rescheduling_url'] = $rescheduling_url;

        return $this;
    }

    /**
     * Gets cancellation_url
     *
     * @return string|null
     */
    public function getCancellationUrl(): ?string
    {
        return $this->container['cancellation_url'];
    }

    /**
     * Sets cancellation_url
     *
     * @param string|null $cancellation_url The URL used to cancel bookings. This URL is included in confirmation email messages.
     *
     * @return $this
     */
    public function setCancellationUrl(?string $cancellation_url): static
    {
        if (is_null($cancellation_url)) {
            throw new InvalidArgumentException('non-nullable cancellation_url cannot be null');
        }
        $this->container['cancellation_url'] = $cancellation_url;

        return $this;
    }

    /**
     * Gets organizer_confirmation_url
     *
     * @return string|null
     */
    public function getOrganizerConfirmationUrl(): ?string
    {
        return $this->container['organizer_confirmation_url'];
    }

    /**
     * Sets organizer_confirmation_url
     *
     * @param string|null $organizer_confirmation_url The URL used to confirm or cancel pending bookings. This URL is included in booking request email messages.
     *
     * @return $this
     */
    public function setOrganizerConfirmationUrl(?string $organizer_confirmation_url): static
    {
        if (is_null($organizer_confirmation_url)) {
            throw new InvalidArgumentException('non-nullable organizer_confirmation_url cannot be null');
        }
        $this->container['organizer_confirmation_url'] = $organizer_confirmation_url;

        return $this;
    }

    /**
     * Gets confirmation_redirect_url
     *
     * @return string|null
     */
    public function getConfirmationRedirectUrl(): ?string
    {
        return $this->container['confirmation_redirect_url'];
    }

    /**
     * Sets confirmation_redirect_url
     *
     * @param string|null $confirmation_redirect_url The custom URL to redirect to once the booking is confirmed.
     *
     * @return $this
     */
    public function setConfirmationRedirectUrl(?string $confirmation_redirect_url): static
    {
        if (is_null($confirmation_redirect_url)) {
            throw new InvalidArgumentException('non-nullable confirmation_redirect_url cannot be null');
        }
        $this->container['confirmation_redirect_url'] = $confirmation_redirect_url;

        return $this;
    }

    /**
     * Gets hide_rescheduling_options
     *
     * @return bool|null
     */
    public function getHideReschedulingOptions(): ?bool
    {
        return $this->container['hide_rescheduling_options'];
    }

    /**
     * Sets hide_rescheduling_options
     *
     * @param bool|null $hide_rescheduling_options If `true`, the option to reschedule an event is hidden in booking confirmations and email notifications.
     *
     * @return $this
     */
    public function setHideReschedulingOptions(?bool $hide_rescheduling_options): static
    {
        if (is_null($hide_rescheduling_options)) {
            throw new InvalidArgumentException('non-nullable hide_rescheduling_options cannot be null');
        }
        $this->container['hide_rescheduling_options'] = $hide_rescheduling_options;

        return $this;
    }

    /**
     * Gets hide_cancellation_options
     *
     * @return bool|null
     */
    public function getHideCancellationOptions(): ?bool
    {
        return $this->container['hide_cancellation_options'];
    }

    /**
     * Sets hide_cancellation_options
     *
     * @param bool|null $hide_cancellation_options If `true`, the option to cancel an event is hidden in booking confirmations and email notifications.
     *
     * @return $this
     */
    public function setHideCancellationOptions(?bool $hide_cancellation_options): static
    {
        if (is_null($hide_cancellation_options)) {
            throw new InvalidArgumentException('non-nullable hide_cancellation_options cannot be null');
        }
        $this->container['hide_cancellation_options'] = $hide_cancellation_options;

        return $this;
    }

    /**
     * Gets hide_additional_guests
     *
     * @return bool|null
     */
    public function getHideAdditionalGuests(): ?bool
    {
        return $this->container['hide_additional_guests'];
    }

    /**
     * Sets hide_additional_guests
     *
     * @param bool|null $hide_additional_guests Whether to hide the **Additional guests** field on the Scheduling Page. If `true`, guests cannot invite additional guests to the event.
     *
     * @return $this
     */
    public function setHideAdditionalGuests(?bool $hide_additional_guests): static
    {
        if (is_null($hide_additional_guests)) {
            throw new InvalidArgumentException('non-nullable hide_additional_guests cannot be null');
        }
        $this->container['hide_additional_guests'] = $hide_additional_guests;

        return $this;
    }

    /**
     * Gets email_template
     *
     * @return \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate|null
     */
    public function getEmailTemplate(): ?\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate
    {
        return $this->container['email_template'];
    }

    /**
     * Sets email_template
     *
     * @param \JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate|null $email_template email_template
     *
     * @return $this
     */
    public function setEmailTemplate(?\JackWH\NylasV3\Scheduler\Model\GetConfigurations200ResponseAllOfDataInnerSchedulerEmailTemplate $email_template): static
    {
        if (is_null($email_template)) {
            throw new InvalidArgumentException('non-nullable email_template cannot be null');
        }
        $this->container['email_template'] = $email_template;

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

