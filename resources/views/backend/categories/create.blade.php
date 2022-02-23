@extends('backend.master')

@section('page_style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Category Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ old('name') ? old('name') : '' }}" placeholder="Enter your name">
                                            @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug"
                                            value="{{ old('slug') ? old('slug') : '' }}" placeholder="Enter your slug">
                                        @error('slug')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label> <br>
                                        <input type="file" name="image" id="image">

                                        @error('image')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex">
                                        <label for="category">
                                            Type
                                        </label>
                                        <div class="form-check ml-3">
                                            <input type="radio"
                                                class="form-check-input  @error('category') is-invalid @enderror"
                                                name="category" id="men" value="men">
                                            <label for="men" class="form-check-label">
                                                Men
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input type="radio"
                                                class="form-check-input @error('category') is-invalid @enderror"
                                                name="category" id="women" value="women">
                                            <label for="women" class="form-check-label">
                                                Women
                                            </label>
                                        </div>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('page_script')
    <script>
        $('#name').on('input', function() {
            var slug = slugify($('#name').val());
            $('#slug').val(slug);
        });

        function slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        }
    </script>
@endsection
