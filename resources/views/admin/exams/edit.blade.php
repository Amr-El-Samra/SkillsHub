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
                <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/edit/$exam->id")}}">Edit Exam</a></li>
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


                <form action="{{url("dashboard/exams/update/$exam->id")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (EN)</label>
                                    <input type="text" name="nameEn" class="form-control" value="{{$exam->name('en')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (AR)</label>
                                    <input type="text" name="nameAr" class="form-control" value="{{$exam->name('ar')}}">
                                </div>
                            </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description (EN)</label>
                                        <textarea name="descEn" rows="5" class="form-control">{{$exam->desc('en')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description (AR)</label>
                                        <textarea name="descAr" rows="5" class="form-control">{{$exam->desc('ar')}}</textarea>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select name="skill_id" class="custom-select form-control">
                                            @foreach ($skills as $skill)
                                            <option value="{{$skill->id}}" @if ($exam->skill_id == $skill->id) selected @endif>{{$skill->name('en')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input">
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Difficulty</label>
                                        <input type="number" name="difficulty" class="form-control" value="{{$exam->difficulty}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Duration (mins.)</label>
                                        <input type="number" name="durationMins" class="form-control" value="{{$exam->duration_mins}}">
                                    </div>
                                </div>
                            
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
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

 
