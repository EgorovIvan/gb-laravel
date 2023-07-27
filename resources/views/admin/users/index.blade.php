@extends('layouts.admin')
@section('content')

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Аccess rights</th>
                <th>Actions</th>
            </tr>
            @foreach($userList as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->isAdmin) Администратор @else Пользователь @endif </td>
                    <<td><a href="{{ route('admin.users.edit', ['user' => $user]) }}">Edit</a> <a class="delete" href="javascript:;" style="color:red" rel="{{$user->id}}">Delete</a> </td>
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
                    if(confirm(`Подтвердить удаление профиля с #ID = ${id}`)) {
                        send(`/admin/users/${id}`).then(() => {
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
