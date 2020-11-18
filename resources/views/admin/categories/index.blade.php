@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="btn-group-sm py-2 controls d-none">
            <a href="#" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-outline-danger">Delete</a>
        </div>
        <div id="jstree"></div>
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
                if (r.join(', ') !== '') {
                    $(".controls").removeClass('d-none')

                    let lint_edit = ''
                    lint_edit = lint_edit.replace('id', r.join(', '))
                    $(".btn-edit").attr('href', lint_edit);

                    let lint_del = ''
                    lint_del = lint_del.replace('id', r.join(', '))
                    $(".btn-del").attr('href', lint_del);
                }
            })
        </script>
    @endpush
@stop



{{--
[
    { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
    { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
    { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
    { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
]
--}}
