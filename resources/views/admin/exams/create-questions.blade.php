@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Questions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url('dashboard/exams')}}">Exams</a></li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-3">
                
                @include('admin.inc.errors')


                <form action="{{url("dashboard/exams/store-questions/$exam_id")}}" method="post">
                    @csrf

                    <div class="card-body">

                        @for ($i = 1; $i <= $questionsNo; $i++)
                            <h5>Question {{$i}}</h5>                                                    
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="titles[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Right Answer</label>
                                        <input type="number" name="rightAns[]" class="form-control">
                                    </div>
                                </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Option 1</label>
                                            <input type="text" name="options1[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Option 2</label>
                                            <input type="text" name="options2[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Option 3</label>
                                            <input type="text" name="options3[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Option 4</label>
                                            <input type="text" name="options4[]" class="form-control">
                                        </div>
                                    </div>
                                
                            </div>
                            <hr>
                        @endfor

                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
@endsection

 
