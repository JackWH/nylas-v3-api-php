<?php
/**
 * V3GrantsGrantIdEventsEventIdApi
 * PHP version 8.1
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * v3 Nylas Email and Calendar APIs
 *
 * This API reference covers the **Nylas Email and Calendar APIs**. See the see the [<b>Administration API documentation</b>](https:///docs/api/v3-beta/admin/) for information about working with Nylas applications, authentication, connectors, and webhook subscriptions.  The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like GET, PUT, POST, and DELETE and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.  # Pagination  Some queries result in multiple pages of data. Nylas includes a `next_cursor` response body field when there are more pages of results. To get the next page, pass the value of this header as the `page_token` query parameter on your next request.  You can use the `limit` query parameter to specify the maximum number of results you want in the page. A page might have less than `limit` results, but that doesn't mean that it's the last page. Use the presences of the `next_cursor` response body field to determine if there are additional pages.  | Query Parameter | Type | Description | | --- | --- | --- | | `limit` | integer | The number of objects to return. This defaults to 50 and has a maximum of 200. | | `page_token` | string | An identifier that specifies which page of data to return. This value should be taken from the `next_cursor` response body field. |  # /me/ syntax for API calls  The Nylas API v3 Beta includes new `/me/` syntax that you can use in access-token authorized API calls, instead of specifying a user's Grant ID (for example, `GET /v3/grants/me/messages`).  The `/me/` syntax looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  For more information, see the [API v3 Beta features and changes documentation](https:///docs/v3-beta/features-and-changes/#changing-account_id-to-grant_id).  # Metadata  You can add key-value pairs to certain objects to store data against them. You can currently create, read, update, and delete metadata on Calendars and Events. Metadata is coming soon for message drafts and messages.  The `metadata` object is made of a list of key-value pairs. Keys and values can be any string.  Nylas also reserves five specific keys that you can include in the JSON payload of a query to filter the returned objects.  ## Metadata keys and filtering  Nylas reserves five metadata keys (`key1`, `key2`, `key3`, `key4`, `key5`) and indexes their contents. If you add metadata values to these keys, you can then add a metadata filter to a query so that only items with matching metadata are returned. You can also add these filters as URI parameters to a query, as in the examples below.  - `https://api.nylas.com/calendar?metadata_pair=key1:value` - `https://api.nylas.com/events?calendar_id=CALENDAR_ID&metadata_pair=key1:value`  You cannot create a query that contains **both** a provider and metadata filter. Filters like the example below return an error message.  - `https://api.nylas.com/calendar?metadata_pair=key1:value&title=Birthday`\"  You do not need to include an `event_id` when filtering with `metadata_filters`. What's this about? It seems a random  ## Example: Add metadata  The following example cURL request adds metadata to a Calendar. You can add metadata to Calendars and Events using a `POST` request with a `--data-raw` object for both.  In the example below, we add `key1`, which is one of the Nylas-indexed keys that you can use for filtering.  ``` bash curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\ --header 'Content-Type: application/json' \\ --data-raw '{     \"name\" : \"Name of a calendar with metadata\",     \"metadata\":{         \"key1\": \"value to filter on\"     } }'   ```  The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  ## Example: Query metadata  You can query the metadata you added by including a JSON object like the example below to a query that would return metadata-enabled objects. At this time calendars and events support metadata.  ``` json \"metadata\": {     \"key1\": \"value\" }   ```  ### Example: Update and delete metadata  The example cURL command below creates a new Calendar that includes metadata.  ``` bash curl --location --request POST 'https://api.us.nylas.com/v3/grants/me/calendars' \\ --data-raw '{     \"metadata\": {         \"key1\": \"Initial metadata value\"     } }'   ```  The example below updates the calendar `metadata` using a `PUT` command.  **Note**: The `PUT` command overwrites the entire `metadata` object. (The `PATCH` command behaves in the same way, and overwrites the entire `metadata` object.)  ``` bash curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\ --data-raw '{     \"metadata\": {         \"key1\": \"This key has been updated\",         \"key2\": \"Added this new key\"     } }'   ```  The `/me/` syntax in this example looks up the Grant associated with the request's access token, and uses the `grant_id` associated with the token as a locator. You can use this syntax for API requests that access account data only, and only if you use access tokens to authorize requests. You can't use this syntax if you're using API key authorization, because there is no Grant associated with an API key.  The response will be similar to the following example. Is this Nylas' response confirming the change? Or is this the response if you query for that metadata later?  ``` json \"metadata\": {     \"key1\": \"This key has been updated\",     \"key2\": \"Added this new key\" }   ```  If you update the above example with the `PUT` call below that does _not_ include both metadata keys, Nylas deletes `key2` from the `metadata` object.  ``` bash curl --location --request PUT &#x27;https://api.us.nylas.com/v3/grants/me/calendars/<CALENDAR_ID>&#x27; \\ --data-raw '{     \"metadata\": {         \"key1\": \"New Value\"     } }'   ```  The response will then be similar to the example below. Same question re: what kind of response.  ``` json \"metadata\": {     \"key1\": \"New Value\" }   ```
 *
 * The version of the OpenAPI document: 1.0.0
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.8.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace JackWH\NylasV3\EmailCalendar\Api;

use InvalidArgumentException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Promise\PromiseInterface;
use JackWH\NylasV3\EmailCalendar\ApiException;
use JackWH\NylasV3\EmailCalendar\Configuration;
use JackWH\NylasV3\EmailCalendar\HeaderSelector;
use JackWH\NylasV3\EmailCalendar\ObjectSerializer;

/**
 * V3GrantsGrantIdEventsEventIdApi Class Doc Comment
 *
 * @package  JackWH\NylasV3\EmailCalendar
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class V3GrantsGrantIdEventsEventIdApi
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

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'v3GrantsGrantIdEventsEventIdDelete' => [
            'application/json',
        ],
        'v3GrantsGrantIdEventsEventIdGet' => [
            'application/json',
        ],
        'v3GrantsGrantIdEventsEventIdPut' => [
            'application/json',
        ],
        'v3GrantsGrantIdEventsEventIdSendRsvpPost' => [
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
     * Operation v3GrantsGrantIdEventsEventIdDelete
     *
     * Delete an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return object|object|object
     */
    public function v3GrantsGrantIdEventsEventIdDelete(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'][0]
    ): object
    {
        list($response) = $this->v3GrantsGrantIdEventsEventIdDeleteWithHttpInfo($grant_id, $event_id, $accept, $notify_participants, $calendar_id, $contentType);
        return $response;
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdDeleteWithHttpInfo
     *
     * Delete an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of object|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function v3GrantsGrantIdEventsEventIdDeleteWithHttpInfo(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'][0]
    ): array
    {
        $request = $this->v3GrantsGrantIdEventsEventIdDeleteRequest($grant_id, $event_id, $accept, $notify_participants, $calendar_id, $contentType);

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

            switch($statusCode) {
                case 200:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
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
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdDeleteAsync
     *
     * Delete an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdDeleteAsync(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'][0]
    ): PromiseInterface
    {
        return $this->v3GrantsGrantIdEventsEventIdDeleteAsyncWithHttpInfo($grant_id, $event_id, $accept, $notify_participants, $calendar_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdDeleteAsyncWithHttpInfo
     *
     * Delete an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdDeleteAsyncWithHttpInfo(
        $grant_id,
        $event_id,
        $accept = null,
        $notify_participants = null,
        $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'][0]
    ): PromiseInterface
    {
        $returnType = 'object';
        $request = $this->v3GrantsGrantIdEventsEventIdDeleteRequest($grant_id, $event_id, $accept, $notify_participants, $calendar_id, $contentType);

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
                        $response->getHeaders()
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
     * Create request for operation 'v3GrantsGrantIdEventsEventIdDelete'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function v3GrantsGrantIdEventsEventIdDeleteRequest(
        $grant_id,
        $event_id,
        $accept = null,
        $notify_participants = null,
        $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdDelete'][0]
    ): Request
    {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling v3GrantsGrantIdEventsEventIdDelete'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling v3GrantsGrantIdEventsEventIdDelete'
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
            false // required
        ) ?? []);

        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

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
                            'contents' => $formParamValueItem
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

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
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
     * Operation v3GrantsGrantIdEventsEventIdGet
     *
     * Return an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdGet'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return object|object|object
     */
    public function v3GrantsGrantIdEventsEventIdGet(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdGet'][0]
    ): object
    {
        list($response) = $this->v3GrantsGrantIdEventsEventIdGetWithHttpInfo($grant_id, $event_id, $accept, $calendar_id, $contentType);
        return $response;
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdGetWithHttpInfo
     *
     * Return an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdGet'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of object|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function v3GrantsGrantIdEventsEventIdGetWithHttpInfo(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdGet'][0]
    ): array
    {
        $request = $this->v3GrantsGrantIdEventsEventIdGetRequest($grant_id, $event_id, $accept, $calendar_id, $contentType);

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

            switch($statusCode) {
                case 200:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
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
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdGetAsync
     *
     * Return an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdGet'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdGetAsync(
        string $grant_id,
        string $event_id,
        ?string $accept = null,
        ?string $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdGet'][0]
    ): PromiseInterface
    {
        return $this->v3GrantsGrantIdEventsEventIdGetAsyncWithHttpInfo($grant_id, $event_id, $accept, $calendar_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdGetAsyncWithHttpInfo
     *
     * Return an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdGet'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdGetAsyncWithHttpInfo(
        $grant_id,
        $event_id,
        $accept = null,
        $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdGet'][0]
    ): PromiseInterface
    {
        $returnType = 'object';
        $request = $this->v3GrantsGrantIdEventsEventIdGetRequest($grant_id, $event_id, $accept, $calendar_id, $contentType);

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
                        $response->getHeaders()
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
     * Create request for operation 'v3GrantsGrantIdEventsEventIdGet'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdGet'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function v3GrantsGrantIdEventsEventIdGetRequest(
        $grant_id,
        $event_id,
        $accept = null,
        $calendar_id = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdGet'][0]
    ): Request
    {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling v3GrantsGrantIdEventsEventIdGet'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling v3GrantsGrantIdEventsEventIdGet'
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
            false // required
        ) ?? []);

        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

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
                            'contents' => $formParamValueItem
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

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
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
     * Operation v3GrantsGrantIdEventsEventIdPut
     *
     * Update an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $content_type content_type (optional)
     * @param  string|null $accept accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdPut'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return object|object|object
     */
    public function v3GrantsGrantIdEventsEventIdPut(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdPut'][0]
    ): object
    {
        list($response) = $this->v3GrantsGrantIdEventsEventIdPutWithHttpInfo($grant_id, $event_id, $content_type, $accept, $notify_participants, $calendar_id, $body, $contentType);
        return $response;
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdPutWithHttpInfo
     *
     * Update an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdPut'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of object|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function v3GrantsGrantIdEventsEventIdPutWithHttpInfo(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdPut'][0]
    ): array
    {
        $request = $this->v3GrantsGrantIdEventsEventIdPutRequest($grant_id, $event_id, $content_type, $accept, $notify_participants, $calendar_id, $body, $contentType);

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

            switch($statusCode) {
                case 200:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
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
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdPutAsync
     *
     * Update an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdPut'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdPutAsync(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?bool $notify_participants = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdPut'][0]
    ): PromiseInterface
    {
        return $this->v3GrantsGrantIdEventsEventIdPutAsyncWithHttpInfo($grant_id, $event_id, $content_type, $accept, $notify_participants, $calendar_id, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdPutAsyncWithHttpInfo
     *
     * Update an Event
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdPut'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdPutAsyncWithHttpInfo(
        $grant_id,
        $event_id,
        $content_type = null,
        $accept = null,
        $notify_participants = null,
        $calendar_id = null,
        $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdPut'][0]
    ): PromiseInterface
    {
        $returnType = 'object';
        $request = $this->v3GrantsGrantIdEventsEventIdPutRequest($grant_id, $event_id, $content_type, $accept, $notify_participants, $calendar_id, $body, $contentType);

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
                        $response->getHeaders()
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
     * Create request for operation 'v3GrantsGrantIdEventsEventIdPut'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event to act upon. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  bool|null $notify_participants Defaults to &#x60;true&#x60;, email notifications containing the calendar event is sent to all event participants. Microsoft accounts do not support notify_participants &#x3D; False. (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdPut'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function v3GrantsGrantIdEventsEventIdPutRequest(
        $grant_id,
        $event_id,
        $content_type = null,
        $accept = null,
        $notify_participants = null,
        $calendar_id = null,
        $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdPut'][0]
    ): Request
    {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling v3GrantsGrantIdEventsEventIdPut'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling v3GrantsGrantIdEventsEventIdPut'
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
            false // required
        ) ?? []);

        // header params
        if ($content_type !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($content_type);
        }
        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

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
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
            } else {
                $httpBody = $body;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
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

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
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
     * Operation v3GrantsGrantIdEventsEventIdSendRsvpPost
     *
     * Send RSVP
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event. (required)
     * @param  string|null $content_type content_type (optional)
     * @param  string|null $accept accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return object|object|object
     */
    public function v3GrantsGrantIdEventsEventIdSendRsvpPost(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'][0]
    ): object
    {
        list($response) = $this->v3GrantsGrantIdEventsEventIdSendRsvpPostWithHttpInfo($grant_id, $event_id, $content_type, $accept, $calendar_id, $body, $contentType);
        return $response;
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdSendRsvpPostWithHttpInfo
     *
     * Send RSVP
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array of object|object|object, HTTP status code, HTTP response headers (array of strings)
     */
    public function v3GrantsGrantIdEventsEventIdSendRsvpPostWithHttpInfo(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'][0]
    ): array
    {
        $request = $this->v3GrantsGrantIdEventsEventIdSendRsvpPostRequest($grant_id, $event_id, $content_type, $accept, $calendar_id, $body, $contentType);

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

            switch($statusCode) {
                case 200:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if (in_array('object', ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('object' !== 'string') {
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
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
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
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdSendRsvpPostAsync
     *
     * Send RSVP
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdSendRsvpPostAsync(
        string $grant_id,
        string $event_id,
        ?string $content_type = null,
        ?string $accept = null,
        ?string $calendar_id = null,
        ?array $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'][0]
    ): PromiseInterface
    {
        return $this->v3GrantsGrantIdEventsEventIdSendRsvpPostAsyncWithHttpInfo($grant_id, $event_id, $content_type, $accept, $calendar_id, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation v3GrantsGrantIdEventsEventIdSendRsvpPostAsyncWithHttpInfo
     *
     * Send RSVP
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function v3GrantsGrantIdEventsEventIdSendRsvpPostAsyncWithHttpInfo(
        $grant_id,
        $event_id,
        $content_type = null,
        $accept = null,
        $calendar_id = null,
        $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'][0]
    ): PromiseInterface
    {
        $returnType = 'object';
        $request = $this->v3GrantsGrantIdEventsEventIdSendRsvpPostRequest($grant_id, $event_id, $content_type, $accept, $calendar_id, $body, $contentType);

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
                        $response->getHeaders()
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
     * Create request for operation 'v3GrantsGrantIdEventsEventIdSendRsvpPost'
     *
     * @param  string $grant_id (Required) ID of the grant to act upon. Use \&quot;me\&quot; to refer to the grant associated with an access token. (required)
     * @param  string $event_id (Required) ID of the event. (required)
     * @param  string|null $content_type (optional)
     * @param  string|null $accept (optional)
     * @param  string|null $calendar_id (Required) Specify calendar ID of the event.  \&quot;primary\&quot; is a supported value indicating the user&#39;s primary calendar. (optional)
     * @param  object|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function v3GrantsGrantIdEventsEventIdSendRsvpPostRequest(
        $grant_id,
        $event_id,
        $content_type = null,
        $accept = null,
        $calendar_id = null,
        $body = null,
        string $contentType = self::contentTypes['v3GrantsGrantIdEventsEventIdSendRsvpPost'][0]
    ): Request
    {

        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $grant_id when calling v3GrantsGrantIdEventsEventIdSendRsvpPost'
            );
        }

        // verify the required parameter 'event_id' is set
        if ($event_id === null || (is_array($event_id) && count($event_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $event_id when calling v3GrantsGrantIdEventsEventIdSendRsvpPost'
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
            false // required
        ) ?? []);

        // header params
        if ($content_type !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($content_type);
        }
        // header params
        if ($accept !== null) {
            $headerParams['Accept'] = ObjectSerializer::toHeaderValue($accept);
        }

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
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
            } else {
                $httpBody = $body;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
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

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
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
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
