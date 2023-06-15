
@extends('layout/layout-common')

@section('space-work')

@if ($errors->any())
@foreach ($errors->all() as $error)

<p style="color:red;">{{ $error }}</p>

@endforeach    
@endif


@if (Session::has('error'))

<p style="color: red;">{{ Session::get('error') }}</p>
    
@endif

    <form action="{{ route('userLogin') }}" method="POST">
    
        @csrf

        <style>
          div.solid {
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
                      <div class="logo">
                        <img src="asset_login/images/user.png">
                      </div>
                      
                      <div class="form-group">
                    <input type="email" name="email" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan email">
                      </div>

                    <div class="form-group">
                    <input type="password" name="password" class="form-control _ge_de_ol" aria-required="true" placeholder="Masukan password">
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                        <input type="submit" class="btn" value="Login">
                        </div>
                    <div class="form-group pt-0">
      </div>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    </form>

@endsection