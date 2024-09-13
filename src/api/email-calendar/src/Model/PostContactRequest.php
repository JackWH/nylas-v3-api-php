<?php
/**
 * PostContactRequest
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
 * PostContactRequest Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class PostContactRequest implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static string $openAPIModelName = 'post_contact_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var array<string, string>
      */
    protected static array $openAPITypes = [
        'birthday' => 'string',
        'company_name' => 'string',
        'emails' => '\JackWH\NylasV3\EmailCalendar\Model\ContactEmail[]',
        'given_name' => 'string',
        'groups' => '\JackWH\NylasV3\EmailCalendar\Model\ContactGroupID[]',
        'im_addresses' => '\JackWH\NylasV3\EmailCalendar\Model\ContactIMAddress[]',
        'job_title' => 'string',
        'manager_name' => 'string',
        'middle_name' => 'string',
        'nickname' => 'string',
        'notes' => 'string',
        'office_location' => 'string',
        'phone_numbers' => '\JackWH\NylasV3\EmailCalendar\Model\ContactPhoneNumber[]',
        'physical_addresses' => '\JackWH\NylasV3\EmailCalendar\Model\ContactPhysicalAddress[]',
        'suffix' => 'string',
        'surname' => 'string',
        'web_pages' => '\JackWH\NylasV3\EmailCalendar\Model\ContactWebPage[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var array<string, string|null>
      */
    protected static array $openAPIFormats = [
        'birthday' => null,
        'company_name' => null,
        'emails' => null,
        'given_name' => null,
        'groups' => null,
        'im_addresses' => null,
        'job_title' => null,
        'manager_name' => null,
        'middle_name' => null,
        'nickname' => null,
        'notes' => null,
        'office_location' => null,
        'phone_numbers' => null,
        'physical_addresses' => null,
        'suffix' => null,
        'surname' => null,
        'web_pages' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var array<string, bool>
      */
    protected static array $openAPINullables = [
        'birthday' => false,
        'company_name' => false,
        'emails' => false,
        'given_name' => false,
        'groups' => false,
        'im_addresses' => false,
        'job_title' => false,
        'manager_name' => false,
        'middle_name' => false,
        'nickname' => false,
        'notes' => false,
        'office_location' => false,
        'phone_numbers' => false,
        'physical_addresses' => false,
        'suffix' => false,
        'surname' => false,
        'web_pages' => false
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
        'birthday' => 'birthday',
        'company_name' => 'company_name',
        'emails' => 'emails',
        'given_name' => 'given_name',
        'groups' => 'groups',
        'im_addresses' => 'im_addresses',
        'job_title' => 'job_title',
        'manager_name' => 'manager_name',
        'middle_name' => 'middle_name',
        'nickname' => 'nickname',
        'notes' => 'notes',
        'office_location' => 'office_location',
        'phone_numbers' => 'phone_numbers',
        'physical_addresses' => 'physical_addresses',
        'suffix' => 'suffix',
        'surname' => 'surname',
        'web_pages' => 'web_pages'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'birthday' => 'setBirthday',
        'company_name' => 'setCompanyName',
        'emails' => 'setEmails',
        'given_name' => 'setGivenName',
        'groups' => 'setGroups',
        'im_addresses' => 'setImAddresses',
        'job_title' => 'setJobTitle',
        'manager_name' => 'setManagerName',
        'middle_name' => 'setMiddleName',
        'nickname' => 'setNickname',
        'notes' => 'setNotes',
        'office_location' => 'setOfficeLocation',
        'phone_numbers' => 'setPhoneNumbers',
        'physical_addresses' => 'setPhysicalAddresses',
        'suffix' => 'setSuffix',
        'surname' => 'setSurname',
        'web_pages' => 'setWebPages'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'birthday' => 'getBirthday',
        'company_name' => 'getCompanyName',
        'emails' => 'getEmails',
        'given_name' => 'getGivenName',
        'groups' => 'getGroups',
        'im_addresses' => 'getImAddresses',
        'job_title' => 'getJobTitle',
        'manager_name' => 'getManagerName',
        'middle_name' => 'getMiddleName',
        'nickname' => 'getNickname',
        'notes' => 'getNotes',
        'office_location' => 'getOfficeLocation',
        'phone_numbers' => 'getPhoneNumbers',
        'physical_addresses' => 'getPhysicalAddresses',
        'suffix' => 'getSuffix',
        'surname' => 'getSurname',
        'web_pages' => 'getWebPages'
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
        $this->setIfExists('birthday', $data ?? [], null);
        $this->setIfExists('company_name', $data ?? [], null);
        $this->setIfExists('emails', $data ?? [], null);
        $this->setIfExists('given_name', $data ?? [], null);
        $this->setIfExists('groups', $data ?? [], null);
        $this->setIfExists('im_addresses', $data ?? [], null);
        $this->setIfExists('job_title', $data ?? [], null);
        $this->setIfExists('manager_name', $data ?? [], null);
        $this->setIfExists('middle_name', $data ?? [], null);
        $this->setIfExists('nickname', $data ?? [], null);
        $this->setIfExists('notes', $data ?? [], null);
        $this->setIfExists('office_location', $data ?? [], null);
        $this->setIfExists('phone_numbers', $data ?? [], null);
        $this->setIfExists('physical_addresses', $data ?? [], null);
        $this->setIfExists('suffix', $data ?? [], null);
        $this->setIfExists('surname', $data ?? [], null);
        $this->setIfExists('web_pages', $data ?? [], null);
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

        if ($this->container['given_name'] === null) {
            $invalidProperties[] = "'given_name' can't be null";
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
     * Gets birthday
     *
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->container['birthday'];
    }

    /**
     * Sets birthday
     *
     * @param string|null $birthday The contact's birthday in [ISO-8601 format](https://en.wikipedia.org/wiki/ISO_8601#Calendar_dates).
     *
     * @return $this
     */
    public function setBirthday(?string $birthday): static
    {
        if (is_null($birthday)) {
            throw new InvalidArgumentException('non-nullable birthday cannot be null');
        }
        $this->container['birthday'] = $birthday;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string|null $company_name The name of the company that the contact is affiliated with (for example, their workplace).
     *
     * @return $this
     */
    public function setCompanyName(?string $company_name): static
    {
        if (is_null($company_name)) {
            throw new InvalidArgumentException('non-nullable company_name cannot be null');
        }
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets emails
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactEmail[]|null
     */
    public function getEmails(): ?array
    {
        return $this->container['emails'];
    }

    /**
     * Sets emails
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactEmail[]|null $emails emails
     *
     * @return $this
     */
    public function setEmails(?array $emails): static
    {
        if (is_null($emails)) {
            throw new InvalidArgumentException('non-nullable emails cannot be null');
        }
        $this->container['emails'] = $emails;

        return $this;
    }

    /**
     * Gets given_name
     *
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->container['given_name'];
    }

    /**
     * Sets given_name
     *
     * @param string $given_name The contact's given name.
     *
     * @return $this
     */
    public function setGivenName(string $given_name): static
    {
        if (is_null($given_name)) {
            throw new InvalidArgumentException('non-nullable given_name cannot be null');
        }
        $this->container['given_name'] = $given_name;

        return $this;
    }

    /**
     * Gets groups
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactGroupID[]|null
     */
    public function getGroups(): ?array
    {
        return $this->container['groups'];
    }

    /**
     * Sets groups
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactGroupID[]|null $groups groups
     *
     * @return $this
     */
    public function setGroups(?array $groups): static
    {
        if (is_null($groups)) {
            throw new InvalidArgumentException('non-nullable groups cannot be null');
        }
        $this->container['groups'] = $groups;

        return $this;
    }

    /**
     * Gets im_addresses
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactIMAddress[]|null
     */
    public function getImAddresses(): ?array
    {
        return $this->container['im_addresses'];
    }

    /**
     * Sets im_addresses
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactIMAddress[]|null $im_addresses im_addresses
     *
     * @return $this
     */
    public function setImAddresses(?array $im_addresses): static
    {
        if (is_null($im_addresses)) {
            throw new InvalidArgumentException('non-nullable im_addresses cannot be null');
        }
        $this->container['im_addresses'] = $im_addresses;

        return $this;
    }

    /**
     * Gets job_title
     *
     * @return string|null
     */
    public function getJobTitle(): ?string
    {
        return $this->container['job_title'];
    }

    /**
     * Sets job_title
     *
     * @param string|null $job_title The contact's occupation or job title.
     *
     * @return $this
     */
    public function setJobTitle(?string $job_title): static
    {
        if (is_null($job_title)) {
            throw new InvalidArgumentException('non-nullable job_title cannot be null');
        }
        $this->container['job_title'] = $job_title;

        return $this;
    }

    /**
     * Gets manager_name
     *
     * @return string|null
     */
    public function getManagerName(): ?string
    {
        return $this->container['manager_name'];
    }

    /**
     * Sets manager_name
     *
     * @param string|null $manager_name The name of the contact's manager.
     *
     * @return $this
     */
    public function setManagerName(?string $manager_name): static
    {
        if (is_null($manager_name)) {
            throw new InvalidArgumentException('non-nullable manager_name cannot be null');
        }
        $this->container['manager_name'] = $manager_name;

        return $this;
    }

    /**
     * Gets middle_name
     *
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->container['middle_name'];
    }

    /**
     * Sets middle_name
     *
     * @param string|null $middle_name The contact's middle name.
     *
     * @return $this
     */
    public function setMiddleName(?string $middle_name): static
    {
        if (is_null($middle_name)) {
            throw new InvalidArgumentException('non-nullable middle_name cannot be null');
        }
        $this->container['middle_name'] = $middle_name;

        return $this;
    }

    /**
     * Gets nickname
     *
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->container['nickname'];
    }

    /**
     * Sets nickname
     *
     * @param string|null $nickname A custom nickname for the contact.
     *
     * @return $this
     */
    public function setNickname(?string $nickname): static
    {
        if (is_null($nickname)) {
            throw new InvalidArgumentException('non-nullable nickname cannot be null');
        }
        $this->container['nickname'] = $nickname;

        return $this;
    }

    /**
     * Gets notes
     *
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->container['notes'];
    }

    /**
     * Sets notes
     *
     * @param string|null $notes Notes about with the contact (for example, their favorite food).
     *
     * @return $this
     */
    public function setNotes(?string $notes): static
    {
        if (is_null($notes)) {
            throw new InvalidArgumentException('non-nullable notes cannot be null');
        }
        $this->container['notes'] = $notes;

        return $this;
    }

    /**
     * Gets office_location
     *
     * @return string|null
     */
    public function getOfficeLocation(): ?string
    {
        return $this->container['office_location'];
    }

    /**
     * Sets office_location
     *
     * @param string|null $office_location The location of the office where the contact works.
     *
     * @return $this
     */
    public function setOfficeLocation(?string $office_location): static
    {
        if (is_null($office_location)) {
            throw new InvalidArgumentException('non-nullable office_location cannot be null');
        }
        $this->container['office_location'] = $office_location;

        return $this;
    }

    /**
     * Gets phone_numbers
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactPhoneNumber[]|null
     */
    public function getPhoneNumbers(): ?array
    {
        return $this->container['phone_numbers'];
    }

    /**
     * Sets phone_numbers
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactPhoneNumber[]|null $phone_numbers phone_numbers
     *
     * @return $this
     */
    public function setPhoneNumbers(?array $phone_numbers): static
    {
        if (is_null($phone_numbers)) {
            throw new InvalidArgumentException('non-nullable phone_numbers cannot be null');
        }
        $this->container['phone_numbers'] = $phone_numbers;

        return $this;
    }

    /**
     * Gets physical_addresses
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactPhysicalAddress[]|null
     */
    public function getPhysicalAddresses(): ?array
    {
        return $this->container['physical_addresses'];
    }

    /**
     * Sets physical_addresses
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactPhysicalAddress[]|null $physical_addresses physical_addresses
     *
     * @return $this
     */
    public function setPhysicalAddresses(?array $physical_addresses): static
    {
        if (is_null($physical_addresses)) {
            throw new InvalidArgumentException('non-nullable physical_addresses cannot be null');
        }
        $this->container['physical_addresses'] = $physical_addresses;

        return $this;
    }

    /**
     * Gets suffix
     *
     * @return string|null
     */
    public function getSuffix(): ?string
    {
        return $this->container['suffix'];
    }

    /**
     * Sets suffix
     *
     * @param string|null $suffix (Not supported for EWS) The suffix of a contact's name, if applicable.
     *
     * @return $this
     */
    public function setSuffix(?string $suffix): static
    {
        if (is_null($suffix)) {
            throw new InvalidArgumentException('non-nullable suffix cannot be null');
        }
        $this->container['suffix'] = $suffix;

        return $this;
    }

    /**
     * Gets surname
     *
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->container['surname'];
    }

    /**
     * Sets surname
     *
     * @param string|null $surname The contact's surname.
     *
     * @return $this
     */
    public function setSurname(?string $surname): static
    {
        if (is_null($surname)) {
            throw new InvalidArgumentException('non-nullable surname cannot be null');
        }
        $this->container['surname'] = $surname;

        return $this;
    }

    /**
     * Gets web_pages
     *
     * @return \JackWH\NylasV3\EmailCalendar\Model\ContactWebPage[]|null
     */
    public function getWebPages(): ?array
    {
        return $this->container['web_pages'];
    }

    /**
     * Sets web_pages
     *
     * @param \JackWH\NylasV3\EmailCalendar\Model\ContactWebPage[]|null $web_pages web_pages
     *
     * @return $this
     */
    public function setWebPages(?array $web_pages): static
    {
        if (is_null($web_pages)) {
            throw new InvalidArgumentException('non-nullable web_pages cannot be null');
        }
        $this->container['web_pages'] = $web_pages;

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


