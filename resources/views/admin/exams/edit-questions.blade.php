@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url('dashboard/exams')}}">Exams</a></li>
                <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/edit/$exam->id")}}">{{$exam->name('en')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/show/$exam->id/questions")}}">Questions</a></li>
                <li class="breadcrumb-item active">Edit</li>

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


                <form action="{{url("dashboard/exams/update-questions/$exam->id/$question->id")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="titles" class="form-control" value="{{$question->title}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Right Answer</label>
                                    <input type="number" name="rightAns" class="form-control" value="{{$question->right_ans}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Option 1</label>
                                <input type="text" name="options1" class="form-control" value="{{$question->option_1}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Option 2</label>
                                <input type="text" name="options2" class="form-control" value="{{$question->option_2}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Option 3</label>
                                <input type="text" name="options3" class="form-control" value="{{$question->option_3}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Option 4</label>
                                <input type="text" name="options4" class="form-control" value="{{$question->option_4}}">
                                </div>
                            </div>
                        </div>
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

 
