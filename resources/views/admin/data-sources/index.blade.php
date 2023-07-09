@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Источники</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.data-sources.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить источник</a>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>#ID</th>
                <th>Resource</th>
                <th>Description</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
            @foreach($resourceList as $resourceItem)
                <tr>
                    <td>{{ $resourceItem->id }}</td>
                    <td>{{ $resourceItem->name }}</td>
                    <th>{{ $resourceItem->description }}</th>
                    <td>{{ $resourceItem->created_at }}</td>
                    <td><a href="{{ route('admin.data-sources.edit', ['data_source' => $resourceItem]) }}">Edit</a>&nbsp; <a href="javascript:;" style="color:red">Delete</a> </td>
                </tr>
            @endforeach
        </table>

    </div>
@endsection
