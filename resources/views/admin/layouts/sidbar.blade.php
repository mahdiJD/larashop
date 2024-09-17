<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-title">
            <img src="{{asset('assets/images/user-default.png')}}" width="26px" height="26px" alt="">
            hello mahdi
        </div>
        <ul class="sidebar-menu">
            <li class="@if ($page =='dashboard')
                active
            @endif"><a href="#dashboard" class="">Dashboard</a></li>
            <li class="@if ($page =='user')
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