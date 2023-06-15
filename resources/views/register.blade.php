
@extends('layout/layout-common')

@section('space-work')

@if ($errors->any())
@foreach ($errors->all() as $error)

<p style="color:red;">{{ $error }}</p>

@endforeach    
@endif

    <form action="{{ route('studentRegister') }}" method="POST">
    
        @csrf

        <style>

            div.solid{
                border-style: solid;
                color: #0056b3;
                padding: 4%;
            }

            input[type=submit]{
                display: inline-block;
                width: 100%;
                padding: 10px 0px;
                background-color : #0056b3;
                border-radius: 20px;
                text-align: center;
                font-size: 16px;
                color: white;
            }
        </style>

        <section class="form-02-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="_lk_de">
                            <div class="form-03-main">

                                <div class="solid">
                                <div class="text-center">
                                <h2>Register</h2>
                                </div>

                            <div class="form-group">
                            <input type="text" name="name" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan nama">
                            </div>

                            <div class="form-group">
                            <input type="email" name="email" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan email">
                            </div>

                            <div class="form-group">
                            <input type="password" name="password" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan password">
                            </div>
        
                            <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control _ge_de_ol" aria-required="true" placeholder="Confirmasi password">
                            </div>
        
                            <div class="form-group">
                                <div class="">
                                    <input type="submit" class="btn" value="Register">
                                </div>
                              </div>

                              <div class="login-button">
                                <a href="/">Login</a>
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </section>

    </form>
    
    @if (Session::has('success'))

    <p style="color: green;">{{ Session::get('success') }}</p>
        
    @endif

@endsection