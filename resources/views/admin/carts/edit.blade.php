@extends('admin.main')

@section('content')
    @include('admin.alert')

    <form action="" method="post">
        <div class="card-body">
            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

                    <div class="p-t-15">
                        <span class="stext-112 cl12">
                            Thông Tin Khách Hàng
                        </span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Username</label>
                                    <input type="text" class="form-control" value="{{ $customer->name }}" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{ $customer->phone }}" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Email</label>
                                    <input type="text" class="form-control" value="{{ $customer->email }}" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Địa chỉ</label>
                                    <input type="text" class="form-control" value="{{ $customer->address }}" name="address" required>
                                </div>
                            </div>
                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="menu">Ghi chú</label>
                                    <textarea type="text" class="form-control" name="content">{{ $customer->content }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="service_status">Trạng thái đơn hàng</label>
                    <div class="col-md-4">
                        <select id="service_status" name="status" class="form-control">
                            <option {{$customer->status==1 ? 'selected =""' : ''}} value="1">Chờ xác nhận</option>
                            <option {{$customer->status==2 ? 'selected =""' : ''}} value="2">Đang được giao</option>
                            <option {{$customer->status==3 ? 'selected =""' : ''}} value="3">Đã giao</option>
                            <option {{$customer->status==4 ? 'selected =""' : ''}} value="4">Đã hủy</option>
                            <option {{$customer->status==5 ? 'selected =""' : ''}} value="5">Không nhận</option>
                        </select>
                    </div>
                </div>
                @csrf
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
