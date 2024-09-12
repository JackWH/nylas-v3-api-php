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
    $result = $apiInstance->detectProvider($accept, $email, $all_provider_types);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling V3Api->detectProvider: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.us.nylas.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*V3Api* | [**detectProvider**](docs/Api/V3Api.md#detectprovider) | **POST** /v3/providers/detect | Detect provider
*V3ApplicationsApi* | [**getApplication**](docs/Api/V3ApplicationsApi.md#getapplication) | **GET** /v3/applications | Get application
*V3ApplicationsApi* | [**updateApplication**](docs/Api/V3ApplicationsApi.md#updateapplication) | **PATCH** /v3/applications | Update application
*V3ApplicationsRedirectUrisApi* | [**addCallbackURIToApplication**](docs/Api/V3ApplicationsRedirectUrisApi.md#addcallbackuritoapplication) | **POST** /v3/applications/redirect-uris | Add callback URI to application
*V3ApplicationsRedirectUrisApi* | [**getAnApplicationsCallbackURIs**](docs/Api/V3ApplicationsRedirectUrisApi.md#getanapplicationscallbackuris) | **GET** /v3/applications/redirect-uris | Get an application&#39;s callback URIs
*V3ApplicationsRedirectUrisIdApi* | [**deleteACallbackURI**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#deleteacallbackuri) | **DELETE** /v3/applications/redirect-uris/{callback_id} | Delete a callback URI
*V3ApplicationsRedirectUrisIdApi* | [**getCallbackURI**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#getcallbackuri) | **GET** /v3/applications/redirect-uris/{callback_id} | Get callback URI
*V3ApplicationsRedirectUrisIdApi* | [**updateACallbackURI**](docs/Api/V3ApplicationsRedirectUrisIdApi.md#updateacallbackuri) | **PATCH** /v3/applications/redirect-uris/{callback_id} | Update a callback URI
*V3ChannelsPubsubApi* | [**createAPubSubChannel**](docs/Api/V3ChannelsPubsubApi.md#createapubsubchannel) | **POST** /v3/channels/pubsub | Create a PubSub channel
*V3ChannelsPubsubApi* | [**getPubSubChannelsForAnApplication**](docs/Api/V3ChannelsPubsubApi.md#getpubsubchannelsforanapplication) | **GET** /v3/channels/pubsub | Get PubSub channels for an application
*V3ChannelsPubsubIdApi* | [**deleteASpecificPubSubChannel**](docs/Api/V3ChannelsPubsubIdApi.md#deleteaspecificpubsubchannel) | **DELETE** /v3/channels/pubsub/{id} | Delete a specific PubSub channel
*V3ChannelsPubsubIdApi* | [**getASpecificPubSubChannelById**](docs/Api/V3ChannelsPubsubIdApi.md#getaspecificpubsubchannelbyid) | **GET** /v3/channels/pubsub/{id} | Get a specific PubSub channel by id
*V3ChannelsPubsubIdApi* | [**updateASpecificPubSubChannel**](docs/Api/V3ChannelsPubsubIdApi.md#updateaspecificpubsubchannel) | **PUT** /v3/channels/pubsub/{id} | Update a specific PubSub channel
*V3ConnectApi* | [**customAuthentication**](docs/Api/V3ConnectApi.md#customauthentication) | **POST** /v3/connect/custom | Custom Authentication
*V3ConnectApi* | [**hostedOAuthAuthorizationRequest**](docs/Api/V3ConnectApi.md#hostedoauthauthorizationrequest) | **GET** /v3/connect/auth | Hosted OAuth - Authorization Request
*V3ConnectApi* | [**hostedOAuthRevokeOAuthToken**](docs/Api/V3ConnectApi.md#hostedoauthrevokeoauthtoken) | **POST** /v3/connect/revoke | Hosted OAuth - Revoke OAuth token
*V3ConnectApi* | [**hostedOAuthTokenExchange**](docs/Api/V3ConnectApi.md#hostedoauthtokenexchange) | **POST** /v3/connect/token | Hosted OAuth - Token exchange
*V3ConnectApi* | [**tokenInfo**](docs/Api/V3ConnectApi.md#tokeninfo) | **GET** /v3/connect/tokeninfo | Token Info
*V3ConnectorsApi* | [**createAConnector**](docs/Api/V3ConnectorsApi.md#createaconnector) | **POST** /v3/connectors | Create a connector
*V3ConnectorsApi* | [**listConnectors**](docs/Api/V3ConnectorsApi.md#listconnectors) | **GET** /v3/connectors | List connectors
*V3ConnectorsProviderApi* | [**createAConnectorForProvider**](docs/Api/V3ConnectorsProviderApi.md#createaconnectorforprovider) | **POST** /v3/connectors/{provider} | Create a connector
*V3ConnectorsProviderApi* | [**listConnectorsByProvider**](docs/Api/V3ConnectorsProviderApi.md#listconnectorsbyprovider) | **GET** /v3/connectors/{provider} | List connectors
*V3ConnectorsProviderCredsApi* | [**createCredential**](docs/Api/V3ConnectorsProviderCredsApi.md#createcredential) | **POST** /v3/connectors/{provider}/creds | Create credential
*V3ConnectorsProviderCredsApi* | [**listCredentials**](docs/Api/V3ConnectorsProviderCredsApi.md#listcredentials) | **GET** /v3/connectors/{provider}/creds | List credentials
*V3ConnectorsProviderCredsIdApi* | [**deleteCredentialByID**](docs/Api/V3ConnectorsProviderCredsIdApi.md#deletecredentialbyid) | **DELETE** /v3/connectors/{provider}/creds/{id} | Delete credential by ID
*V3ConnectorsProviderCredsIdApi* | [**getCredentialByID**](docs/Api/V3ConnectorsProviderCredsIdApi.md#getcredentialbyid) | **GET** /v3/connectors/{provider}/creds/{id} | Get credential by ID
*V3ConnectorsProviderCredsIdApi* | [**updateCredentialByID**](docs/Api/V3ConnectorsProviderCredsIdApi.md#updatecredentialbyid) | **PATCH** /v3/connectors/{provider}/creds/{id} | Update credential by ID
*V3GrantsApi* | [**getCurrentGrant**](docs/Api/V3GrantsApi.md#getcurrentgrant) | **GET** /v3/grants/me | Get current grant
*V3GrantsApi* | [**listGrants**](docs/Api/V3GrantsApi.md#listgrants) | **GET** /v3/grants | List grants
*V3GrantsGrantIdApi* | [**deleteGrant**](docs/Api/V3GrantsGrantIdApi.md#deletegrant) | **DELETE** /v3/grants/{grantId} | Delete grant
*V3GrantsGrantIdApi* | [**getAGrant**](docs/Api/V3GrantsGrantIdApi.md#getagrant) | **GET** /v3/grants/{grantId} | Get a grant
*V3GrantsGrantIdApi* | [**updateGrant**](docs/Api/V3GrantsGrantIdApi.md#updategrant) | **PATCH** /v3/grants/{grantId} | Update grant
*V3WebhooksApi* | [**createAWebhookDestination**](docs/Api/V3WebhooksApi.md#createawebhookdestination) | **POST** /v3/webhooks | Create a webhook destination
*V3WebhooksApi* | [**getDestinationsForAnApplication**](docs/Api/V3WebhooksApi.md#getdestinationsforanapplication) | **GET** /v3/webhooks | Get destinations for an application
*V3WebhooksApi* | [**getMockWebhookPayload**](docs/Api/V3WebhooksApi.md#getmockwebhookpayload) | **POST** /v3/webhooks/mock-payload | Get mock webhook payload
*V3WebhooksApi* | [**rotateAWebhookSecret**](docs/Api/V3WebhooksApi.md#rotateawebhooksecret) | **POST** /v3/webhooks/rotate-secret/{id} | Rotate a webhook secret
*V3WebhooksApi* | [**sendTestEvent**](docs/Api/V3WebhooksApi.md#sendtestevent) | **POST** /v3/webhooks/send-test-event | Send test event
*V3WebhooksIdApi* | [**deleteAWebhookDestination**](docs/Api/V3WebhooksIdApi.md#deleteawebhookdestination) | **DELETE** /v3/webhooks/{id} | Delete a webhook destination
*V3WebhooksIdApi* | [**getTheDestinationsForAnApplicationByWebhookID**](docs/Api/V3WebhooksIdApi.md#getthedestinationsforanapplicationbywebhookid) | **GET** /v3/webhooks/{id} | Get the destinations for an application by webhook ID
*V3WebhooksIdApi* | [**updateAWebhookDestination**](docs/Api/V3WebhooksIdApi.md#updateawebhookdestination) | **PUT** /v3/webhooks/{id} | Update a webhook destination

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
