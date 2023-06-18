@extends('layouts.news')
@section('content')
    <div class="container">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Создать заказ</h1>

        </div>


        <form method="post" action="{{ route('news.store', ['query' => 'test']) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="customer">Имя заказчика</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ old('customer') }}"/>
            </div>
            <div class="form-group">
                <label for="phone-number">Номер телефона</label>
                <input type="number" name="phone-number" id="phone-number" class="form-control" value="{{ old('phone-number') }}"/>
            </div>
            <div class="form-group">
                <label for="email">Имя заказчика</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"/>
            </div>
            <div class="form-group">
                <label for="info">Информация по заказу</label>
                <textarea class="form-control" name="info" id="info">{!! old('info') !!}</textarea>
            </div>

            <br/>
            <button type="submit" class="btn btn-success">Cохранить</button>
        </form>
    </div>

@endsection
