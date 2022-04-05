<?php

namespace App\Domains\Order\Enums;

enum HttpMethod: string
{
    case CONNECT = 'CONNECT';
    case DELETE = 'DELETE';
    case GET = 'GET';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
    case POST = 'POST';
    case PUT = 'PUT';
    case TRACE = 'TRACE';
}
