<?php
/**
 * EventsApi
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
 * EventsApi Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EventsApi
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
        'deleteEventsId' => [
            'application/json',
        ],
        'getEvents' => [
            'application/json',
        ],
        'getEventsId' => [
            'application/json',
        ],
        'postEvents' => [
            'application/json',
        ],
        'putEventsId' => [
            'application/json',
        ],
        'sendRsvp' => [
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
     * Operation deleteEventsId
     *
     * Delete an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function deleteEventsId(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        string $contentType = self::contentTypes['deleteEventsId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response {
        list($response) = $this->deleteEventsIdWithHttpInfo($calendar_id, $grant_id, $event_id, $notify_participants, $contentType);

        return $response;
    }

    /**
     * Operation deleteEventsIdWithHttpInfo
     *
     * Delete an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteEventsIdWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        string $contentType = self::contentTypes['deleteEventsId'][0]
    ): array {
        $request = $this->deleteEventsIdRequest($calendar_id, $grant_id, $event_id, $notify_participants, $contentType);

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
     * Operation deleteEventsIdAsync
     *
     * Delete an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteEventsIdAsync(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        string $contentType = self::contentTypes['deleteEventsId'][0]
    ): PromiseInterface {
        return $this->deleteEventsIdAsyncWithHttpInfo($calendar_id, $grant_id, $event_id, $notify_participants, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteEventsIdAsyncWithHttpInfo
     *
     * Delete an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteEventsIdAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $event_id,
        $notify_participants = true,
        string $contentType = self::contentTypes['deleteEventsId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\DeleteCalendarsId200Response';
        $request = $this->deleteEventsIdRequest($calendar_id, $grant_id, $event_id, $notify_participants, $contentType);

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
     * Create request for operation 'deleteEventsId'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteEventsIdRequest(
        $calendar_id,
        $grant_id,
        $event_id,
        $notify_participants = true,
        string $contentType = self::contentTypes['deleteEventsId'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling deleteEventsId'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling deleteEventsId'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling deleteEventsId'
            );
        }



        $resourcePath = '/v3/grants/{grant_id}/events/{event_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $notify_participants,
            'notify_participants', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
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
        if ($event_id !== null) {
            $resourcePath = str_replace(
                '{' . 'event_id' . '}',
                ObjectSerializer::toPathValue($event_id),
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
     * Operation getEvents
     *
     * Return all events
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  bool|null $show_cancelled (Not supported for iCloud or EWS) If &#x60;true&#x60;, Nylas filters for events whose &#x60;status&#x60; is &#x60;cancelled&#x60;. Nylas returns recurring events regardless of the value of &#x60;show_cancelled&#x60;.  Different providers have different semantics for cancelled events:  - **Google**: An event is considered cancelled after an end user deletes it from their calendar, until it is eventually hard-deleted and is no longer readable. - **Microsoft**: An event is considered cancelled if the end user is invited to an event and the organizer deletes it. The cancelled version of the event stays on the participants&#39; calendars until they delete it manually. (optional, default to false)
     * @param  string|null $title Filter for events that match the specified title. The filter is case insensitive and will match partial titles. (optional)
     * @param  string|null $description Filter for events matching the specified description. The filter is case insensitive and will match partial descriptions. (optional)
     * @param  string|null $ical_uid (Not supported for iCloud) Filter for events with the specified &#x60;ical_uid&#x60;. You _cannot_ apply other filters if you use this parameter. (optional)
     * @param  string|null $location Filter for events with the specified location. The filter is case insensitive and will match partial locations. (optional)
     * @param  int|null $start Filter for events that start at or before the specified time, in Unix epoch format. For example, if you filter for events that start at 9:00a.m., and the calendar includes an event that runs from 8:30–9:30a.m., Nylas returns that event.  Defaults to the time that you make the request.  The &#x60;start&#x60; value cannot be later than &#x60;end&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  int|null $end Filter for events that end at or before the specified time, in Unix epoch format. For example, if you filter for events that end at 5:00p.m., and the calendar includes an event that runs from 4:30–5:30p.m., Nylas returns that event.  Defaults to one month from the time you make the request.  The &#x60;end&#x60; value cannot be earlier than &#x60;start&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  string|null $master_event_id (Not supported for iCloud) Filter for instances of recurring events with the specified &#x60;master_event_id&#x60;.  &#x60;master_event_id&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $metadata_pair Pass a metadata key/value pair (for example, &#x60;?metadata_pair&#x3D;key1:value&#x60;) to search for metadata associated with objects. See [Metadata](/docs/api/v3/ecc/#overview--metadata) for more information. (optional)
     * @param  bool|null $busy (Not supported for iCloud) Filter for events with the specified &#x60;busy&#x60; status. (optional)
     * @param  int|null $updated_before (Google, Microsoft, and EWS only) Filter for events that have been updated before the specified time, in Unix epoch format.  &#x60;updated_before&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  int|null $updated_after (Google, Microsoft, and EWS only) Filter for events that have been updated after the specified time, in Unix epoch format.  &#x60;updated_after&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $attendees (Not supported for virtual calendars) Filter for events that include the specified attendees. This parameter accepts a comma-delimited list of email addresses. (optional)
     * @param  string|null $event_type (Google only) Filter for events with the specified event type. You can pass this query parameter multiple times to select or exclude multiple event types. For example, &#x60;event_type&#x3D;default&amp;event_type&#x3D;outOfOffice&#x60; returns all events that are default or &#x60;OOO&#x60;, and excludes any events that are &#x60;focusTime&#x60; or that have a &#x60;workingLocation&#x60;.  If you don&#39;t specify an event type, Nylas uses &#x60;default&#x60; to filter for regular events that don&#39;t have another specific type. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEvents'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getEvents(
        string $calendar_id,
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?bool $show_cancelled = false,
        ?string $title = null,
        ?string $description = null,
        ?string $ical_uid = null,
        ?string $location = null,
        ?int $start = null,
        ?int $end = null,
        ?string $master_event_id = null,
        ?string $metadata_pair = null,
        ?bool $busy = null,
        ?int $updated_before = null,
        ?int $updated_after = null,
        ?string $attendees = null,
        ?string $event_type = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getEvents'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response {
        list($response) = $this->getEventsWithHttpInfo($calendar_id, $grant_id, $limit, $page_token, $show_cancelled, $title, $description, $ical_uid, $location, $start, $end, $master_event_id, $metadata_pair, $busy, $updated_before, $updated_after, $attendees, $event_type, $select, $contentType);

        return $response;
    }

    /**
     * Operation getEventsWithHttpInfo
     *
     * Return all events
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  bool|null $show_cancelled (Not supported for iCloud or EWS) If &#x60;true&#x60;, Nylas filters for events whose &#x60;status&#x60; is &#x60;cancelled&#x60;. Nylas returns recurring events regardless of the value of &#x60;show_cancelled&#x60;.  Different providers have different semantics for cancelled events:  - **Google**: An event is considered cancelled after an end user deletes it from their calendar, until it is eventually hard-deleted and is no longer readable. - **Microsoft**: An event is considered cancelled if the end user is invited to an event and the organizer deletes it. The cancelled version of the event stays on the participants&#39; calendars until they delete it manually. (optional, default to false)
     * @param  string|null $title Filter for events that match the specified title. The filter is case insensitive and will match partial titles. (optional)
     * @param  string|null $description Filter for events matching the specified description. The filter is case insensitive and will match partial descriptions. (optional)
     * @param  string|null $ical_uid (Not supported for iCloud) Filter for events with the specified &#x60;ical_uid&#x60;. You _cannot_ apply other filters if you use this parameter. (optional)
     * @param  string|null $location Filter for events with the specified location. The filter is case insensitive and will match partial locations. (optional)
     * @param  int|null $start Filter for events that start at or before the specified time, in Unix epoch format. For example, if you filter for events that start at 9:00a.m., and the calendar includes an event that runs from 8:30–9:30a.m., Nylas returns that event.  Defaults to the time that you make the request.  The &#x60;start&#x60; value cannot be later than &#x60;end&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  int|null $end Filter for events that end at or before the specified time, in Unix epoch format. For example, if you filter for events that end at 5:00p.m., and the calendar includes an event that runs from 4:30–5:30p.m., Nylas returns that event.  Defaults to one month from the time you make the request.  The &#x60;end&#x60; value cannot be earlier than &#x60;start&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  string|null $master_event_id (Not supported for iCloud) Filter for instances of recurring events with the specified &#x60;master_event_id&#x60;.  &#x60;master_event_id&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $metadata_pair Pass a metadata key/value pair (for example, &#x60;?metadata_pair&#x3D;key1:value&#x60;) to search for metadata associated with objects. See [Metadata](/docs/api/v3/ecc/#overview--metadata) for more information. (optional)
     * @param  bool|null $busy (Not supported for iCloud) Filter for events with the specified &#x60;busy&#x60; status. (optional)
     * @param  int|null $updated_before (Google, Microsoft, and EWS only) Filter for events that have been updated before the specified time, in Unix epoch format.  &#x60;updated_before&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  int|null $updated_after (Google, Microsoft, and EWS only) Filter for events that have been updated after the specified time, in Unix epoch format.  &#x60;updated_after&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $attendees (Not supported for virtual calendars) Filter for events that include the specified attendees. This parameter accepts a comma-delimited list of email addresses. (optional)
     * @param  string|null $event_type (Google only) Filter for events with the specified event type. You can pass this query parameter multiple times to select or exclude multiple event types. For example, &#x60;event_type&#x3D;default&amp;event_type&#x3D;outOfOffice&#x60; returns all events that are default or &#x60;OOO&#x60;, and excludes any events that are &#x60;focusTime&#x60; or that have a &#x60;workingLocation&#x60;.  If you don&#39;t specify an event type, Nylas uses &#x60;default&#x60; to filter for regular events that don&#39;t have another specific type. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEvents'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEventsWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?bool $show_cancelled = false,
        ?string $title = null,
        ?string $description = null,
        ?string $ical_uid = null,
        ?string $location = null,
        ?int $start = null,
        ?int $end = null,
        ?string $master_event_id = null,
        ?string $metadata_pair = null,
        ?bool $busy = null,
        ?int $updated_before = null,
        ?int $updated_after = null,
        ?string $attendees = null,
        ?string $event_type = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getEvents'][0]
    ): array {
        $request = $this->getEventsRequest($calendar_id, $grant_id, $limit, $page_token, $show_cancelled, $title, $description, $ical_uid, $location, $start, $end, $master_event_id, $metadata_pair, $busy, $updated_before, $updated_after, $attendees, $event_type, $select, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response',
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
     * Operation getEventsAsync
     *
     * Return all events
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  bool|null $show_cancelled (Not supported for iCloud or EWS) If &#x60;true&#x60;, Nylas filters for events whose &#x60;status&#x60; is &#x60;cancelled&#x60;. Nylas returns recurring events regardless of the value of &#x60;show_cancelled&#x60;.  Different providers have different semantics for cancelled events:  - **Google**: An event is considered cancelled after an end user deletes it from their calendar, until it is eventually hard-deleted and is no longer readable. - **Microsoft**: An event is considered cancelled if the end user is invited to an event and the organizer deletes it. The cancelled version of the event stays on the participants&#39; calendars until they delete it manually. (optional, default to false)
     * @param  string|null $title Filter for events that match the specified title. The filter is case insensitive and will match partial titles. (optional)
     * @param  string|null $description Filter for events matching the specified description. The filter is case insensitive and will match partial descriptions. (optional)
     * @param  string|null $ical_uid (Not supported for iCloud) Filter for events with the specified &#x60;ical_uid&#x60;. You _cannot_ apply other filters if you use this parameter. (optional)
     * @param  string|null $location Filter for events with the specified location. The filter is case insensitive and will match partial locations. (optional)
     * @param  int|null $start Filter for events that start at or before the specified time, in Unix epoch format. For example, if you filter for events that start at 9:00a.m., and the calendar includes an event that runs from 8:30–9:30a.m., Nylas returns that event.  Defaults to the time that you make the request.  The &#x60;start&#x60; value cannot be later than &#x60;end&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  int|null $end Filter for events that end at or before the specified time, in Unix epoch format. For example, if you filter for events that end at 5:00p.m., and the calendar includes an event that runs from 4:30–5:30p.m., Nylas returns that event.  Defaults to one month from the time you make the request.  The &#x60;end&#x60; value cannot be earlier than &#x60;start&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  string|null $master_event_id (Not supported for iCloud) Filter for instances of recurring events with the specified &#x60;master_event_id&#x60;.  &#x60;master_event_id&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $metadata_pair Pass a metadata key/value pair (for example, &#x60;?metadata_pair&#x3D;key1:value&#x60;) to search for metadata associated with objects. See [Metadata](/docs/api/v3/ecc/#overview--metadata) for more information. (optional)
     * @param  bool|null $busy (Not supported for iCloud) Filter for events with the specified &#x60;busy&#x60; status. (optional)
     * @param  int|null $updated_before (Google, Microsoft, and EWS only) Filter for events that have been updated before the specified time, in Unix epoch format.  &#x60;updated_before&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  int|null $updated_after (Google, Microsoft, and EWS only) Filter for events that have been updated after the specified time, in Unix epoch format.  &#x60;updated_after&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $attendees (Not supported for virtual calendars) Filter for events that include the specified attendees. This parameter accepts a comma-delimited list of email addresses. (optional)
     * @param  string|null $event_type (Google only) Filter for events with the specified event type. You can pass this query parameter multiple times to select or exclude multiple event types. For example, &#x60;event_type&#x3D;default&amp;event_type&#x3D;outOfOffice&#x60; returns all events that are default or &#x60;OOO&#x60;, and excludes any events that are &#x60;focusTime&#x60; or that have a &#x60;workingLocation&#x60;.  If you don&#39;t specify an event type, Nylas uses &#x60;default&#x60; to filter for regular events that don&#39;t have another specific type. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getEventsAsync(
        string $calendar_id,
        string $grant_id,
        ?int $limit = 50,
        ?string $page_token = null,
        ?bool $show_cancelled = false,
        ?string $title = null,
        ?string $description = null,
        ?string $ical_uid = null,
        ?string $location = null,
        ?int $start = null,
        ?int $end = null,
        ?string $master_event_id = null,
        ?string $metadata_pair = null,
        ?bool $busy = null,
        ?int $updated_before = null,
        ?int $updated_after = null,
        ?string $attendees = null,
        ?string $event_type = null,
        ?string $select = null,
        string $contentType = self::contentTypes['getEvents'][0]
    ): PromiseInterface {
        return $this->getEventsAsyncWithHttpInfo($calendar_id, $grant_id, $limit, $page_token, $show_cancelled, $title, $description, $ical_uid, $location, $start, $end, $master_event_id, $metadata_pair, $busy, $updated_before, $updated_after, $attendees, $event_type, $select, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getEventsAsyncWithHttpInfo
     *
     * Return all events
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  bool|null $show_cancelled (Not supported for iCloud or EWS) If &#x60;true&#x60;, Nylas filters for events whose &#x60;status&#x60; is &#x60;cancelled&#x60;. Nylas returns recurring events regardless of the value of &#x60;show_cancelled&#x60;.  Different providers have different semantics for cancelled events:  - **Google**: An event is considered cancelled after an end user deletes it from their calendar, until it is eventually hard-deleted and is no longer readable. - **Microsoft**: An event is considered cancelled if the end user is invited to an event and the organizer deletes it. The cancelled version of the event stays on the participants&#39; calendars until they delete it manually. (optional, default to false)
     * @param  string|null $title Filter for events that match the specified title. The filter is case insensitive and will match partial titles. (optional)
     * @param  string|null $description Filter for events matching the specified description. The filter is case insensitive and will match partial descriptions. (optional)
     * @param  string|null $ical_uid (Not supported for iCloud) Filter for events with the specified &#x60;ical_uid&#x60;. You _cannot_ apply other filters if you use this parameter. (optional)
     * @param  string|null $location Filter for events with the specified location. The filter is case insensitive and will match partial locations. (optional)
     * @param  int|null $start Filter for events that start at or before the specified time, in Unix epoch format. For example, if you filter for events that start at 9:00a.m., and the calendar includes an event that runs from 8:30–9:30a.m., Nylas returns that event.  Defaults to the time that you make the request.  The &#x60;start&#x60; value cannot be later than &#x60;end&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  int|null $end Filter for events that end at or before the specified time, in Unix epoch format. For example, if you filter for events that end at 5:00p.m., and the calendar includes an event that runs from 4:30–5:30p.m., Nylas returns that event.  Defaults to one month from the time you make the request.  The &#x60;end&#x60; value cannot be earlier than &#x60;start&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  string|null $master_event_id (Not supported for iCloud) Filter for instances of recurring events with the specified &#x60;master_event_id&#x60;.  &#x60;master_event_id&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $metadata_pair Pass a metadata key/value pair (for example, &#x60;?metadata_pair&#x3D;key1:value&#x60;) to search for metadata associated with objects. See [Metadata](/docs/api/v3/ecc/#overview--metadata) for more information. (optional)
     * @param  bool|null $busy (Not supported for iCloud) Filter for events with the specified &#x60;busy&#x60; status. (optional)
     * @param  int|null $updated_before (Google, Microsoft, and EWS only) Filter for events that have been updated before the specified time, in Unix epoch format.  &#x60;updated_before&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  int|null $updated_after (Google, Microsoft, and EWS only) Filter for events that have been updated after the specified time, in Unix epoch format.  &#x60;updated_after&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $attendees (Not supported for virtual calendars) Filter for events that include the specified attendees. This parameter accepts a comma-delimited list of email addresses. (optional)
     * @param  string|null $event_type (Google only) Filter for events with the specified event type. You can pass this query parameter multiple times to select or exclude multiple event types. For example, &#x60;event_type&#x3D;default&amp;event_type&#x3D;outOfOffice&#x60; returns all events that are default or &#x60;OOO&#x60;, and excludes any events that are &#x60;focusTime&#x60; or that have a &#x60;workingLocation&#x60;.  If you don&#39;t specify an event type, Nylas uses &#x60;default&#x60; to filter for regular events that don&#39;t have another specific type. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getEventsAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $limit = 50,
        $page_token = null,
        $show_cancelled = false,
        $title = null,
        $description = null,
        $ical_uid = null,
        $location = null,
        $start = null,
        $end = null,
        $master_event_id = null,
        $metadata_pair = null,
        $busy = null,
        $updated_before = null,
        $updated_after = null,
        $attendees = null,
        $event_type = null,
        $select = null,
        string $contentType = self::contentTypes['getEvents'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\GetEvents200Response';
        $request = $this->getEventsRequest($calendar_id, $grant_id, $limit, $page_token, $show_cancelled, $title, $description, $ical_uid, $location, $start, $end, $master_event_id, $metadata_pair, $busy, $updated_before, $updated_after, $attendees, $event_type, $select, $contentType);

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
     * Create request for operation 'getEvents'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  int|null $limit The maximum number of objects to return. See [pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional, default to 50)
     * @param  string|null $page_token An identifier that specifies which page of data to return. You can get this value from the &#x60;next_cursor&#x60; response field. See [Pagination](/docs/api/v3/ecc/#overview--pagination) for more information. (optional)
     * @param  bool|null $show_cancelled (Not supported for iCloud or EWS) If &#x60;true&#x60;, Nylas filters for events whose &#x60;status&#x60; is &#x60;cancelled&#x60;. Nylas returns recurring events regardless of the value of &#x60;show_cancelled&#x60;.  Different providers have different semantics for cancelled events:  - **Google**: An event is considered cancelled after an end user deletes it from their calendar, until it is eventually hard-deleted and is no longer readable. - **Microsoft**: An event is considered cancelled if the end user is invited to an event and the organizer deletes it. The cancelled version of the event stays on the participants&#39; calendars until they delete it manually. (optional, default to false)
     * @param  string|null $title Filter for events that match the specified title. The filter is case insensitive and will match partial titles. (optional)
     * @param  string|null $description Filter for events matching the specified description. The filter is case insensitive and will match partial descriptions. (optional)
     * @param  string|null $ical_uid (Not supported for iCloud) Filter for events with the specified &#x60;ical_uid&#x60;. You _cannot_ apply other filters if you use this parameter. (optional)
     * @param  string|null $location Filter for events with the specified location. The filter is case insensitive and will match partial locations. (optional)
     * @param  int|null $start Filter for events that start at or before the specified time, in Unix epoch format. For example, if you filter for events that start at 9:00a.m., and the calendar includes an event that runs from 8:30–9:30a.m., Nylas returns that event.  Defaults to the time that you make the request.  The &#x60;start&#x60; value cannot be later than &#x60;end&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  int|null $end Filter for events that end at or before the specified time, in Unix epoch format. For example, if you filter for events that end at 5:00p.m., and the calendar includes an event that runs from 4:30–5:30p.m., Nylas returns that event.  Defaults to one month from the time you make the request.  The &#x60;end&#x60; value cannot be earlier than &#x60;start&#x60;. For iCloud accounts, the difference between &#x60;start&#x60; and &#x60;end&#x60; can&#39;t be greater than six months. (optional)
     * @param  string|null $master_event_id (Not supported for iCloud) Filter for instances of recurring events with the specified &#x60;master_event_id&#x60;.  &#x60;master_event_id&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $metadata_pair Pass a metadata key/value pair (for example, &#x60;?metadata_pair&#x3D;key1:value&#x60;) to search for metadata associated with objects. See [Metadata](/docs/api/v3/ecc/#overview--metadata) for more information. (optional)
     * @param  bool|null $busy (Not supported for iCloud) Filter for events with the specified &#x60;busy&#x60; status. (optional)
     * @param  int|null $updated_before (Google, Microsoft, and EWS only) Filter for events that have been updated before the specified time, in Unix epoch format.  &#x60;updated_before&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  int|null $updated_after (Google, Microsoft, and EWS only) Filter for events that have been updated after the specified time, in Unix epoch format.  &#x60;updated_after&#x60; is _not_ respected by metadata filtering. (optional)
     * @param  string|null $attendees (Not supported for virtual calendars) Filter for events that include the specified attendees. This parameter accepts a comma-delimited list of email addresses. (optional)
     * @param  string|null $event_type (Google only) Filter for events with the specified event type. You can pass this query parameter multiple times to select or exclude multiple event types. For example, &#x60;event_type&#x3D;default&amp;event_type&#x3D;outOfOffice&#x60; returns all events that are default or &#x60;OOO&#x60;, and excludes any events that are &#x60;focusTime&#x60; or that have a &#x60;workingLocation&#x60;.  If you don&#39;t specify an event type, Nylas uses &#x60;default&#x60; to filter for regular events that don&#39;t have another specific type. (optional)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getEventsRequest(
        $calendar_id,
        $grant_id,
        $limit = 50,
        $page_token = null,
        $show_cancelled = false,
        $title = null,
        $description = null,
        $ical_uid = null,
        $location = null,
        $start = null,
        $end = null,
        $master_event_id = null,
        $metadata_pair = null,
        $busy = null,
        $updated_before = null,
        $updated_after = null,
        $attendees = null,
        $event_type = null,
        $select = null,
        string $contentType = self::contentTypes['getEvents'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling getEvents'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getEvents'
            );
        }

        if ($limit !== null && $limit > 200) {
            throw new InvalidArgumentException('invalid value for "$limit" when calling EventsApi.getEvents, must be smaller than or equal to 200.');
        }


















        $resourcePath = '/v3/grants/{grant_id}/events';
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
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $show_cancelled,
            'show_cancelled', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $title,
            'title', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $description,
            'description', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ical_uid,
            'ical_uid', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $location,
            'location', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $start,
            'start', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $end,
            'end', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $master_event_id,
            'master_event_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $metadata_pair,
            'metadata_pair', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $busy,
            'busy', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $updated_before,
            'updated_before', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $updated_after,
            'updated_after', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $attendees,
            'attendees', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $event_type,
            'event_type', // param base name
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
     * Operation getEventsId
     *
     * Return an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function getEventsId(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getEventsId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response {
        list($response) = $this->getEventsIdWithHttpInfo($calendar_id, $grant_id, $event_id, $select, $contentType);

        return $response;
    }

    /**
     * Operation getEventsIdWithHttpInfo
     *
     * Return an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEventsIdWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getEventsId'][0]
    ): array {
        $request = $this->getEventsIdRequest($calendar_id, $grant_id, $event_id, $select, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response',
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
     * Operation getEventsIdAsync
     *
     * Return an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getEventsIdAsync(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?string $select = null,
        string $contentType = self::contentTypes['getEventsId'][0]
    ): PromiseInterface {
        return $this->getEventsIdAsyncWithHttpInfo($calendar_id, $grant_id, $event_id, $select, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getEventsIdAsyncWithHttpInfo
     *
     * Return an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getEventsIdAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $event_id,
        $select = null,
        string $contentType = self::contentTypes['getEventsId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
        $request = $this->getEventsIdRequest($calendar_id, $grant_id, $event_id, $select, $contentType);

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
     * Create request for operation 'getEventsId'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getEventsIdRequest(
        $calendar_id,
        $grant_id,
        $event_id,
        $select = null,
        string $contentType = self::contentTypes['getEventsId'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling getEventsId'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling getEventsId'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling getEventsId'
            );
        }



        $resourcePath = '/v3/grants/{grant_id}/events/{event_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
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
        if ($event_id !== null) {
            $resourcePath = str_replace(
                '{' . 'event_id' . '}',
                ObjectSerializer::toPathValue($event_id),
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
     * Operation postEvents
     *
     * Create an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateEvent|null $create_event create_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postEvents'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function postEvents(
        string $calendar_id,
        string $grant_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateEvent $create_event = null,
        string $contentType = self::contentTypes['postEvents'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response {
        list($response) = $this->postEventsWithHttpInfo($calendar_id, $grant_id, $notify_participants, $select, $create_event, $contentType);

        return $response;
    }

    /**
     * Operation postEventsWithHttpInfo
     *
     * Create an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateEvent|null $create_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postEvents'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function postEventsWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateEvent $create_event = null,
        string $contentType = self::contentTypes['postEvents'][0]
    ): array {
        $request = $this->postEventsRequest($calendar_id, $grant_id, $notify_participants, $select, $create_event, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response',
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
     * Operation postEventsAsync
     *
     * Create an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateEvent|null $create_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function postEventsAsync(
        string $calendar_id,
        string $grant_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\CreateEvent $create_event = null,
        string $contentType = self::contentTypes['postEvents'][0]
    ): PromiseInterface {
        return $this->postEventsAsyncWithHttpInfo($calendar_id, $grant_id, $notify_participants, $select, $create_event, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postEventsAsyncWithHttpInfo
     *
     * Create an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateEvent|null $create_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function postEventsAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $notify_participants = true,
        $select = null,
        $create_event = null,
        string $contentType = self::contentTypes['postEvents'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
        $request = $this->postEventsRequest($calendar_id, $grant_id, $notify_participants, $select, $create_event, $contentType);

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
     * Create request for operation 'postEvents'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\CreateEvent|null $create_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['postEvents'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function postEventsRequest(
        $calendar_id,
        $grant_id,
        $notify_participants = true,
        $select = null,
        $create_event = null,
        string $contentType = self::contentTypes['postEvents'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling postEvents'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling postEvents'
            );
        }





        $resourcePath = '/v3/grants/{grant_id}/events';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $notify_participants,
            'notify_participants', // param base name
            'boolean', // openApiType
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
        if (isset($create_event)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_event));
            } else {
                $httpBody = $create_event;
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
     * Operation putEventsId
     *
     * Update an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\UpdateEvent|null $update_event update_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function putEventsId(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\UpdateEvent $update_event = null,
        string $contentType = self::contentTypes['putEventsId'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response {
        list($response) = $this->putEventsIdWithHttpInfo($calendar_id, $grant_id, $event_id, $notify_participants, $select, $update_event, $contentType);

        return $response;
    }

    /**
     * Operation putEventsIdWithHttpInfo
     *
     * Update an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\UpdateEvent|null $update_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putEventsId'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function putEventsIdWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\UpdateEvent $update_event = null,
        string $contentType = self::contentTypes['putEventsId'][0]
    ): array {
        $request = $this->putEventsIdRequest($calendar_id, $grant_id, $event_id, $notify_participants, $select, $update_event, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response',
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
     * Operation putEventsIdAsync
     *
     * Update an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\UpdateEvent|null $update_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putEventsIdAsync(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?bool $notify_participants = true,
        ?string $select = null,
        ?\JackWH\NylasV3\EmailCalendar\Model\UpdateEvent $update_event = null,
        string $contentType = self::contentTypes['putEventsId'][0]
    ): PromiseInterface {
        return $this->putEventsIdAsyncWithHttpInfo($calendar_id, $grant_id, $event_id, $notify_participants, $select, $update_event, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putEventsIdAsyncWithHttpInfo
     *
     * Update an event
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\UpdateEvent|null $update_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function putEventsIdAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $event_id,
        $notify_participants = true,
        $select = null,
        $update_event = null,
        string $contentType = self::contentTypes['putEventsId'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\PostEvents200Response';
        $request = $this->putEventsIdRequest($calendar_id, $grant_id, $event_id, $notify_participants, $select, $update_event, $contentType);

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
     * Create request for operation 'putEventsId'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  bool|null $notify_participants Filter for events matching the specified &#x60;notify_participants&#x60; setting.  Microsoft and iCloud do _not_ support &#x60;notify_participants&#x3D;false&#x60;. (optional, default to true)
     * @param  string|null $select Specify fields that you want Nylas to return, as a comma-separated list (for example, &#x60;select&#x3D;id,updated_at&#x60;). This allows you to receive only the portion of object data that you&#39;re interested in. You can use &#x60;select&#x60; to optimize response size and reduce latency by limiting queries to only the information that you need. (optional)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\UpdateEvent|null $update_event (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['putEventsId'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function putEventsIdRequest(
        $calendar_id,
        $grant_id,
        $event_id,
        $notify_participants = true,
        $select = null,
        $update_event = null,
        string $contentType = self::contentTypes['putEventsId'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling putEventsId'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling putEventsId'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling putEventsId'
            );
        }





        $resourcePath = '/v3/grants/{grant_id}/events/{event_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $notify_participants,
            'notify_participants', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
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
        if ($event_id !== null) {
            $resourcePath = str_replace(
                '{' . 'event_id' . '}',
                ObjectSerializer::toPathValue($event_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_event)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_event));
            } else {
                $httpBody = $update_event;
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
     * Operation sendRsvp
     *
     * Send RSVP
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest|null $send_rsvp_request send_rsvp_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendRsvp'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1
     */
    public function sendRsvp(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest $send_rsvp_request = null,
        string $contentType = self::contentTypes['sendRsvp'][0]
    ): \JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response {
        list($response) = $this->sendRsvpWithHttpInfo($calendar_id, $grant_id, $event_id, $send_rsvp_request, $contentType);

        return $response;
    }

    /**
     * Operation sendRsvpWithHttpInfo
     *
     * Send RSVP
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest|null $send_rsvp_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendRsvp'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of \JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error|\JackWH\NylasV3\EmailCalendar\Model\Error1|\JackWH\NylasV3\EmailCalendar\Model\Error1, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendRsvpWithHttpInfo(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest $send_rsvp_request = null,
        string $contentType = self::contentTypes['sendRsvp'][0]
    ): array {
        $request = $this->sendRsvpRequest($calendar_id, $grant_id, $event_id, $send_rsvp_request, $contentType);

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
                    if (in_array('\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response', []),
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

            $returnType = '\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response';
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
                        '\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response',
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
     * Operation sendRsvpAsync
     *
     * Send RSVP
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest|null $send_rsvp_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendRsvp'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function sendRsvpAsync(
        string $calendar_id,
        string $grant_id,
        string $event_id,
        ?\JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest $send_rsvp_request = null,
        string $contentType = self::contentTypes['sendRsvp'][0]
    ): PromiseInterface {
        return $this->sendRsvpAsyncWithHttpInfo($calendar_id, $grant_id, $event_id, $send_rsvp_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendRsvpAsyncWithHttpInfo
     *
     * Send RSVP
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest|null $send_rsvp_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendRsvp'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function sendRsvpAsyncWithHttpInfo(
        $calendar_id,
        $grant_id,
        $event_id,
        $send_rsvp_request = null,
        string $contentType = self::contentTypes['sendRsvp'][0]
    ): PromiseInterface {
        $returnType = '\JackWH\NylasV3\EmailCalendar\Model\SendRsvp200Response';
        $request = $this->sendRsvpRequest($calendar_id, $grant_id, $event_id, $send_rsvp_request, $contentType);

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
     * Create request for operation 'sendRsvp'
     *
     * @param  string $calendar_id Filter for the specified calendar ID.  (Not supported for iCloud) You can use &#x60;primary&#x60; to query the end user&#39;s primary calendar. (required)
     * @param  string $grant_id ID of the grant to access. Use &#x60;/me/&#x60; to refer to the grant associated with an access token. (required)
     * @param  string $event_id ID of the event to access. Nylas recommends you URL-encode this field, or you might receive a [&#x60;404&#x60; error](/docs/api/errors/400-response/) if the ID contains special characters (for example, &#x60;#&#x60;). (required)
     * @param  \JackWH\NylasV3\EmailCalendar\Model\SendRsvpRequest|null $send_rsvp_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendRsvp'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function sendRsvpRequest(
        $calendar_id,
        $grant_id,
        $event_id,
        $send_rsvp_request = null,
        string $contentType = self::contentTypes['sendRsvp'][0]
    ): Request {

        // verify the required parameter 'calendar_id' is set
        if ($calendar_id === null || (is_array($calendar_id) && count($calendar_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $calendar_id when calling sendRsvp'
            );
        }

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling sendRsvp'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling sendRsvp'
            );
        }



        $resourcePath = '/v3/grants/{grant_id}/events/{event_id}/send-rsvp';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $calendar_id,
            'calendar_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
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
        if ($event_id !== null) {
            $resourcePath = str_replace(
                '{' . 'event_id' . '}',
                ObjectSerializer::toPathValue($event_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($send_rsvp_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($send_rsvp_request));
            } else {
                $httpBody = $send_rsvp_request;
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
