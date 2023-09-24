@extends('admin.main')

@section('content')


    <table id="sortTable" class="table table-light-sm">
        <thead style="font-size: 18px; font-style: italic">
        <tr>
            <th>ID</th>
            <th style="width: 15%">Username</th>
            <th>Email</th>
            <th>Quyền hạn</th>
            <th>Lương</th>
            <th>Tháng</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
{{--        {!! \App\Helpers\Helper::menu($menus) !!}--}}
        @foreach($salarys as $key => $salary)

            <tr>
                <td>{{$salary->user_id}}</td>
                <td>{{$salary->name}}</td>
                <td>{{$salary->email}}</td>
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
                <td>{{number_format(($salary->salary), 0, '', '.')}} VND</td>
                <td>{{$salary->month}}</td>
                <td>
                    <a style="margin-right: 5px" class="button btn-outline btn-sm" href="/admin/salarys/check/{{$salary->id}}">
                        <i class="fa fa-eye"></i> <i>Check</i>
                    </a>
                    <a class="button btn-outline btn-sm" href="/admin/salarys/edit/{{$salary->id}} ">
                        <i class="fa fa-gift"></i> <i>Edit</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    {!! $users->links('my-paginate') !!}--}}
@endsection
@section('footer')
    <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("sortTable");
            switching = true;
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[3];
                    y = rows[i + 1].getElementsByTagName("TD")[3];
                    //check if the two rows should switch place:
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
@endsection

