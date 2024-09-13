<?php
/**
 * MessagesApi
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

namespace JackWH\NylasV3\EmailCalendar\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use JackWH\NylasV3\EmailCalendar\ApiException;
use JackWH\NylasV3\EmailCalendar\Configuration;
use JackWH\NylasV3\EmailCalendar\HeaderSelector;
use JackWH\NylasV3\EmailCalendar\ObjectSerializer;

/**
 * MessagesApi Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class MessagesApi
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @var Configuration
     */
    protected Configuration $config;

    /**
     * @var HeaderSelector
     */
    protected HeaderSelector $headerSelector;

    /**
     * @var int Host index
     */
    protected int $hostIndex;

    /** @var string[] * */
    public const contentTypes = [
        'cleanMessages' => [
            'application/json',
        ],
        'deleteAScheduledMessage' => [
            'application/json',
        ],
        'deleteMessagesId' => [
            'application/json',
        ],
        'getMessages' => [
            'application/json',
        ],
        'getMessagesId' => [
            'application/json',
        ],
        'getScheduleById' => [
            'application/json',
        ],
        'getSchedules' => [
            'application/json',
        ],
        'putMessagesId' => [
            'application/json',
        ],
        'sendMailNow' => [
            'application/json',
            'multipart/form-data',
        ],
    ];

    /**
     * @param ClientInterface|null $client
     * @param Configuration|null   $config
     * @param HeaderSelector|null  $selector
     * @param int                  $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig(): Configuration
    {
        return $this->config;
    }

    /**
     * Operation cleanMessages
     *
     * Clean email messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest|null $clean_messages_request clean_messages_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cleanMessages'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function cleanMessages(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest $clean_messages_request = null,
        string $contentType = self::contentTypes['cleanMessages'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response {
        list($response) = $this->cleanMessagesWithHttpInfo($grant_id, $select, $clean_messages_request, $contentType);

        return $response;
    }

    /**
     * Operation cleanMessagesWithHttpInfo
     *
     * Clean email messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest|null $clean_messages_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cleanMessages'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function cleanMessagesWithHttpInfo(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest $clean_messages_request = null,
        string $contentType = self::contentTypes['cleanMessages'][0]
    ): array {
        $request = $this->cleanMessagesRequest($grant_id, $select, $clean_messages_request, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation cleanMessagesAsync
     *
     * Clean email messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest|null $clean_messages_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cleanMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cleanMessagesAsync(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest $clean_messages_request = null,
        string $contentType = self::contentTypes['cleanMessages'][0]
    ): PromiseInterface {
        return $this->cleanMessagesAsyncWithHttpInfo($grant_id, $select, $clean_messages_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cleanMessagesAsyncWithHttpInfo
     *
     * Clean email messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest|null $clean_messages_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cleanMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function cleanMessagesAsyncWithHttpInfo(
        $grant_id,
        $select = null,
        $clean_messages_request = null,
        string $contentType = self::contentTypes['cleanMessages'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\CleanMessages200Response';
        $request = $this->cleanMessagesRequest($grant_id, $select, $clean_messages_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cleanMessages'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CleanMessagesRequest|null $clean_messages_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['cleanMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cleanMessagesRequest(
        $grant_id,
        $select = null,
        $clean_messages_request = null,
        string $contentType = self::contentTypes['cleanMessages'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling cleanMessages'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/messages/clean';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $select,
            'select', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($clean_messages_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($clean_messages_request));
            } else {
                $httpBody = $clean_messages_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteAScheduledMessage
     *
     * Cancel a scheduled message
     *
     * @param  string $schedule_id The ID of the send schedule you want to cancel. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteAScheduledMessage'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function deleteAScheduledMessage(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['deleteAScheduledMessage'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response {
        list($response) = $this->deleteAScheduledMessageWithHttpInfo($schedule_id, $grant_id, $contentType);

        return $response;
    }

    /**
     * Operation deleteAScheduledMessageWithHttpInfo
     *
     * Cancel a scheduled message
     *
     * @param  string $schedule_id The ID of the send schedule you want to cancel. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteAScheduledMessage'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteAScheduledMessageWithHttpInfo(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['deleteAScheduledMessage'][0]
    ): array {
        $request = $this->deleteAScheduledMessageRequest($schedule_id, $grant_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 202:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteAScheduledMessageAsync
     *
     * Cancel a scheduled message
     *
     * @param  string $schedule_id The ID of the send schedule you want to cancel. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteAScheduledMessage'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAScheduledMessageAsync(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['deleteAScheduledMessage'][0]
    ): PromiseInterface {
        return $this->deleteAScheduledMessageAsyncWithHttpInfo($schedule_id, $grant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAScheduledMessageAsyncWithHttpInfo
     *
     * Cancel a scheduled message
     *
     * @param  string $schedule_id The ID of the send schedule you want to cancel. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteAScheduledMessage'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteAScheduledMessageAsyncWithHttpInfo(
        $schedule_id,
        $grant_id,
        string $contentType = self::contentTypes['deleteAScheduledMessage'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteAScheduledMessage202Response';
        $request = $this->deleteAScheduledMessageRequest($schedule_id, $grant_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteAScheduledMessage'
     *
     * @param  string $schedule_id The ID of the send schedule you want to cancel. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteAScheduledMessage'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteAScheduledMessageRequest(
        $schedule_id,
        $grant_id,
        string $contentType = self::contentTypes['deleteAScheduledMessage'][0]
    ): Request {

        // verify the required parameter 'schedule_id' is set
        if ($schedule_id === null || (is_array($schedule_id) && count($schedule_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $schedule_id when calling deleteAScheduledMessage'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling deleteAScheduledMessage'
            );
        }


        $resourcePath = '/v3/grants/{grant_id}/messages/schedules/{scheduleId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($schedule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'scheduleId' . '}',
                ObjectSerializer::toPathValue($schedule_id),
                $resourcePath
            );
        }
        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteMessagesId
     *
     * Delete a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function deleteMessagesId(
        string $grant_id,
        string $message_id,
        string $contentType = self::contentTypes['deleteMessagesId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response {
        list($response) = $this->deleteMessagesIdWithHttpInfo($grant_id, $message_id, $contentType);

        return $response;
    }

    /**
     * Operation deleteMessagesIdWithHttpInfo
     *
     * Delete a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteMessagesIdWithHttpInfo(
        string $grant_id,
        string $message_id,
        string $contentType = self::contentTypes['deleteMessagesId'][0]
    ): array {
        $request = $this->deleteMessagesIdRequest($grant_id, $message_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteMessagesIdAsync
     *
     * Delete a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteMessagesIdAsync(
        string $grant_id,
        string $message_id,
        string $contentType = self::contentTypes['deleteMessagesId'][0]
    ): PromiseInterface {
        return $this->deleteMessagesIdAsyncWithHttpInfo($grant_id, $message_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteMessagesIdAsyncWithHttpInfo
     *
     * Delete a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteMessagesIdAsyncWithHttpInfo(
        $grant_id,
        $message_id,
        string $contentType = self::contentTypes['deleteMessagesId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response';
        $request = $this->deleteMessagesIdRequest($grant_id, $message_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteMessagesId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteMessagesIdRequest(
        $grant_id,
        $message_id,
        string $contentType = self::contentTypes['deleteMessagesId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling deleteMessagesId'
            );
        }

        // verify the required parameter 'message_id' is set
        if ($message_id === null || (is_array($message_id) && count($message_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $message_id when calling deleteMessagesId'
            );
        }


        $resourcePath = '/v3/grants/{grant_id}/messages/{message_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }
        // path params
        if ($message_id !== null) {
            $resourcePath = str_replace(
                '{' . 'message_id' . '}',
                ObjectSerializer::toPathValue($message_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getMessages
     *
     * Return all Messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string|null $subject Return items with a matching subject. The filter is case insensitive and will match partial subjects. (optional)
     * @param  string|null $any_email Return email messages that were sent to or received from this comma-separated list of email addresses (for example, &#x60;mail1@example.com,mail2@example.com&#x60;). You can specify a maximum of 25 email addresses. (optional)
     * @param  string|null $to Return items containing email messages sent to this email address. (optional)
     * @param  string|null $from Return items containing email messages sent from this email address. (optional)
     * @param  string|null $cc Return items containing email messages that were CC&#39;d to this email address. (optional)
     * @param  string|null $bcc Return items containing email messages that were BCC&#39;d to this email address, likely sent from the parent account. (Most SMTP gateways remove BCC information.) (optional)
     * @param  string|null $in Filter for email messages in a specific folder. Nylas uses the Folders API for both folders and Google&#39;s \&quot;labels\&quot;. For more information, see the [Folders reference](/docs/api/v3/ecc/#tag--Folders).  Google does not support filtering using folder names. You must use the folder ID. (optional)
     * @param  bool|null $unread Return items with one or more unread email messages. (optional)
     * @param  bool|null $starred Return items with one or more starred email messages. For EWS, this is only supported for Microsoft Exchange 2010 or later. (optional)
     * @param  string|null $thread_id Return items with a matching &#x60;thread_id&#x60;. (optional)
     * @param  int|null $received_before Return email messages received before this Unix timestamp. (optional)
     * @param  int|null $received_after Return email messages received after this Unix timestamp. (optional)
     * @param  bool|null $has_attachment Return email messages with attachments. (optional)
     * @param  string|null $fields Return messages with headers by specifying &#x60;include_headers&#x60;. Not supported for IMAP, iCloud, or Yahoo. For Microsoft the message headers are always empty if the message is in the sent folder. For EWS, message headers might be empty if the message was sent by the current email address. (optional, default to 'standard')
     * @param  string|null $search_query_native A URL-encoded provider-specific query string. Supported for [Google](https://support.google.com/mail/answer/7190?hl&#x3D;en), [Microsoft Graph](https://learn.microsoft.com/en-us/graph/search-query-parameter?tabs&#x3D;http#using-search-on-message-collections), and [EWS](https://learn.microsoft.com/en-us/windows/win32/lwef/-search-2x-wds-aqsreference).  You can only use a limited set of query parameters with &#x60;search_query_native&#x60;, depending on the provider:  - **Microsoft**: &#x60;in&#x60;, &#x60;limit&#x60;, and &#x60;page_token&#x60; - **Google**: &#x60;in&#x60;, &#x60;limit&#x60;, &#x60;page_token&#x60;, and &#x60;thread_id&#x60; - **EWS**: Any parameter _except_ &#x60;thread_id&#x60;  You can also use [Microsoft Graph &#x60;$filter&#x60; queries](https://learn.microsoft.com/en-us/graph/filter-query-parameter) in this parameter. Create your filter query, prefix it with &#x60;$filter&#x3D;&#x60;, then URL-encode it.  For more information, see [Searching with Nylas](/docs/dev-guide/search/#search-messages-and-threads-using-search_query_native). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessages'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getMessages(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $select = null,
        ?string $subject = null,
        ?string $any_email = null,
        ?string $to = null,
        ?string $from = null,
        ?string $cc = null,
        ?string $bcc = null,
        ?string $in = null,
        ?bool $unread = null,
        ?bool $starred = null,
        ?string $thread_id = null,
        ?int $received_before = null,
        ?int $received_after = null,
        ?bool $has_attachment = null,
        ?string $fields = 'standard',
        ?string $search_query_native = null,
        string $contentType = self::contentTypes['getMessages'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response {
        list($response) = $this->getMessagesWithHttpInfo($grant_id, $limit, $page_token, $select, $subject, $any_email, $to, $from, $cc, $bcc, $in, $unread, $starred, $thread_id, $received_before, $received_after, $has_attachment, $fields, $search_query_native, $contentType);

        return $response;
    }

    /**
     * Operation getMessagesWithHttpInfo
     *
     * Return all Messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string|null $subject Return items with a matching subject. The filter is case insensitive and will match partial subjects. (optional)
     * @param  string|null $any_email Return email messages that were sent to or received from this comma-separated list of email addresses (for example, &#x60;mail1@example.com,mail2@example.com&#x60;). You can specify a maximum of 25 email addresses. (optional)
     * @param  string|null $to Return items containing email messages sent to this email address. (optional)
     * @param  string|null $from Return items containing email messages sent from this email address. (optional)
     * @param  string|null $cc Return items containing email messages that were CC&#39;d to this email address. (optional)
     * @param  string|null $bcc Return items containing email messages that were BCC&#39;d to this email address, likely sent from the parent account. (Most SMTP gateways remove BCC information.) (optional)
     * @param  string|null $in Filter for email messages in a specific folder. Nylas uses the Folders API for both folders and Google&#39;s \&quot;labels\&quot;. For more information, see the [Folders reference](/docs/api/v3/ecc/#tag--Folders).  Google does not support filtering using folder names. You must use the folder ID. (optional)
     * @param  bool|null $unread Return items with one or more unread email messages. (optional)
     * @param  bool|null $starred Return items with one or more starred email messages. For EWS, this is only supported for Microsoft Exchange 2010 or later. (optional)
     * @param  string|null $thread_id Return items with a matching &#x60;thread_id&#x60;. (optional)
     * @param  int|null $received_before Return email messages received before this Unix timestamp. (optional)
     * @param  int|null $received_after Return email messages received after this Unix timestamp. (optional)
     * @param  bool|null $has_attachment Return email messages with attachments. (optional)
     * @param  string|null $fields Return messages with headers by specifying &#x60;include_headers&#x60;. Not supported for IMAP, iCloud, or Yahoo. For Microsoft the message headers are always empty if the message is in the sent folder. For EWS, message headers might be empty if the message was sent by the current email address. (optional, default to 'standard')
     * @param  string|null $search_query_native A URL-encoded provider-specific query string. Supported for [Google](https://support.google.com/mail/answer/7190?hl&#x3D;en), [Microsoft Graph](https://learn.microsoft.com/en-us/graph/search-query-parameter?tabs&#x3D;http#using-search-on-message-collections), and [EWS](https://learn.microsoft.com/en-us/windows/win32/lwef/-search-2x-wds-aqsreference).  You can only use a limited set of query parameters with &#x60;search_query_native&#x60;, depending on the provider:  - **Microsoft**: &#x60;in&#x60;, &#x60;limit&#x60;, and &#x60;page_token&#x60; - **Google**: &#x60;in&#x60;, &#x60;limit&#x60;, &#x60;page_token&#x60;, and &#x60;thread_id&#x60; - **EWS**: Any parameter _except_ &#x60;thread_id&#x60;  You can also use [Microsoft Graph &#x60;$filter&#x60; queries](https://learn.microsoft.com/en-us/graph/filter-query-parameter) in this parameter. Create your filter query, prefix it with &#x60;$filter&#x3D;&#x60;, then URL-encode it.  For more information, see [Searching with Nylas](/docs/dev-guide/search/#search-messages-and-threads-using-search_query_native). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessages'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMessagesWithHttpInfo(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $select = null,
        ?string $subject = null,
        ?string $any_email = null,
        ?string $to = null,
        ?string $from = null,
        ?string $cc = null,
        ?string $bcc = null,
        ?string $in = null,
        ?bool $unread = null,
        ?bool $starred = null,
        ?string $thread_id = null,
        ?int $received_before = null,
        ?int $received_after = null,
        ?bool $has_attachment = null,
        ?string $fields = 'standard',
        ?string $search_query_native = null,
        string $contentType = self::contentTypes['getMessages'][0]
    ): array {
        $request = $this->getMessagesRequest($grant_id, $limit, $page_token, $select, $subject, $any_email, $to, $from, $cc, $bcc, $in, $unread, $starred, $thread_id, $received_before, $received_after, $has_attachment, $fields, $search_query_native, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getMessagesAsync
     *
     * Return all Messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string|null $subject Return items with a matching subject. The filter is case insensitive and will match partial subjects. (optional)
     * @param  string|null $any_email Return email messages that were sent to or received from this comma-separated list of email addresses (for example, &#x60;mail1@example.com,mail2@example.com&#x60;). You can specify a maximum of 25 email addresses. (optional)
     * @param  string|null $to Return items containing email messages sent to this email address. (optional)
     * @param  string|null $from Return items containing email messages sent from this email address. (optional)
     * @param  string|null $cc Return items containing email messages that were CC&#39;d to this email address. (optional)
     * @param  string|null $bcc Return items containing email messages that were BCC&#39;d to this email address, likely sent from the parent account. (Most SMTP gateways remove BCC information.) (optional)
     * @param  string|null $in Filter for email messages in a specific folder. Nylas uses the Folders API for both folders and Google&#39;s \&quot;labels\&quot;. For more information, see the [Folders reference](/docs/api/v3/ecc/#tag--Folders).  Google does not support filtering using folder names. You must use the folder ID. (optional)
     * @param  bool|null $unread Return items with one or more unread email messages. (optional)
     * @param  bool|null $starred Return items with one or more starred email messages. For EWS, this is only supported for Microsoft Exchange 2010 or later. (optional)
     * @param  string|null $thread_id Return items with a matching &#x60;thread_id&#x60;. (optional)
     * @param  int|null $received_before Return email messages received before this Unix timestamp. (optional)
     * @param  int|null $received_after Return email messages received after this Unix timestamp. (optional)
     * @param  bool|null $has_attachment Return email messages with attachments. (optional)
     * @param  string|null $fields Return messages with headers by specifying &#x60;include_headers&#x60;. Not supported for IMAP, iCloud, or Yahoo. For Microsoft the message headers are always empty if the message is in the sent folder. For EWS, message headers might be empty if the message was sent by the current email address. (optional, default to 'standard')
     * @param  string|null $search_query_native A URL-encoded provider-specific query string. Supported for [Google](https://support.google.com/mail/answer/7190?hl&#x3D;en), [Microsoft Graph](https://learn.microsoft.com/en-us/graph/search-query-parameter?tabs&#x3D;http#using-search-on-message-collections), and [EWS](https://learn.microsoft.com/en-us/windows/win32/lwef/-search-2x-wds-aqsreference).  You can only use a limited set of query parameters with &#x60;search_query_native&#x60;, depending on the provider:  - **Microsoft**: &#x60;in&#x60;, &#x60;limit&#x60;, and &#x60;page_token&#x60; - **Google**: &#x60;in&#x60;, &#x60;limit&#x60;, &#x60;page_token&#x60;, and &#x60;thread_id&#x60; - **EWS**: Any parameter _except_ &#x60;thread_id&#x60;  You can also use [Microsoft Graph &#x60;$filter&#x60; queries](https://learn.microsoft.com/en-us/graph/filter-query-parameter) in this parameter. Create your filter query, prefix it with &#x60;$filter&#x3D;&#x60;, then URL-encode it.  For more information, see [Searching with Nylas](/docs/dev-guide/search/#search-messages-and-threads-using-search_query_native). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesAsync(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $select = null,
        ?string $subject = null,
        ?string $any_email = null,
        ?string $to = null,
        ?string $from = null,
        ?string $cc = null,
        ?string $bcc = null,
        ?string $in = null,
        ?bool $unread = null,
        ?bool $starred = null,
        ?string $thread_id = null,
        ?int $received_before = null,
        ?int $received_after = null,
        ?bool $has_attachment = null,
        ?string $fields = 'standard',
        ?string $search_query_native = null,
        string $contentType = self::contentTypes['getMessages'][0]
    ): PromiseInterface {
        return $this->getMessagesAsyncWithHttpInfo($grant_id, $limit, $page_token, $select, $subject, $any_email, $to, $from, $cc, $bcc, $in, $unread, $starred, $thread_id, $received_before, $received_after, $has_attachment, $fields, $search_query_native, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMessagesAsyncWithHttpInfo
     *
     * Return all Messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string|null $subject Return items with a matching subject. The filter is case insensitive and will match partial subjects. (optional)
     * @param  string|null $any_email Return email messages that were sent to or received from this comma-separated list of email addresses (for example, &#x60;mail1@example.com,mail2@example.com&#x60;). You can specify a maximum of 25 email addresses. (optional)
     * @param  string|null $to Return items containing email messages sent to this email address. (optional)
     * @param  string|null $from Return items containing email messages sent from this email address. (optional)
     * @param  string|null $cc Return items containing email messages that were CC&#39;d to this email address. (optional)
     * @param  string|null $bcc Return items containing email messages that were BCC&#39;d to this email address, likely sent from the parent account. (Most SMTP gateways remove BCC information.) (optional)
     * @param  string|null $in Filter for email messages in a specific folder. Nylas uses the Folders API for both folders and Google&#39;s \&quot;labels\&quot;. For more information, see the [Folders reference](/docs/api/v3/ecc/#tag--Folders).  Google does not support filtering using folder names. You must use the folder ID. (optional)
     * @param  bool|null $unread Return items with one or more unread email messages. (optional)
     * @param  bool|null $starred Return items with one or more starred email messages. For EWS, this is only supported for Microsoft Exchange 2010 or later. (optional)
     * @param  string|null $thread_id Return items with a matching &#x60;thread_id&#x60;. (optional)
     * @param  int|null $received_before Return email messages received before this Unix timestamp. (optional)
     * @param  int|null $received_after Return email messages received after this Unix timestamp. (optional)
     * @param  bool|null $has_attachment Return email messages with attachments. (optional)
     * @param  string|null $fields Return messages with headers by specifying &#x60;include_headers&#x60;. Not supported for IMAP, iCloud, or Yahoo. For Microsoft the message headers are always empty if the message is in the sent folder. For EWS, message headers might be empty if the message was sent by the current email address. (optional, default to 'standard')
     * @param  string|null $search_query_native A URL-encoded provider-specific query string. Supported for [Google](https://support.google.com/mail/answer/7190?hl&#x3D;en), [Microsoft Graph](https://learn.microsoft.com/en-us/graph/search-query-parameter?tabs&#x3D;http#using-search-on-message-collections), and [EWS](https://learn.microsoft.com/en-us/windows/win32/lwef/-search-2x-wds-aqsreference).  You can only use a limited set of query parameters with &#x60;search_query_native&#x60;, depending on the provider:  - **Microsoft**: &#x60;in&#x60;, &#x60;limit&#x60;, and &#x60;page_token&#x60; - **Google**: &#x60;in&#x60;, &#x60;limit&#x60;, &#x60;page_token&#x60;, and &#x60;thread_id&#x60; - **EWS**: Any parameter _except_ &#x60;thread_id&#x60;  You can also use [Microsoft Graph &#x60;$filter&#x60; queries](https://learn.microsoft.com/en-us/graph/filter-query-parameter) in this parameter. Create your filter query, prefix it with &#x60;$filter&#x3D;&#x60;, then URL-encode it.  For more information, see [Searching with Nylas](/docs/dev-guide/search/#search-messages-and-threads-using-search_query_native). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesAsyncWithHttpInfo(
        $grant_id,
        $limit = 50,
        $page_token = null,
        $select = null,
        $subject = null,
        $any_email = null,
        $to = null,
        $from = null,
        $cc = null,
        $bcc = null,
        $in = null,
        $unread = null,
        $starred = null,
        $thread_id = null,
        $received_before = null,
        $received_after = null,
        $has_attachment = null,
        $fields = 'standard',
        $search_query_native = null,
        string $contentType = self::contentTypes['getMessages'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessages200Response';
        $request = $this->getMessagesRequest($grant_id, $limit, $page_token, $select, $subject, $any_email, $to, $from, $cc, $bcc, $in, $unread, $starred, $thread_id, $received_before, $received_after, $has_attachment, $fields, $search_query_native, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getMessages'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string|null $subject Return items with a matching subject. The filter is case insensitive and will match partial subjects. (optional)
     * @param  string|null $any_email Return email messages that were sent to or received from this comma-separated list of email addresses (for example, &#x60;mail1@example.com,mail2@example.com&#x60;). You can specify a maximum of 25 email addresses. (optional)
     * @param  string|null $to Return items containing email messages sent to this email address. (optional)
     * @param  string|null $from Return items containing email messages sent from this email address. (optional)
     * @param  string|null $cc Return items containing email messages that were CC&#39;d to this email address. (optional)
     * @param  string|null $bcc Return items containing email messages that were BCC&#39;d to this email address, likely sent from the parent account. (Most SMTP gateways remove BCC information.) (optional)
     * @param  string|null $in Filter for email messages in a specific folder. Nylas uses the Folders API for both folders and Google&#39;s \&quot;labels\&quot;. For more information, see the [Folders reference](/docs/api/v3/ecc/#tag--Folders).  Google does not support filtering using folder names. You must use the folder ID. (optional)
     * @param  bool|null $unread Return items with one or more unread email messages. (optional)
     * @param  bool|null $starred Return items with one or more starred email messages. For EWS, this is only supported for Microsoft Exchange 2010 or later. (optional)
     * @param  string|null $thread_id Return items with a matching &#x60;thread_id&#x60;. (optional)
     * @param  int|null $received_before Return email messages received before this Unix timestamp. (optional)
     * @param  int|null $received_after Return email messages received after this Unix timestamp. (optional)
     * @param  bool|null $has_attachment Return email messages with attachments. (optional)
     * @param  string|null $fields Return messages with headers by specifying &#x60;include_headers&#x60;. Not supported for IMAP, iCloud, or Yahoo. For Microsoft the message headers are always empty if the message is in the sent folder. For EWS, message headers might be empty if the message was sent by the current email address. (optional, default to 'standard')
     * @param  string|null $search_query_native A URL-encoded provider-specific query string. Supported for [Google](https://support.google.com/mail/answer/7190?hl&#x3D;en), [Microsoft Graph](https://learn.microsoft.com/en-us/graph/search-query-parameter?tabs&#x3D;http#using-search-on-message-collections), and [EWS](https://learn.microsoft.com/en-us/windows/win32/lwef/-search-2x-wds-aqsreference).  You can only use a limited set of query parameters with &#x60;search_query_native&#x60;, depending on the provider:  - **Microsoft**: &#x60;in&#x60;, &#x60;limit&#x60;, and &#x60;page_token&#x60; - **Google**: &#x60;in&#x60;, &#x60;limit&#x60;, &#x60;page_token&#x60;, and &#x60;thread_id&#x60; - **EWS**: Any parameter _except_ &#x60;thread_id&#x60;  You can also use [Microsoft Graph &#x60;$filter&#x60; queries](https://learn.microsoft.com/en-us/graph/filter-query-parameter) in this parameter. Create your filter query, prefix it with &#x60;$filter&#x3D;&#x60;, then URL-encode it.  For more information, see [Searching with Nylas](/docs/dev-guide/search/#search-messages-and-threads-using-search_query_native). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessages'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getMessagesRequest(
        $grant_id,
        $limit = 50,
        $page_token = null,
        $select = null,
        $subject = null,
        $any_email = null,
        $to = null,
        $from = null,
        $cc = null,
        $bcc = null,
        $in = null,
        $unread = null,
        $starred = null,
        $thread_id = null,
        $received_before = null,
        $received_after = null,
        $has_attachment = null,
        $fields = 'standard',
        $search_query_native = null,
        string $contentType = self::contentTypes['getMessages'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getMessages'
            );
        }

        if ($limit !== null && $limit > 200) {
            throw new InvalidArgumentException('invalid value for "$limit" when calling MessagesApi.getMessages, must be smaller than or equal to 200.');
        }



















        $resourcePath = '/v3/grants/{grant_id}/messages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page_token,
            'page_token', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $select,
            'select', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $subject,
            'subject', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $any_email,
            'any_email', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $to,
            'to', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $from,
            'from', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $cc,
            'cc', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $bcc,
            'bcc', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $in,
            'in', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $unread,
            'unread', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $starred,
            'starred', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $thread_id,
            'thread_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $received_before,
            'received_before', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $received_after,
            'received_after', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $has_attachment,
            'has_attachment', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields,
            'fields', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search_query_native,
            'search_query_native', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getMessagesId
     *
     * Return a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $fields Return an email message with its headers by specifying &#x60;include_headers&#x60;. If this is a Microsoft message in the sent folder, the headers are always empty. (optional, default to 'standard')
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getMessagesId(
        string $grant_id,
        string $message_id,
        ?string $fields = 'standard',
        ?string $select = null,
        string $contentType = self::contentTypes['getMessagesId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response {
        list($response) = $this->getMessagesIdWithHttpInfo($grant_id, $message_id, $fields, $select, $contentType);

        return $response;
    }

    /**
     * Operation getMessagesIdWithHttpInfo
     *
     * Return a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $fields Return an email message with its headers by specifying &#x60;include_headers&#x60;. If this is a Microsoft message in the sent folder, the headers are always empty. (optional, default to 'standard')
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMessagesIdWithHttpInfo(
        string $grant_id,
        string $message_id,
        ?string $fields = 'standard',
        ?string $select = null,
        string $contentType = self::contentTypes['getMessagesId'][0]
    ): array {
        $request = $this->getMessagesIdRequest($grant_id, $message_id, $fields, $select, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getMessagesIdAsync
     *
     * Return a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $fields Return an email message with its headers by specifying &#x60;include_headers&#x60;. If this is a Microsoft message in the sent folder, the headers are always empty. (optional, default to 'standard')
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesIdAsync(
        string $grant_id,
        string $message_id,
        ?string $fields = 'standard',
        ?string $select = null,
        string $contentType = self::contentTypes['getMessagesId'][0]
    ): PromiseInterface {
        return $this->getMessagesIdAsyncWithHttpInfo($grant_id, $message_id, $fields, $select, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMessagesIdAsyncWithHttpInfo
     *
     * Return a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $fields Return an email message with its headers by specifying &#x60;include_headers&#x60;. If this is a Microsoft message in the sent folder, the headers are always empty. (optional, default to 'standard')
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getMessagesIdAsyncWithHttpInfo(
        $grant_id,
        $message_id,
        $fields = 'standard',
        $select = null,
        string $contentType = self::contentTypes['getMessagesId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response';
        $request = $this->getMessagesIdRequest($grant_id, $message_id, $fields, $select, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getMessagesId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $fields Return an email message with its headers by specifying &#x60;include_headers&#x60;. If this is a Microsoft message in the sent folder, the headers are always empty. (optional, default to 'standard')
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getMessagesIdRequest(
        $grant_id,
        $message_id,
        $fields = 'standard',
        $select = null,
        string $contentType = self::contentTypes['getMessagesId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getMessagesId'
            );
        }

        // verify the required parameter 'message_id' is set
        if ($message_id === null || (is_array($message_id) && count($message_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $message_id when calling getMessagesId'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/messages/{message_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields,
            'fields', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $select,
            'select', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }
        // path params
        if ($message_id !== null) {
            $resourcePath = str_replace(
                '{' . 'message_id' . '}',
                ObjectSerializer::toPathValue($message_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getScheduleById
     *
     * Return a scheduled message
     *
     * @param  string $schedule_id The ID of the scheduled email message that you want to retrieve. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getScheduleById'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getScheduleById(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['getScheduleById'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner {
        list($response) = $this->getScheduleByIdWithHttpInfo($schedule_id, $grant_id, $contentType);

        return $response;
    }

    /**
     * Operation getScheduleByIdWithHttpInfo
     *
     * Return a scheduled message
     *
     * @param  string $schedule_id The ID of the scheduled email message that you want to retrieve. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getScheduleById'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getScheduleByIdWithHttpInfo(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['getScheduleById'][0]
    ): array {
        $request = $this->getScheduleByIdRequest($schedule_id, $grant_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getScheduleByIdAsync
     *
     * Return a scheduled message
     *
     * @param  string $schedule_id The ID of the scheduled email message that you want to retrieve. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getScheduleById'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getScheduleByIdAsync(
        string $schedule_id,
        string $grant_id,
        string $contentType = self::contentTypes['getScheduleById'][0]
    ): PromiseInterface {
        return $this->getScheduleByIdAsyncWithHttpInfo($schedule_id, $grant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getScheduleByIdAsyncWithHttpInfo
     *
     * Return a scheduled message
     *
     * @param  string $schedule_id The ID of the scheduled email message that you want to retrieve. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getScheduleById'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getScheduleByIdAsyncWithHttpInfo(
        $schedule_id,
        $grant_id,
        string $contentType = self::contentTypes['getScheduleById'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner';
        $request = $this->getScheduleByIdRequest($schedule_id, $grant_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getScheduleById'
     *
     * @param  string $schedule_id The ID of the scheduled email message that you want to retrieve. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getScheduleById'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getScheduleByIdRequest(
        $schedule_id,
        $grant_id,
        string $contentType = self::contentTypes['getScheduleById'][0]
    ): Request {

        // verify the required parameter 'schedule_id' is set
        if ($schedule_id === null || (is_array($schedule_id) && count($schedule_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $schedule_id when calling getScheduleById'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getScheduleById'
            );
        }


        $resourcePath = '/v3/grants/{grant_id}/messages/schedules/{scheduleId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($schedule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'scheduleId' . '}',
                ObjectSerializer::toPathValue($schedule_id),
                $resourcePath
            );
        }
        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getSchedules
     *
     * Return scheduled messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSchedules'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]
     */
    public function getSchedules(
        string $grant_id,
        string $contentType = self::contentTypes['getSchedules'][0]
    ): array {
        list($response) = $this->getSchedulesWithHttpInfo($grant_id, $contentType);

        return $response;
    }

    /**
     * Operation getSchedulesWithHttpInfo
     *
     * Return scheduled messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSchedules'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getSchedulesWithHttpInfo(
        string $grant_id,
        string $contentType = self::contentTypes['getSchedules'][0]
    ): array {
        $request = $this->getSchedulesRequest($grant_id, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getSchedulesAsync
     *
     * Return scheduled messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSchedules'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSchedulesAsync(
        string $grant_id,
        string $contentType = self::contentTypes['getSchedules'][0]
    ): PromiseInterface {
        return $this->getSchedulesAsyncWithHttpInfo($grant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSchedulesAsyncWithHttpInfo
     *
     * Return scheduled messages
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSchedules'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getSchedulesAsyncWithHttpInfo(
        $grant_id,
        string $contentType = self::contentTypes['getSchedules'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetSchedules200ResponseInner[]';
        $request = $this->getSchedulesRequest($grant_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getSchedules'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSchedules'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getSchedulesRequest(
        $grant_id,
        string $contentType = self::contentTypes['getSchedules'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getSchedules'
            );
        }


        $resourcePath = '/v3/grants/{grant_id}/messages/schedules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation putMessagesId
     *
     * Update message attributes
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload|null $message_update_payload message_update_payload (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function putMessagesId(
        string $grant_id,
        string $message_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload $message_update_payload = null,
        string $contentType = self::contentTypes['putMessagesId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response {
        list($response) = $this->putMessagesIdWithHttpInfo($grant_id, $message_id, $select, $message_update_payload, $contentType);

        return $response;
    }

    /**
     * Operation putMessagesIdWithHttpInfo
     *
     * Update message attributes
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload|null $message_update_payload (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putMessagesId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function putMessagesIdWithHttpInfo(
        string $grant_id,
        string $message_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload $message_update_payload = null,
        string $contentType = self::contentTypes['putMessagesId'][0]
    ): array {
        $request = $this->putMessagesIdRequest($grant_id, $message_id, $select, $message_update_payload, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation putMessagesIdAsync
     *
     * Update message attributes
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload|null $message_update_payload (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putMessagesIdAsync(
        string $grant_id,
        string $message_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload $message_update_payload = null,
        string $contentType = self::contentTypes['putMessagesId'][0]
    ): PromiseInterface {
        return $this->putMessagesIdAsyncWithHttpInfo($grant_id, $message_id, $select, $message_update_payload, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putMessagesIdAsyncWithHttpInfo
     *
     * Update message attributes
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload|null $message_update_payload (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putMessagesIdAsyncWithHttpInfo(
        $grant_id,
        $message_id,
        $select = null,
        $message_update_payload = null,
        string $contentType = self::contentTypes['putMessagesId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetMessagesId200Response';
        $request = $this->putMessagesIdRequest($grant_id, $message_id, $select, $message_update_payload, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'putMessagesId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $message_id ID of the email message to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\MessageUpdatePayload|null $message_update_payload (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putMessagesId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function putMessagesIdRequest(
        $grant_id,
        $message_id,
        $select = null,
        $message_update_payload = null,
        string $contentType = self::contentTypes['putMessagesId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling putMessagesId'
            );
        }

        // verify the required parameter 'message_id' is set
        if ($message_id === null || (is_array($message_id) && count($message_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $message_id when calling putMessagesId'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/messages/{message_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $select,
            'select', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }
        // path params
        if ($message_id !== null) {
            $resourcePath = str_replace(
                '{' . 'message_id' . '}',
                ObjectSerializer::toPathValue($message_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($message_update_payload)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($message_update_payload));
            } else {
                $httpBody = $message_update_payload;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation sendMailNow
     *
     * Send a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest|null $send_mail_now_request send_mail_now_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendMailNow'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response|\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error2|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function sendMailNow(
        string $grant_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest $send_mail_now_request = null,
        string $contentType = self::contentTypes['sendMailNow'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response {
        list($response) = $this->sendMailNowWithHttpInfo($grant_id, $send_mail_now_request, $contentType);

        return $response;
    }

    /**
     * Operation sendMailNowWithHttpInfo
     *
     * Send a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest|null $send_mail_now_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendMailNow'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response|\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error2|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendMailNowWithHttpInfo(
        string $grant_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest $send_mail_now_request = null,
        string $contentType = self::contentTypes['sendMailNow'][0]
    ): array {
        $request = $this->sendMailNowRequest($grant_id, $send_mail_now_request, $contentType);

        try {
            $options = $this->createHttpClientOption();

            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 202:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error2', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error2' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error2', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 504:
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\Error1', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\Error1' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\Error1', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response';
            if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow202Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error2',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
                case 504:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\JackWH\NylasV3\EmailCalendar\Model\Error1',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);

                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation sendMailNowAsync
     *
     * Send a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest|null $send_mail_now_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendMailNow'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function sendMailNowAsync(
        string $grant_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest $send_mail_now_request = null,
        string $contentType = self::contentTypes['sendMailNow'][0]
    ): PromiseInterface {
        return $this->sendMailNowAsyncWithHttpInfo($grant_id, $send_mail_now_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendMailNowAsyncWithHttpInfo
     *
     * Send a Message
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest|null $send_mail_now_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendMailNow'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function sendMailNowAsyncWithHttpInfo(
        $grant_id,
        $send_mail_now_request = null,
        string $contentType = self::contentTypes['sendMailNow'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\SendMailNow200Response';
        $request = $this->sendMailNowRequest($grant_id, $send_mail_now_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'sendMailNow'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendMailNowRequest|null $send_mail_now_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendMailNow'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function sendMailNowRequest(
        $grant_id,
        $send_mail_now_request = null,
        string $contentType = self::contentTypes['sendMailNow'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling sendMailNow'
            );
        }



        $resourcePath = '/v3/grants/{grant_id}/messages/send';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant_id' . '}',
                ObjectSerializer::toPathValue($grant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($send_mail_now_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($send_mail_now_request));
            } else {
                $httpBody = $send_mail_now_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (Access token) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (API key) authentication (access token)
        if (! empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);

        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (! $options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
