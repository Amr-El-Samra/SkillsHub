@extends('admin.layout')

@section('main')
       <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">Skills</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Skills</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        @include('admin.inc.messages')
    
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">All Skills</h3>
        
                        <div class="card-tools">

                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addNew">
                            Add New
                          </button>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (EN)</th>
                                    <th>Name (AR)</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $skills as $skill)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$skill->name('en')}}</td>
                                    <td>{{$skill->name('ar')}}</td>
                                    <td>
                                        <img src="{{asset("uploads/$skill->img")}}" alt="skillImage" height="50px">
                                    </td>
                                    <td>{{$skill->cat->name('en')}}</td>
                                    <td>
                                        @if ($skill->active)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary editBtn" data-id="{{$skill->id}}" data-name-en="{{$skill->name('en')}}" data-name-ar="{{$skill->name('ar')}}" data-img="{{$skill->img}}" data-cat-id="{{$skill->cat_id}}" data-toggle="modal" data-target="#edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{url("dashboard/skills/delete/$skill->id")}}" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{url("dashboard/skills/toggle/$skill->id")}}" class="btn btn-secondary">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center my-4">
                        {{$skills->links()}}
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

            </div>
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    
        <div class="modal fade" id="addNew">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add New</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">

                    @include('admin.inc.errors')

                    <form id="addModal" method="POST" action="{{url('dashboard/skills/store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label>Name (EN)</label>
                        <input type="text" class="form-control" name="nameEn"  placeholder="Name (EN)">
                        </div>
                        <div class="form-group">
                        <label>Name (AR)</label>
                        <input type="text" class="form-control" name="nameAr"  placeholder="Name (AR)">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img">
                                <label class="custom-file-label">Choose file</label>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="custom-select form-control" name="cat_id">
                                @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" form="addModal" class="btn btn-primary">Submit</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="edit">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">

                    @include('admin.inc.errors')

                    <form id="editModal" method="POST" action="{{url('dashboard/skills/update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="editModalId">
                        <div class="form-group">
                            <label>Name (EN)</label>
                            <input type="text" id="editModalEn" class="form-control" name="nameEn"  placeholder="Name (EN)">
                        </div>
                        <div class="form-group">
                            <label>Name (AR)</label>
                            <input type="text" id="editModalAr" class="form-control" name="nameAr"  placeholder="Name (AR)">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img" id="editModalImg">
                                <label class="custom-file-label">Choose file</label>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="custom-select form-control" name="cat_id" id="editModalCatId">
                                @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" form="editModal" class="btn btn-primary">Update</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endsection

@section('scripts')
        <script>
            $('.editBtn').click(function(){
                let id = $(this).attr('data-id');
                let nameEn = $(this).attr('data-name-en');
                let nameAr = $(this).attr('data-name-ar');
                let img = $(this).attr('data-img');
                let catId = $(this).attr('data-cat-id');


                $('#editModalId').val(id);
                $('#editModalEn').val(nameEn);
                $('#editModalAr').val(nameAr);
                // $('#editModalImg').val(img);
                $('#editModalCatId').val(catId);



            })
        </script>
    
@endsection
