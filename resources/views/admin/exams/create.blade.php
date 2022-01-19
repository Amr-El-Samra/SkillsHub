@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Exam</h1>
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


                <form action="{{url('dashboard/exams/store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (EN)</label>
                                    <input type="text" name="nameEn" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (AR)</label>
                                    <input type="text" name="nameAr" class="form-control">
                                </div>
                            </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description (EN)</label>
                                        <textarea name="descEn" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description (AR)</label>
                                        <textarea name="descAr" rows="5" class="form-control"></textarea>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select name="skill_id" class="custom-select form-control">
                                            @foreach ($skills as $skill)
                                            <option value="{{$skill->id}}">{{$skill->name('en')}}</option>
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
                                        <label>Questions</label>
                                        <input type="number" name="questionsNo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Difficulty</label>
                                        <input type="number" name="difficulty" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Duration (mins.)</label>
                                        <input type="number" name="durationMins" class="form-control">
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

 
