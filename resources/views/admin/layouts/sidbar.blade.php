<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/style.css">
    
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-title">
            <img src="assets/images/user-default.png" width="16px" height="16px" alt="">
            hello mahdi
        </div>
        <ul class="sidebar-menu">
            <li class="@if ($page =='dashboard')
                active
            @endif"><a href="#dashboard" class="">Dashboard</a></li>
            <li class="@if ($page =='users')
                active
            @endif"><a href="#users" class="">Users</a></li>
            <li class="@if ($page =='settings')
                active
            @endif"><a href="#settings" class="">Settings</a></li>
            <li class="@if ($page =='Pages')
                active
            @endif"><a href="#pages" >Pages</a></li>
            <li class="@if ($page =='Posts')
                active
            @endif"><a href="#posts" class="">Posts</a></li>
            <li class="@if ($page =='product')
                active
            @endif"><a href="#media" class="">product</a></li>
            <li class="@if ($page =='order')
                active
            @endif"><a href="#media" class="">order</a></li>
            <li class="@if ($page =='Logout')
                active
            @endif"><a href="#logout" class="">Logout</a></li>
        </ul>
    </div>