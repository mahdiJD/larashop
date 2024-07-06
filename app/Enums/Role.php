<?php
namespace App\Enums;
enum Role:string
{
    case root = 'root';
    case admin = 'admin';
    case user = 'user';
}
