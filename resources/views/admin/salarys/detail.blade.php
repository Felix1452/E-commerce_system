@extends('admin.main')

@section('content')
    @foreach($salarys as $key => $salary)
        <div class="container mt-1 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-2">
                <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip of: {{ $salary->month }}</span>
            </div>
            <div class="d-flex justify-content-end"> <span>Working Branch:ROHINI</span> </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">{{ $salary->user_id }}</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">{{ $salary->name }}</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">PF No.</span> <small class="ms-3">101523065714</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">NOD</span> <small class="ms-3">28</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">SBI</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Designation</span> <small class="ms-3">Marketing Staff (MK)</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small> </div>
                        </div>
                    </div>
                </div>
                <table class="mt-4 table table-bordered">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Earnings</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Deductions</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Basic</th>
                        <td>{{number_format(($salary->basic_salary), 0, '', '.')}} VND</td>
                        <td>PF</td>
                        <td>{{number_format(($salary->basic_salary), 0, '', '.')}} VND</td>
                    </tr>
                    <tr>
                        <th scope="row">Office hour</th>
                        <td>{{ $salary->office_hours }}</td>
                        <td>ESI</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th scope="row">Overtime</th>
                        <td>{{ $salary->overtime }} </td>
                        <td>TDS</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <th scope="row">position</th>
                        <td>
                            @if($salary->active == 1)
                                Admin
                            @elseif($salary->active == 2)
                                Quản lí
                            @elseif($salary->active == 3)
                                Nhân viên
                            @elseif($salary->active == 4)
                                Khách hàng
                            @else
                                Nhân viên thực tập
                            @endif
                        </td>
                        <td>LOP</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <th scope="row">Coefficients salary</th>
                        <td>{{ $salary->coefficients_salary }} </td>
                        <td>PT</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <th scope="row">Month</th>
                        <td>{{ $salary->month }}</td>
                        <td>SPL. Deduction</td>
                        <td>500.00</td>
                    </tr>
                    <tr>
                        <th scope="row">Allowance</th>
                        <td>1400.00</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="border-top">
                        <th scope="row">Total Earning</th>
                        <td>{{number_format(($salary->salary), 0, '', '.')}} VND</td>
                        <td>Total Deductions</td>
                        <td>{{number_format(($salary->salary), 0, '', '.')}} VND</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-4"> <br> <span class="fw-bold">Net Pay : {{number_format(($salary->salary), 0, '', '.')}} VND</span> </div>
                <div class="border col-md-8">
                    <div class="d-flex flex-column"> <span>In Words</span> <span>Twenty Five thousand nine hundred seventy only</span> </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For {{ $salary->name }} Programmer</span> <span class="mt-4">Authorised Signatory</span> </div>
            </div>
        </div>
    </div>
</div>
    @endforeach

@endsection
@section('footer')
@endsection
