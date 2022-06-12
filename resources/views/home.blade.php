@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(auth()->user()->role != "admin")
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('Your Referral Link : ') }}
                    <a class="link-success" href="{{$referral_link}}">{{$referral_link}}</a>

                </div>
            </div>
            @endif
        </div>
        <!-- LIST OF REGISTERED USERS -->
        <div class="col-md-10" style="margin-top:5%">
        
        @if(auth()->user()->role != "admin")
        <span style="margin-right:10px ;margin-bottom: 21px; padding:7px 30px ;background-color:rgb(14 45 75) ;border-radius:25px" class="badge">{{auth()->user()->views}} Views</span>
        <span style="margin-bottom: 21px; padding:7px 30px ;background-color:#3c9440 ;border-radius:25px" class="badge">{{auth()->user()->views}} Registered</span>    
        @endif   
            <div class="card">
                <div class="card-header">{{ __('Your Registered Users') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                @if(auth()->user()->role == "admin")
                                <th scope="col">Registered Date</th>
                                <th scope="col">Registered Users</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registered_users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if(auth()->user()->role == "admin")
                                <td>{{$user->created_at}}</td>
                                @endif
                                @if($user->count =='' && auth()->user()->role == "admin")
                                <td>{{0}}</td>
                                @else <td>{{$user->count}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- END LIST -->
        </div>
    </div>
</div>
@endsection