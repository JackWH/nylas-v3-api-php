# OpenAPIClient-php

**This API reference covers the **Administration APIs** only.
See the [<b>Email and Calendar API reference</b>](https:///docs/api/v3-beta/ecc/) for information on working with Email and Calendar APIs.

The **Nylas Administration APIs** are how you query and change your Nylas applications, including the application's authentication configuration, provider settings, and webhook subscriptions. You can also use Administration APIs to query your application to list the Grants (specific permissions to access user data) that are associated with each of your Nylas applications.

The Nylas API is designed using the [REST](http://en.wikipedia.org/wiki/Representational_State_Transfer) ideology to provide simple and predictable URIs to access and modify objects. Requests support [standard HTTP methods](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) like GET, PUT, POST, and DELETE and [standard status codes](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html). Response bodies are always UTF-8 encoded JSON objects, unless explicitly documented otherwise.

## Nylas authentication in v3

You can find more information about the Nylas Administration APIs in the main documentation set:

- [Authentication in v3](https:///docs/developer-guide/v3-authentication/)
    - [Create Grants with OAuth authentication + API key](https:///docs/developer-guide/v3-authentication/hosted-oauth-apikey/)
    - [Create Grants with OAuth authentication + Access token](https:///docs/developer-guide/v3-authentication/hosted-oauth-accesstoken/)
    - [Create Grants with custom authentication](https:///docs/developer-guide/v3-authentication/custom/) (called \"native\" authentication in v2)
    - [Create Grants with IMAP authentication](https:///docs/developer-guide/v3-authentication/imap/)
- [Bulk authentication in v3](https:///docs/developer-guide/v3-authentication/bulk-auth-grants/)
- [v3 event codes](https:///docs/v3-beta/event-codes/)
- [Virtual Calendars in v3](https:///docs/developer-guide/v3-authentication/virtual-calendars/)


## Installation & Usage

### Requirements

PHP 8.1 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure Bearer authorization: bearerAuth
$config = JackWH\NylasV3\Administration\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new JackWH\NylasV3\Administration\Api\V3Api(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$accept = application/json; // string
$email = {{email}}; // string | (Required) Email for detection
$all_provider_types = false; // bool | Search by all providers regardless of if they have an existing connector

try {
    $result = $apiInstance->v3ProvidersDetectPost($accept, $email, $all_provider_types);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling V3Api->v3ProvidersDetectPost: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*V3Api* | [**v3ProvidersDetectPost**](docs/Api/V3Api.md#v3providersdetectpost) | **POST** /v3/providers/detect | Detect provider
*V3ApplicationsApi* | [**v3ApplicationsGet**](docs/Api/V3ApplicationsApi.md#v3applicationsget) | **GET** /v3/applications | Get application
*V3ApplicationsApi* | [**v3ApplicationsPatch**](docs/Api/V3ApplicationsApi.md#v3applicationspatch) | **PATCH** /v3/applications | Update application
*V3ApplicationsRedirectUrisApi* | [**v3ApplicationsRedirectUrisGet**](docs/Api/V3ApplicationsRedirectUrisApi.md#v3applicationsredirecturisget) | **GET** /v3/applications/redirect-uris | Get an application&#39;s callback URIs
*V3ApplicationsRedirectUrisApi* | [**v3ApplicationsRedirectUrisPost**](docs/Api/V3ApplicationsRedirectUrisApi.md#v3applicationsredirecturispost) | **POST** /v3/applications/redirect-uris | Add callback URI to application
*V3ApplicationsRedirectUrisIdApi* | [**v3ApplicationsRedirectUrisCallbackIdDelete**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#v3applicationsredirecturiscallbackiddelete) | **DELETE** /v3/applications/redirect-uris/{callback_id} | Delete a callback URI
*V3ApplicationsRedirectUrisIdApi* | [**v3ApplicationsRedirectUrisCallbackIdGet**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#v3applicationsredirecturiscallbackidget) | **GET** /v3/applications/redirect-uris/{callback_id} | Get callback URI
*V3ApplicationsRedirectUrisIdApi* | [**v3ApplicationsRedirectUrisCallbackIdPatch**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#v3applicationsredirecturiscallbackidpatch) | **PATCH** /v3/applications/redirect-uris/{callback_id} | Update a callback URI
*V3ChannelsPubsubApi* | [**v3ChannelsPubsubGet**](docs/Api/V3ChannelsPubsubApi.md#v3channelspubsubget) | **GET** /v3/channels/pubsub | Get PubSub channels for an application
*V3ChannelsPubsubApi* | [**v3ChannelsPubsubPost**](docs/Api/V3ChannelsPubsubApi.md#v3channelspubsubpost) | **POST** /v3/channels/pubsub | Create a PubSub channel
*V3ChannelsPubsubIdApi* | [**v3ChannelsPubsubIdDelete**](docs/Api/V3ChannelsPubsubIdApi.md#v3channelspubsubiddelete) | **DELETE** /v3/channels/pubsub/{id} | Delete a specific PubSub channel
*V3ChannelsPubsubIdApi* | [**v3ChannelsPubsubIdGet**](docs/Api/V3ChannelsPubsubIdApi.md#v3channelspubsubidget) | **GET** /v3/channels/pubsub/{id} | Get a specific PubSub channel by id
*V3ChannelsPubsubIdApi* | [**v3ChannelsPubsubIdPut**](docs/Api/V3ChannelsPubsubIdApi.md#v3channelspubsubidput) | **PUT** /v3/channels/pubsub/{id} | Update a specific PubSub channel
*V3ConnectApi* | [**v3ConnectAuthGet**](docs/Api/V3ConnectApi.md#v3connectauthget) | **GET** /v3/connect/auth | Hosted OAuth - Authorization Request
*V3ConnectApi* | [**v3ConnectCustomPost**](docs/Api/V3ConnectApi.md#v3connectcustompost) | **POST** /v3/connect/custom | Custom Authentication
*V3ConnectApi* | [**v3ConnectRevokePost**](docs/Api/V3ConnectApi.md#v3connectrevokepost) | **POST** /v3/connect/revoke | Hosted OAuth - Revoke OAuth token
*V3ConnectApi* | [**v3ConnectTokenPost**](docs/Api/V3ConnectApi.md#v3connecttokenpost) | **POST** /v3/connect/token | Hosted OAuth - Token exchange
*V3ConnectApi* | [**v3ConnectTokeninfoGet**](docs/Api/V3ConnectApi.md#v3connecttokeninfoget) | **GET** /v3/connect/tokeninfo | Token Info
*V3ConnectorsApi* | [**v3ConnectorsGet**](docs/Api/V3ConnectorsApi.md#v3connectorsget) | **GET** /v3/connectors | List connectors
*V3ConnectorsApi* | [**v3ConnectorsPost**](docs/Api/V3ConnectorsApi.md#v3connectorspost) | **POST** /v3/connectors | Create a connector
*V3ConnectorsProviderApi* | [**v3ConnectorsProviderGet**](docs/Api/V3ConnectorsProviderApi.md#v3connectorsproviderget) | **GET** /v3/connectors/{provider} | List connectors
*V3ConnectorsProviderApi* | [**v3ConnectorsProviderPost**](docs/Api/V3ConnectorsProviderApi.md#v3connectorsproviderpost) | **POST** /v3/connectors/{provider} | Create a connector
*V3ConnectorsProviderCredsApi* | [**v3ConnectorsProviderCredsGet**](docs/Api/V3ConnectorsProviderCredsApi.md#v3connectorsprovidercredsget) | **GET** /v3/connectors/{provider}/creds | List credentials
*V3ConnectorsProviderCredsApi* | [**v3ConnectorsProviderCredsPost**](docs/Api/V3ConnectorsProviderCredsApi.md#v3connectorsprovidercredspost) | **POST** /v3/connectors/{provider}/creds | Create credential
*V3ConnectorsProviderCredsIdApi* | [**v3ConnectorsProviderCredsIdDelete**](docs/Api/V3ConnectorsProviderCredsIdApi.md#v3connectorsprovidercredsiddelete) | **DELETE** /v3/connectors/{provider}/creds/{id} | Delete credential by ID
*V3ConnectorsProviderCredsIdApi* | [**v3ConnectorsProviderCredsIdGet**](docs/Api/V3ConnectorsProviderCredsIdApi.md#v3connectorsprovidercredsidget) | **GET** /v3/connectors/{provider}/creds/{id} | Get credential by ID
*V3ConnectorsProviderCredsIdApi* | [**v3ConnectorsProviderCredsIdPatch**](docs/Api/V3ConnectorsProviderCredsIdApi.md#v3connectorsprovidercredsidpatch) | **PATCH** /v3/connectors/{provider}/creds/{id} | Update credential by ID
*V3GrantsApi* | [**v3GrantsGet**](docs/Api/V3GrantsApi.md#v3grantsget) | **GET** /v3/grants | List grants
*V3GrantsApi* | [**v3GrantsMeGet**](docs/Api/V3GrantsApi.md#v3grantsmeget) | **GET** /v3/grants/me | Get current grant
*V3GrantsGrantIdApi* | [**v3GrantsGrantIdDelete**](docs/Api/V3GrantsGrantIdApi.md#v3grantsgrantiddelete) | **DELETE** /v3/grants/{grantId} | Delete grant
*V3GrantsGrantIdApi* | [**v3GrantsGrantIdGet**](docs/Api/V3GrantsGrantIdApi.md#v3grantsgrantidget) | **GET** /v3/grants/{grantId} | Get a grant
*V3GrantsGrantIdApi* | [**v3GrantsGrantIdPatch**](docs/Api/V3GrantsGrantIdApi.md#v3grantsgrantidpatch) | **PATCH** /v3/grants/{grantId} | Update grant
*V3WebhooksApi* | [**v3WebhooksGet**](docs/Api/V3WebhooksApi.md#v3webhooksget) | **GET** /v3/webhooks | Get destinations for an application
*V3WebhooksApi* | [**v3WebhooksMockPayloadPost**](docs/Api/V3WebhooksApi.md#v3webhooksmockpayloadpost) | **POST** /v3/webhooks/mock-payload | Get mock webhook payload
*V3WebhooksApi* | [**v3WebhooksPost**](docs/Api/V3WebhooksApi.md#v3webhookspost) | **POST** /v3/webhooks | Create a webhook destination
*V3WebhooksApi* | [**v3WebhooksRotateSecretIdPost**](docs/Api/V3WebhooksApi.md#v3webhooksrotatesecretidpost) | **POST** /v3/webhooks/rotate-secret/{id} | Rotate a webhook secret
*V3WebhooksApi* | [**v3WebhooksSendTestEventPost**](docs/Api/V3WebhooksApi.md#v3webhookssendtesteventpost) | **POST** /v3/webhooks/send-test-event | Send test event
*V3WebhooksIdApi* | [**v3WebhooksIdDelete**](docs/Api/V3WebhooksIdApi.md#v3webhooksiddelete) | **DELETE** /v3/webhooks/{id} | Delete a webhook destination
*V3WebhooksIdApi* | [**v3WebhooksIdGet**](docs/Api/V3WebhooksIdApi.md#v3webhooksidget) | **GET** /v3/webhooks/{id} | Get the destinations for an application by webhook ID
*V3WebhooksIdApi* | [**v3WebhooksIdPut**](docs/Api/V3WebhooksIdApi.md#v3webhooksidput) | **PUT** /v3/webhooks/{id} | Update a webhook destination

## Models


## Authorization

### bearerAuth

- **Type**: Bearer authentication


### oauth2Auth

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Generator version: `7.8.0`
- Build package: `org.openapitools.codegen.languages.PhpNextgenClientCodegen`
