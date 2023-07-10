@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Категории</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить категорию</a>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
            @foreach($categoryList as $categoryItem)
                <tr>
                    <td>{{ $categoryItem->id }}</td>
                    <td>{{ $categoryItem->title }}</td>
                    <td>{{ $categoryItem->description }}</td>
                    <td>{{ $categoryItem->created_at }}</td>
                    <<td><a href="{{ route('admin.categories.edit', ['category' => $categoryItem]) }}">Edit</a> <a class="delete" href="javascript:;" style="color:red" rel="{{$categoryItem->id}}">Delete</a> </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
"@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            let items = document.querySelectorAll(".delete")
            items.forEach(function (item, key) {
                item.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if(confirm(`Подтвердить удаление категории с #ID = ${id}`)) {
                        send(`/admin/categories/${id}`).then(() => {
                            location.reload();
                        });
                    } else {
                        alert("Отменено");
                    }
                })
            })
        })

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });


            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
