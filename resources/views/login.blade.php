<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login Page</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('/css/loginStyle.css')}}"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                            </div>
                        @endif
                    <div class="login_section">
                          <div class="breadcrumb">
                            <form class="block" method="POST" action="{{route('login.post')}}" autocomplete="on">
                                @csrf
                                <div class="h3 text-center ">Log In</div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                  @if ($errors->has('email'))
                                  <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                          </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
