@extends('web.layout')

@section('title')
    Verify Email
@endsection

@section('main')

    <div class="alert alert-success">
        Verification mail sent successfully, Please check your inbox
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <form method="POST" action="{{url('email/verification-notification')}}">
                        @csrf
                        <button type="submit" class="main-button icon-button pull-right">Resend Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection