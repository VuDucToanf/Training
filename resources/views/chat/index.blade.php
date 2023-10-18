@extends('layouts.contentNavbarLayout')
@section('script')
    <script src="https://cdn.socket.io/socket.io-2.1.0.js"></script>
    <script src="{{ asset('assets/js/controllers/chat-controller.js') }}"></script>
@endsection
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/chat.css') }}">
@endsection
@section('content')
    <div class="content-wrapper" ng-controller="ChatController">
        <div class="row">
            <div class="col mb-3">
                <label for="idBasic" class="form-label">User Id</label>
                <input
                    type="text"
                    id="idBasic"
                    class="form-control"
                    placeholder="Enter user"
                    ng-model="defaultValue.id"
                    ng-readonly="user.id"
                    autofocus>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="groupIdBasic" class="form-label">Group Id</label>
                <input type="number" id="groupIdBasic" class="form-control" placeholder="Enter user group id"
                       ng-model="defaultValue.group_id" ng-readonly="user.group_id">
            </div>
        </div>
        <a
            ng-if="defaultValue.show_join"
            href="javascript:void(0);"
            type="submit" id="form-submit"
            class="btn btn-primary w-25 mb-3"
            ng-click="joinGroup()">
            Join group
        </a>
        <div
            class="card container-p-x"
            ng-if="user.id && user.group_id">
            <label for="message" class="h4" style="margin-top: 20px;">Message:</label>
            <ul id="messages" style="height: 600px; border: solid 1px #cecece; list-style-type: none; padding-left: 5px;">
                <li ng-repeat="item in messages[user.group_id]">
                    <div class="d-flex justify-center">
                        <div class="bold">@{{ item.user_id }}</div>
                        <div>&nbsp;(at @{{ item.created_time | date:'yyyy-MM-dd HH:mm:ss' }}):</div>
                        <div>&nbsp; - &nbsp;@{{ item.content }}</div>
                    </div>
                </li>
            </ul>
            <div class="form-group">
                <textarea id="m" class="form-control" rows="5" placeholder="Enter your message" required ng-model="defaultValue.content"></textarea>
            </div>
            <button
                type="submit" id="form-submit"
                class="btn btn-success btn-lg pull-right mt-2 mb-3"
                ng-click="sendMessage()">
                Submit
            </button>
        </div>
    </div>
@endsection
