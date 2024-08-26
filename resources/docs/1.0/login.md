# User Login API

## Endpoint

`POST /api/login`

## Description

This endpoint is used to authenticate a user in the application. The user must provide their email and password. Upon successful authentication, the API will return a success message along with an access token, which should be used as a Bearer token in the Authorization header for all subsequent requests.

## Request

### Method

`POST`

### URL

`/api/login`

### Headers

| Key           | Value            |
|---------------|------------------|
| Content-Type  | application/json |

### Request Body

The following JSON structure should be sent in the request body:

```json
{
    "email": "string",
    "password": "string"
}
