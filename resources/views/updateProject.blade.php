<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update Project</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('/css/project.css')}}"/>
    </head>
    <body>
        <div id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                                <div><h5><a  style="color: #bd2130" href="{{route('dashboard')}}">Task Management System</a></h5></div>
                                <div>
                                <a class="btn btn-danger text-white" href="{{route('logout')}}">Logout</a>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">
                  {{-- Role Table --}}
                  <div class="row d-flex justify-content-center mt-5">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <h5 class="text-center">Project Update</h5>
                            </div>
                            <div class="card-body">
                                <form class="block" method="POST" action="{{route('update.project')}}" autocomplete="on">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                    @if (auth()->user()->role_id == 2)
                                        <div class="form-group">
                                            <label for="developer">Developer</label>
                                            <select class="form-control" id="developer" name="developer_id"> 
                                            <option value="">Select</option>
                                            @if ($developers)
                                                @foreach ($developers as $item)
                                                    <option value="{{$item->id}}">{{ ucfirst($item->name) }}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                            @if ($errors->has('developer_id'))
                                            <span class="text-danger">{{ $errors->first('developer_id') }}</span>
                                            @endif
                                        </div>  
                                   @else
                                   <div class="form-group">
                                        <label for="exampleInputPassword1">Last Update</label>
                                        <input type="date" value="{{$project->last_update}}" class="form-control" id="exampleInputPassword1" name="last_update">
                                        @if ($errors->has('last_update'))
                                        <span class="text-danger">{{ $errors->first('last_update') }}</span>
                                        @endif
                                  </div>
                                   <div class="form-group">
                                        <label for="exampleInputPassword1">Completion Percentage</label>
                                        <input type="number" value="{{$project->completion_percentage}}" class="form-control" id="exampleInputPassword1" name="completion_percentage" max="100" min="0">
                                        @if ($errors->has('completion_percentage'))
                                        <span class="text-danger">{{ $errors->first('completion_percentage') }}</span>
                                        @endif
                                  </div>

                                   <div class="form-group">
                                        <label for="exampleInputPassword1">Comment</label>
                                        <textarea class="form-control" name="comment" >{{$project->comment}}</textarea>
                                        @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                        @endif
                                  </div>
                                   @endif
                                   
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                       
                   
        

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
