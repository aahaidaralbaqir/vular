@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Room Chat
                    </h2>
                </div>
                <div class="card-body">
                    <chat-box></chat-box>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        List User
                    </h2>
                </div>
                <div class="card-body">
                    <chat-userlists></chat-userlists>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
