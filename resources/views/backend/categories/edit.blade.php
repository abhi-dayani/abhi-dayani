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
                                <h3>Categories Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="{{ route('categories.update') }}" method="POST">@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ old('name') ? old('name') : $categories->name }}"
                                            placeholder="Enter your name.">
                                        <input type="hidden" name="id" class="form-control" id="id"
                                            value="{{ $categories->id }}">
                                        @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug"
                                            value="{{ old('slug') ? old('slug') : $categories->slug }}"
                                            placeholder="Enter your Slug">
                                        @error('slug')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                name="status" {{ $categories->status == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch1">Status</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <label for="category">
                                            Type
                                        </label>
                                        <div class="form-check ml-3">
                                            <input type="radio"
                                                class="form-check-input  @error('category') is-invalid @enderror"
                                                name="category" id="men" value="men"
                                                {{ $categories->category == 'men' ? 'checked' : '' }}>
                                            <label for="men" class="form-check-label">
                                                Men
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input type="radio"
                                                class="form-check-input @error('category') is-invalid @enderror"
                                                name="category" id="women" value="women"
                                                {{ $categories->category == 'women' ? 'checked' : '' }}>
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
