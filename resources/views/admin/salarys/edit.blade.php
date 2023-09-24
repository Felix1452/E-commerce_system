@extends('admin.main')

@section('head')
@endsection

@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Nhân viên</label>
                        <select class="form-control m-l-0-ssm" name="user_id" aria-label="Default select example" >
{{--                            <option  value="">Chọn nhân viên</option>--}}
                            @foreach($users as $key => $user)
                                <option selected value="{{ $user->id }}">{{ $user->name }} -- {{ $user->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Ngày tháng</label>
                        <input type="date" name="month" value="{{ $user->month }}" class="form-control"  placeholder="Nhập ngày tháng">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Lương cơ bản</label>
                        <input type="number" name="basic_salary" value="{{ $user->basic_salary }}" class="form-control"  placeholder="Nhập lương cơ bản">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Nhập số giờ làm hành chính</label>
                        <input type="number" name="office_hours" value="{{$user->office_hours}}" class="form-control"  placeholder="Nhập số giờ làm việc hành chính">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Nhập số giờ tăng ca</label>
                        <input type="number" name="overtime" value="{{ $user->overtime }}" class="form-control"  placeholder="Nhập số giờ tăng ca">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
@endsection
