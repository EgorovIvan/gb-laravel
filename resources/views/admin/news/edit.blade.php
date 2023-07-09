@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>

    </div>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="categories">Категории</label>
            <select class="form-control" multiple name="categories[]" id="categories">
                @foreach($categories as $category)
                    <option @if(in_array($category->id, $news->categories->pluck('id')->toArray())) selected
                            @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="data_sources">Источники</label>
            <select class="form-control" multiple name="data_sources[]" id="data_sources">
                @foreach($data_sources as $data_source)
                    <option @if(in_array($data_source->id, $news->data_sources->pluck('id')->toArray())) selected
                            @endif value="{{ $data_source->id }}">{{ $data_source->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}"/>
            @error('title') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ $news->author }}"/>
            @error('author') <strong style="color:red" type="danger" >{{$message}}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image" class="form-control" />
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option @if($news->status === 'draft') selected @endif value="{{ \App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option @if($news->status === 'active') selected @endif value="{{ \App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option @if($news->status === 'blocked') selected @endif value="{{ \App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea type="text" name="description" id="description" class="form-control" >{{$news->description}}</textarea>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Cохранить</button>
    </form>

@endsection
