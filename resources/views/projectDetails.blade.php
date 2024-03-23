<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Project Details</title>

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
                        @if (session('status'))
                        <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                        </div>
                    @endif
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <h5 class="text-center">Project Details Table</h5>
                            </div>
                            <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td scope="col">Name</td>
                                            <td scope="col">{{$project->name}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Manager</td>
                                            <td scope="col">{{$project->manager_id ? App\Models\User::find($project->manager_id)->name : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Developer</td>
                                            <td scope="col">{{$project->developer_id ? App\Models\User::find($project->developer_id)->name : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Status</td>
                                            <td scope="col">{{$project->status == 0 ? 'Ongoing' : 'Completed'}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Last Update</td>
                                            <td scope="col">{{$project->last_update}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Due Date</td>
                                            @php
                                            $today = date("Y-m-d", strtotime("now")) ;
                                            $deadline = date("Y-m-d", strtotime($project->deadline));
                          
                                            $date1=date_create($today);
                                            $date2=date_create($deadline);
                                            $diff=date_diff($date1,$date2);
                                           
                                          @endphp
                                            <td scope="col">{{$diff->format("%R%a days")}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Deadline</td>
                                            <td scope="col">{{$project->deadline}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Completion Percentage</td>
                                            <td scope="col">{{$project->completion_percentage}}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Comment</td>
                                            <td scope="col" style="width: 50%">{{$project->comment}}</td>
                                        </tr>
                                        <tr>
                                            @if (auth()->user()->role_id == 2  || auth()->user()->role_id ==3)
                                                <td colspan="2"><a class="btn btn-info" href="{{url('update/project/'.$project->id)}}">Update</a></td>
                                                @if (auth()->user()->role_id == 2 && $project->completion_percentage == 100)
                                                <td colspan="2"><a class="btn btn-success" href="{{url('complete/project/'.$project->id)}}">Complete</a></td>
                                                @endif
                                            @endif

                                           
                                          
                                         
                                        </tr>
                                        
                                          
                                    </table>
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
