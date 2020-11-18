@extends('admin.dashboard')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">

        <div class="card cat-card">
            <form action="{{ route('category.save') }}" method="post" class="w-50" >
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" placeholder="Category Name" id="name" class="form-control @error('name') is-invalid @enderror ">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" placeholder="Slug" id="slug" class="form-control @error('slug') is-invalid @enderror ">
                    @error('slug')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Parent</label>
                    <div id="jstree"></div>
                    <input type="hidden" name="parent_id" placeholder="Parent" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    @error('parent_id')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="checkbox" name="status" id="status">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>


    @push('js')

        <script>
            $('#jstree').jstree({ 'core' : {
                    'data' : {!! load_categories() !!}
                },
                "checkbox": {
                    "keep_selected_style": true
                },
                "theme": {
                    "variant": "large"
                },
                "plugins": ["radio", "search"]
            });

            let to = false;
            $('#search').keyup(function () {
                if(to) { clearTimeout(to); }
                to = setTimeout(function () {
                    var v = $('#search').val();
                    $('#jstree').jstree(true).search(v);
                }, 250);
            });

            $('#jstree').on('changed.jstree', function(e,data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    console.log(data.instance.get_node(data.selected[i]))
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                console.log(r);

                $("#parent_id").val(r.join(', '))

            })
        </script>
    @endpush

@stop
