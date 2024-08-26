# Get Transactions API

## Endpoint

`GET /api/get_transactions`

## Description

This endpoint retrieves a list of transactions for the authenticated user. It provides information on both incoming and outgoing transactions. The user must be authenticated using a Bearer token to access this endpoint.

## Request

### Method

`GET`

### URL

`/api/get_transactions`

### Headers

| Key            | Value               |
|----------------|---------------------|
| Content-Type   | application/json    |
| Authorization  | Bearer {access_token} |

#### Authorization

This endpoint requires a Bearer token obtained during the login process. The token must be included in the `Authorization` header.

## Response

### Success Response

If the request is successful, the API will return the user's transactions in the following JSON structure:

```json
{
    "transactions": {
        "incoming": [
            {
                "id": 1,
                "points": 5,
                "from": null,
                "to": "1",
                "claimed": 0
            }
        ],
        "outgoing": []
    }
}
