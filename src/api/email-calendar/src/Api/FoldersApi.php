<?php
/**
 * FoldersApi
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
 * FoldersApi Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FoldersApi
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
        'deleteFoldersId' => [
            'application/json',
        ],
        'getFolder' => [
            'application/json',
        ],
        'getFoldersId' => [
            'application/json',
        ],
        'postFolder' => [
            'application/json',
        ],
        'putFoldersId' => [
            'application/json',
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
     * Operation deleteFoldersId
     *
     * Delete a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function deleteFoldersId(
        string $grant_id,
        string $folder_id,
        string $contentType = self::contentTypes['deleteFoldersId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response {
        list($response) = $this->deleteFoldersIdWithHttpInfo($grant_id, $folder_id, $contentType);

        return $response;
    }

    /**
     * Operation deleteFoldersIdWithHttpInfo
     *
     * Delete a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteFoldersIdWithHttpInfo(
        string $grant_id,
        string $folder_id,
        string $contentType = self::contentTypes['deleteFoldersId'][0]
    ): array {
        $request = $this->deleteFoldersIdRequest($grant_id, $folder_id, $contentType);

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
     * Operation deleteFoldersIdAsync
     *
     * Delete a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteFoldersIdAsync(
        string $grant_id,
        string $folder_id,
        string $contentType = self::contentTypes['deleteFoldersId'][0]
    ): PromiseInterface {
        return $this->deleteFoldersIdAsyncWithHttpInfo($grant_id, $folder_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteFoldersIdAsyncWithHttpInfo
     *
     * Delete a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteFoldersIdAsyncWithHttpInfo(
        $grant_id,
        $folder_id,
        string $contentType = self::contentTypes['deleteFoldersId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response';
        $request = $this->deleteFoldersIdRequest($grant_id, $folder_id, $contentType);

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
     * Create request for operation 'deleteFoldersId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteFoldersIdRequest(
        $grant_id,
        $folder_id,
        string $contentType = self::contentTypes['deleteFoldersId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling deleteFoldersId'
            );
        }

        // verify the required parameter 'folder_id' is set
        if ($folder_id === null || (is_array($folder_id) && count($folder_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $folder_id when calling deleteFoldersId'
            );
        }


        $resourcePath = '/v3/grants/{grant_id}/folders/{folder_id}';
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
        if ($folder_id !== null) {
            $resourcePath = str_replace(
                '{' . 'folder_id' . '}',
                ObjectSerializer::toPathValue($folder_id),
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
     * Operation getFolder
     *
     * Return all folders
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $parent_id (Microsoft and EWS only.) Use the ID of a folder to find all child folders it contains. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFolder'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getFolder(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $parent_id = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getFolder'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response {
        list($response) = $this->getFolderWithHttpInfo($grant_id, $limit, $page_token, $parent_id, $select, $contentType);

        return $response;
    }

    /**
     * Operation getFolderWithHttpInfo
     *
     * Return all folders
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $parent_id (Microsoft and EWS only.) Use the ID of a folder to find all child folders it contains. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFolder'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getFolderWithHttpInfo(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $parent_id = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getFolder'][0]
    ): array {
        $request = $this->getFolderRequest($grant_id, $limit, $page_token, $parent_id, $select, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response',
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
     * Operation getFolderAsync
     *
     * Return all folders
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $parent_id (Microsoft and EWS only.) Use the ID of a folder to find all child folders it contains. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFolderAsync(
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?string $parent_id = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getFolder'][0]
    ): PromiseInterface {
        return $this->getFolderAsyncWithHttpInfo($grant_id, $limit, $page_token, $parent_id, $select, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFolderAsyncWithHttpInfo
     *
     * Return all folders
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $parent_id (Microsoft and EWS only.) Use the ID of a folder to find all child folders it contains. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFolderAsyncWithHttpInfo(
        $grant_id,
        $limit = 50,
        $page_token = null,
        $parent_id = null,
        $select = null,
        string $contentType = self::contentTypes['getFolder'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetFolder200Response';
        $request = $this->getFolderRequest($grant_id, $limit, $page_token, $parent_id, $select, $contentType);

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
     * Create request for operation 'getFolder'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  string|null $parent_id (Microsoft and EWS only.) Use the ID of a folder to find all child folders it contains. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getFolderRequest(
        $grant_id,
        $limit = 50,
        $page_token = null,
        $parent_id = null,
        $select = null,
        string $contentType = self::contentTypes['getFolder'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getFolder'
            );
        }

        if ($limit !== null && $limit > 200) {
            throw new InvalidArgumentException('invalid value for "$limit" when calling FoldersApi.getFolder, must be smaller than or equal to 200.');
        }





        $resourcePath = '/v3/grants/{grant_id}/folders';
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
            $parent_id,
            'parent_id', // param base name
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
     * Operation getFoldersId
     *
     * Return a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getFoldersId(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getFoldersId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response {
        list($response) = $this->getFoldersIdWithHttpInfo($grant_id, $folder_id, $select, $contentType);

        return $response;
    }

    /**
     * Operation getFoldersIdWithHttpInfo
     *
     * Return a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getFoldersIdWithHttpInfo(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getFoldersId'][0]
    ): array {
        $request = $this->getFoldersIdRequest($grant_id, $folder_id, $select, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response',
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
     * Operation getFoldersIdAsync
     *
     * Return a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFoldersIdAsync(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getFoldersId'][0]
    ): PromiseInterface {
        return $this->getFoldersIdAsyncWithHttpInfo($grant_id, $folder_id, $select, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFoldersIdAsyncWithHttpInfo
     *
     * Return a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFoldersIdAsyncWithHttpInfo(
        $grant_id,
        $folder_id,
        $select = null,
        string $contentType = self::contentTypes['getFoldersId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
        $request = $this->getFoldersIdRequest($grant_id, $folder_id, $select, $contentType);

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
     * Create request for operation 'getFoldersId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getFoldersIdRequest(
        $grant_id,
        $folder_id,
        $select = null,
        string $contentType = self::contentTypes['getFoldersId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getFoldersId'
            );
        }

        // verify the required parameter 'folder_id' is set
        if ($folder_id === null || (is_array($folder_id) && count($folder_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $folder_id when calling getFoldersId'
            );
        }



        $resourcePath = '/v3/grants/{grant_id}/folders/{folder_id}';
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
        if ($folder_id !== null) {
            $resourcePath = str_replace(
                '{' . 'folder_id' . '}',
                ObjectSerializer::toPathValue($folder_id),
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
     * Operation postFolder
     *
     * Create a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postFolder'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function postFolder(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['postFolder'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response {
        list($response) = $this->postFolderWithHttpInfo($grant_id, $select, $create_folder1, $contentType);

        return $response;
    }

    /**
     * Operation postFolderWithHttpInfo
     *
     * Create a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postFolder'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function postFolderWithHttpInfo(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['postFolder'][0]
    ): array {
        $request = $this->postFolderRequest($grant_id, $select, $create_folder1, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response',
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
     * Operation postFolderAsync
     *
     * Create a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function postFolderAsync(
        string $grant_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['postFolder'][0]
    ): PromiseInterface {
        return $this->postFolderAsyncWithHttpInfo($grant_id, $select, $create_folder1, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postFolderAsyncWithHttpInfo
     *
     * Create a Folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function postFolderAsyncWithHttpInfo(
        $grant_id,
        $select = null,
        $create_folder1 = null,
        string $contentType = self::contentTypes['postFolder'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
        $request = $this->postFolderRequest($grant_id, $select, $create_folder1, $contentType);

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
     * Create request for operation 'postFolder'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postFolder'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function postFolderRequest(
        $grant_id,
        $select = null,
        $create_folder1 = null,
        string $contentType = self::contentTypes['postFolder'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling postFolder'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/folders';
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
        if (isset($create_folder1)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_folder1));
            } else {
                $httpBody = $create_folder1;
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
     * Operation putFoldersId
     *
     * Update a folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function putFoldersId(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['putFoldersId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response {
        list($response) = $this->putFoldersIdWithHttpInfo($grant_id, $folder_id, $select, $create_folder1, $contentType);

        return $response;
    }

    /**
     * Operation putFoldersIdWithHttpInfo
     *
     * Update a folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFoldersId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function putFoldersIdWithHttpInfo(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['putFoldersId'][0]
    ): array {
        $request = $this->putFoldersIdRequest($grant_id, $folder_id, $select, $create_folder1, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response',
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
     * Operation putFoldersIdAsync
     *
     * Update a folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putFoldersIdAsync(
        string $grant_id,
        string $folder_id,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateFolder1 $create_folder1 = null,
        string $contentType = self::contentTypes['putFoldersId'][0]
    ): PromiseInterface {
        return $this->putFoldersIdAsyncWithHttpInfo($grant_id, $folder_id, $select, $create_folder1, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putFoldersIdAsyncWithHttpInfo
     *
     * Update a folder
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putFoldersIdAsyncWithHttpInfo(
        $grant_id,
        $folder_id,
        $select = null,
        $create_folder1 = null,
        string $contentType = self::contentTypes['putFoldersId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostFolder200Response';
        $request = $this->putFoldersIdRequest($grant_id, $folder_id, $select, $create_folder1, $contentType);

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
     * Create request for operation 'putFoldersId'
     *
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $folder_id ID of the folder to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateFolder1|null $create_folder1 (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putFoldersId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function putFoldersIdRequest(
        $grant_id,
        $folder_id,
        $select = null,
        $create_folder1 = null,
        string $contentType = self::contentTypes['putFoldersId'][0]
    ): Request {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling putFoldersId'
            );
        }

        // verify the required parameter 'folder_id' is set
        if ($folder_id === null || (is_array($folder_id) && count($folder_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $folder_id when calling putFoldersId'
            );
        }




        $resourcePath = '/v3/grants/{grant_id}/folders/{folder_id}';
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
        if ($folder_id !== null) {
            $resourcePath = str_replace(
                '{' . 'folder_id' . '}',
                ObjectSerializer::toPathValue($folder_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_folder1)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_folder1));
            } else {
                $httpBody = $create_folder1;
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
