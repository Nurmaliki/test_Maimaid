<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel Update
                </div>

                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}

              
                <form action="updateprosess" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Full Name</label>
                      <input type="hidden" name="id" class="form-control" value="{{ old('id') ? old('id') : $data_user->id }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name .....">
                      <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname')  ?  old('fullname') : $data_user->fullname}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name .....">
                        @error('fullname') 
                            <small id="emailHelp" class="form-text text-danger">Harus huruf, minimal 3 karakter.</small>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : $data_user->email }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        @error('email') 
                            <small id="emailHelp" class="form-text text-danger">harus format email.</small>
                        @enderror     
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="hidden" name="password_lama" class="form-control" value="{{$data_user->password }}" id="exampleInputPassword1" placeholder="Password">
                      <input type="password" name="password" class="form-control" value="" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="confirm_password" value="{{old('confirm_password') ? old('confirm_password') :  $data_user->password}} " class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Gender</label>
                        <select name="gender" class="form-control  @error('gender') is-invalid @enderror" id="exampleFormControlSelect1">
                          <option  {{old('gender') ? old('gender') == '1' ? 'select' : '' :  $data_user->gender  == '1' ? 'select' : '' }}  value="1"> Pria</option>
                          <option  {{old('gender') ? old('gender') == '2' ? 'select' : '' :  $data_user->gender  == '2' ? 'select' : '' }} value="2"> Wanita</option>
                        </select>
                        @error('gender') 
                            <small id="emailHelp" class="form-text text-danger"> Pilih salah satu  Pria Atau Wanita.</small>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Date of Birth </label>
                        <input type="date" name="dob" value="{{ old('dob') ? date("Y-m-d", strtotime(old('dob'))) : date("Y-m-d", strtotime($data_user->dob))  }}" class="form-control @error('dob') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                        @error('dob') 
                            <small id="emailHelp" class="form-text text-danger"> Tidak Boleh kosong.</small>
                        @enderror 
                    </div>

                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" name="agree" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Agree </label>
                      @error('agree') 
                            <small id="emailHelp" class="form-text text-danger"> harus dicentang jika sebelum button selesai.</small>
                      @enderror 
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
