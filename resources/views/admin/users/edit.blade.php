@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать профиль</h1>

    </div>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="post"
          action="{{ route('admin.users.update', ['user' => $user]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"/>
            @error('name') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}"/>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="password">Почта</label>--}}
{{--            <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}"/>--}}
{{--        </div>--}}
        <br />
        <div class="form-group">
            <input type="checkbox" name="isAdmin" id="isAdmin" class="form-check-input" @checked( $user->isAdmin )  value="{{ $user->isAdmin }}"/>
            <label for="isAdmin" class="form-check-label">Установить права администатора</label>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Cохранить</button>
    </form>

@endsection
