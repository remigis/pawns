# User Registration API

## Endpoint

`POST /api/register`

## Description

This endpoint is used to register a new user in the application. The user needs to provide their name, email, and password to create an account. Upon successful registration, the API will return a success message along with the user's details.

## Request

### Method

`POST`

### URL

`/api/register`

### Headers

| Key           | Value            |
|---------------|------------------|
| Content-Type  | application/json |

### Request Body

The following JSON structure should be sent in the request body:

```json
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}
