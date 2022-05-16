<x-panel-layout>
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        <small>لیست دوره ها</small>
                    </h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="جست و جو برای...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">برو!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <small>دوره های سایت</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">تنظیمات 1</a>
                                    </li>
                                    <li><a href="#">تنظیمات 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام دوره</th>
                                    <th>مدرس</th>
                                    <th>لینک</th>
                                    <th>بنر</th>
                                    <th>قیمت</th>
                                    <th>تعداد بازدید</th>
                                    <th>تعداد دانشجو</th>
                                    <th>پیش نیاز</th>
                                    <th>مدت زمان</th>
                                    <th>وضعیت</th>
                                    <th>سطح</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ بروزرسانی</th>
                                    <th>وضعیت انتشار</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$course->name}}</td>
                                        <td>{{$course->user->name}}</td>
                                        <td>{{$course->slug}}</td>
                                        <td class="text-center"><img src="{{$course->getBanner()}}" alt="" height="52"></td>
                                        <td>{{$course->price}}</td>
                                        <td>{{$course->view_count}}</td>
                                        <td>{{$course->student_count}}</td>
                                        <td>{{$course->pre_course}}</td>
                                        <td>{{$course->time}}</td>
                                        <td>{{$course->getStatus()}}</td>
                                        <td>{{$course->getLevel()}}</td>
                                        <td>{{$course->getCreatedAtInJalali()}}</td>
                                        <td>{{$course->getUpdatedAtInJalali()}}</td>
                                        <td class="{{$course->is_approved ? 'text-success' : 'text-danger'}}">{{$course->is_approved()}}</td>
                                        <td>
                                            <div style="display: flex; justify-content: space-evenly">
                                                <div>
                                                    @if($course->is_approved)
                                                        <div>
                                                            <a href="{{route('courses.status',$course->id)}}" onclick="updateIsApproved(event, {{ $course->id }})"><i class="fa-x fa-times" title="عدم تایید"></i></a>
                                                            <form action="{{route('courses.status',$course->id)}}" method="post" id="update-isApproved-{{ $course->id }}">
                                                                @csrf
                                                                @method('put')
                                                            </form>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <a href="{{route('courses.status',$course->id)}}" onclick="updateIsApproved(event, {{ $course->id }})"><i class="fa-x fa-check" title="تایید"></i></a>
                                                            <form action="{{route('courses.status',$course->id)}}" method="post" id="update-isApproved-{{ $course->id }}">
                                                                @csrf
                                                                @method('put')
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div><a href="{{route('courses.show',$course->slug)}}" target="_blank"><i class="fa-x fa-eye text-primary" title="نمایش"></i></a></div>
                                                <div><a href="{{route('courses.edit',$course->id)}}"><i class="fa-x fa-edit text-primary" title="ویرایش"></i></a></div>
                                                <div>
                                                    <a href="{{route('courses.destroy',$course->id)}}" onclick="destroyCourse(event, {{ $course->id }})"><i class="fa-x fa-trash text-danger" title="حذف"></i></a>
                                                    <form action="{{route('courses.destroy',$course->id)}}" method="post" id="destroy-course-{{ $course->id }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {!! $courses->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('assets/panel/js/sweetalert2.all.min.js')}}"></script>
        <script>
            function destroyCourse(event, id) {
                event.preventDefault();
                Swal.fire({
                    title: 'آیا از حذف اطمینان دارید؟',
                    text: "اطلاعات بعد از حذف قابل بازیابی نیست !",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    cancelButtonColor: '#EFEFEF',
                    confirmButtonColor: '#D9534F',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'لغو',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`destroy-course-${id}`).submit()
                    }
                })
            }

            function updateIsApproved(event, id) {
                event.preventDefault();
                document.getElementById(`update-isApproved-${id}`).submit()
            }
        </script>
    </x-slot>
</x-panel-layout>
