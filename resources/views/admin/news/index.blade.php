@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Новости</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить новость</a>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        @include('admin.message')
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Categories</th>
                <th>Resources</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Description</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
            @foreach($newsList as $newsItem)
                <tr>
                    <td>{{ $newsItem->id }}</td>
                    <td>{{ $newsItem->categories->map(fn($item) => $item->title)->implode("|") }}</td>
                    <td>{{ $newsItem->data_sources->map(fn($item) => $item->name)->implode("|") }}</td>
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ $newsItem->author }}</td>
                    <td>{{ $newsItem->status }}</td>
                    <td>{{ $newsItem->description }}</td>
                    <td>{{ $newsItem->created_at }}</td>
                    <td><a href="{{ route('admin.news.edit', ['news' => $newsItem]) }}">Edit</a>  <a class="delete" href="javascript:;" style="color:red" rel="{{$newsItem->id}}">Delete</a> </td>
                </tr>
            @endforeach
        </table>

        {{ $newsList->links() }}
    </div>
@endsection
"@push('js')
     <script type="text/javascript">
         document.addEventListener('DOMContentLoaded', function () {
             let items = document.querySelectorAll(".delete")
             items.forEach(function (item, key) {
                 item.addEventListener('click', function () {
                     const id = this.getAttribute('rel');
                     if(confirm(`Подтвердить удаление записи с #ID = ${id}`)) {
                         send(`/admin/news/${id}`).then(() => {
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
