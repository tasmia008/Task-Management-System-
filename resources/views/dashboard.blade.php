<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('/css/dashboard.css')}}"/>
    </head>
    <body>
        <div id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                             <div><h5><a style="color: #bd2130" href="{{route('dashboard')}}">Task Management System</a></h5></div>
                             <div>
                              @if (auth()->user()->role_id == 1)
                              <a class="btn btn-primary text-white" href="#"  data-toggle="modal" data-target="#createRole">Create Role</a>
                              <a class="btn btn-success text-white" href="#"  data-toggle="modal" data-target="#createUser">Create User</a>
                              <a class="btn btn-info text-white" href="#" data-toggle="modal" data-target="#createProject">Create Project</a>
                              @endif
                                <a class="btn btn-danger text-white" href="{{route('logout')}}">Logout</a>
                            </div>

                            {{-- create user modal --}}
                            <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header alert alert-info">
                                      <h5 class="modal-title" id="exampleModalLabel">Creat User</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="userForm" method="POST" action="{{route('register.post')}}">
                                            @csrf
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Name</label>
                                              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Email</label>
                                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputPassword1">Password</label>
                                              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="form-group">
                                              <label for="role">Role</label>
                                              <select class="form-control" id="role" name="role_id"> 
                                                <option>Select</option>
                                                @if ($roles)
                                                    @foreach ($roles as $item)
                                                        <option value="{{$item->id}}">{{ ucfirst($item->name) }}</option>
                                                    @endforeach
                                                @endif
                                               
                                              </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                          </form>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>

                                {{-- create role modal --}}
                            <div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header alert alert-info">
                                      <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="roleForm" method="POST" action="{{route('create.role')}}">
                                            @csrf
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Name</label>
                                              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                          </form>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>

                              {{-- crete project --}}

                              <div class="modal fade" id="createProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="projectForm" method="POST" action="{{route('create.project')}}">
                                            @csrf
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Name</label>
                                              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="manager">Manager</label>
                                                <select class="form-control" id="manager" name="manager_id"> 
                                                  <option>Select</option>
                                                  @if ($managers)
                                                      @foreach ($managers as $item)
                                                          <option value="{{$item->id}}">{{ ucfirst($item->name) }}</option>
                                                      @endforeach
                                                  @endif
                                                </select>
                                            </div>   
                                            <div class="form-group">
                                                <label for="deadline">Deadline</label>
                                                <input type="date" class="form-control" id="deadline" name="deadline">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                  
                                  </div>
                                </div>
                              </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="content">
            <div class="container">

              @if (auth()->user()->role_id == 1)
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
                                <h5 class="text-center">Roles Table</h5>
                            </div>
                            <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"> Name</th>
                                             <th scope="col">Action</th>
                                           
                                             
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if ($roles)
                                               @foreach ($roles as $item)
                                                <tr>
                                                    <th scope="col">{{$loop->index + 1}}</th>
                                                    <td scope="col">{{ucwords($item->name) }}</td>
                                                      <td scope="col"> {{-- <a class="btn btn-sm btn-warning mr-1">Edit</a> --}}<a class="btn btn-sm btn-danger" onclick="deleteRole({{$item->id}})"  data-toggle="modal" data-target="#deleteRole">Delete</a></td>
                                                  
                                                    
                                                </tr>
                                               @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                  {{-- User table --}}
                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header alert alert-primary">
                                <h5 class="text-center">Users Table</h5>
                            </div>
                            <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"> Name</th>
                                            <th scope="col"> Email</th>
                                             <th scope="col">Role</th>
                                              <th scope="col">Action</th>
                                             
                                            
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if ($users)
                                               @foreach ($users as $item)
                                                <tr>
                                                    <th scope="col">{{$loop->index + 1}}</th>
                                                    <td scope="col">{{ucwords($item->name) }}</td>
                                                    <td scope="col">{{$item->email}}</td>
                                                    <td scope="col">{{$item->role_id ?  ucfirst($item->role->name) : ''}}</td>
                                                    <td scope="col"> {{-- <a class="btn btn-sm btn-warning mr-1">Edit</a> --}}<a class="btn btn-sm btn-danger" onclick="deleteUser({{$item->id}})"  data-toggle="modal" data-target="#deleteUser">Delete</a></td>
                                                </tr>
                                               @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
              @endif
                {{-- project table --}}
                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-10">
                        
                        <div class="card">
                            <div class="card-header alert alert-warning">
                                <h5 class="text-center">Projects Table</h5>
                            </div>
                            <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Project Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Last Update</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Action</th>
                                           
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if ($projects)
                                                @foreach ($projects as $item)
                                                    <tr>
                                                        <th scope="row">{{$loop->index + 1}}</th>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->status == 0 ? 'Ongoing' : 'Completed' }}</td>
                                                        <td>{{ $item->last_update }}</td>
                                                        @php
                                                            $today = date("Y-m-d", strtotime("now")) ;
                                                            $deadline = date("Y-m-d", strtotime($item->deadline));
                                          
                                                            $date1=date_create($today);
                                                            $date2=date_create($deadline);
                                                            $diff=date_diff($date1,$date2);
                                                           
                                                          @endphp
                                                        <td>{{$diff->format("%R%a days")}}</td>
                                                      
                                                        <td>
                                                          <a class="btn btn-sm btn-info mr-1" href="{{route('project.details',['id' => $item->id])}}">Details Page</a>
                                                          @if (auth()->user()->role_id == 1)
                                                          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteProject" onclick="deleteProject({{$item->id}})">Delete</a>
                                                          @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                  {{-- delete project modal --}}
                  <div class="modal fade" id="deleteProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header alert alert-info">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Projct</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-danger">Are You Sure ?</h1>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{route('delete.project')}}" method="POST">
                                @csrf
                                <input type="hidden" class="project_id" name="project_id"/>
                                <button class="btn btn-primary" type="submit">Ok</button>
                            </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                 {{-- delete user modal --}}
                 <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header alert alert-info">
                          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-danger">Are You Sure ?</h1>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{route('delete.user')}}" method="POST">
                                @csrf
                                <input type="hidden" class="user_id" name="user_id"/>
                                <button class="btn btn-primary" type="submit">Ok</button>
                            </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
              

                 {{-- delete role modal --}}
                 <div class="modal fade" id="deleteRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header alert alert-info">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-danger">Are You Sure ?</h1>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{route('delete.role')}}" method="POST">
                                @csrf
                                <input type="hidden" class="role_id" name="role_id"/>
                                <button class="btn btn-primary" type="submit">Ok</button>
                            </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
        <script>
            
            function deleteProject(id){
                
               $("#deleteProject").find(".project_id").val(id);
                
            }
            function deleteUser(id){
                
               $("#deleteUser").find(".user_id").val(id);
                
            }
            function deleteRole(id){
                
               $("#deleteRole").find(".role_id").val(id);
                
            }
        </script>
    </body>
</html>

