<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidemenu" style="margin-top: 0%;">
        <div class="app-sidebar__user clearfix">
            <!-- Keep your user info here -->
        </div>
        
        <ul class="side-menu">
            <!-- الرئيسية -->
            <li class="side-item side-item-category">الرئيسية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/home') }}">
                    <i class="side-menu__icon fe fe-home"></i>
                    <span class="side-menu__label">الرئيسية</span>
                </a>
            </li>

            <!-- إدارة الموظفين -->
            <li class="side-item side-item-category">إدارة الموظفين</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#employees">
                    <i class="side-menu__icon fe fe-users"></i>
                    <span class="side-menu__label">بيانات الموظفين</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('employees.index') }}">جميع الموظفين</a></li>
                    <li><a class="slide-item" href="{{ route('employee-statuses.index') }}">حالات الموظفين</a></li>
                    <li><a class="slide-item" href="{{ route('foreigners.index') }}">الموظفين الأجانب</a></li>
                    <li><a class="slide-item" href="{{ route('palestinians.index') }}">الموظفين الفلسطينين</a></li>
                </ul>
            </li>

            <!-- الهيكل التنظيمي -->
            <li class="side-item side-item-category">الهيكل التنظيمي</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#organization">
                    <i class="side-menu__icon fe fe-layers"></i>
                    <span class="side-menu__label">الهيكل التنظيمي</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('faculties.index') }}">الكليات</a></li>
                    <li><a class="slide-item" href="{{ route('majors.index') }}">التخصصات</a></li>
                    <li><a class="slide-item" href="{{ route('positions.index') }}">المناصب الوظيفية</a></li>
                    <li><a class="slide-item" href="{{ route('cities.index') }}">المدن</a></li>
                    <li><a class="slide-item" href="{{ route('regions.index') }}">المناطق</a></li>
                    <li><a class="slide-item" href="{{ route('universities.index') }}">الجامعات</a></li>
                </ul>
            </li>

            <!-- المؤهلات والشهادات -->
            <li class="side-item side-item-category">المؤهلات والشهادات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#certificates">
                    <i class="side-menu__icon fe fe-award"></i>
                    <span class="side-menu__label">الشهادات والمؤهلات</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('certificate-types.index') }}">أنواع الشهادات</a></li>
                    <li><a class="slide-item" href="{{ route('certificate-specializations.index') }}">اختصاصات الشهادات</a></li>
                    <li><a class="slide-item" href="{{ route('certificate-countries.index') }}">بلدان الشهادات</a></li>
                    <li><a class="slide-item" href="{{ route('certificates.index') }}">جميع الشهادات</a></li>
                </ul>
            </li>

            <!-- التدريب والدورات -->
            <li class="side-item side-item-category">التدريب والدورات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#training">
                    <i class="side-menu__icon fe fe-book-open"></i>
                    <span class="side-menu__label">برامج التدريب</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                     <li><a class="slide-item" href="{{ route('iust-courses-intitled.index') }}">صلاحية دورات الجامعةالدولية</a></li>
                        <li><a class="slide-item" href="{{ route('iust-courses.index') }}">دورات تدريبية في الجامعة الدولية</a></li>
                    <li><a class="slide-item" href="{{ route('taught-courses.index') }}">الدورات المدّرسة</a></li>
                    <li><a class="slide-item" href="{{ route('courses.index') }}">جميع الدورات</a></li>
                </ul>
            </li>

            <!-- الأحداث والتواصل -->
            <li class="side-item side-item-category">الأحداث والتواصل</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#events">
                    <i class="side-menu__icon fe fe-calendar"></i>
                    <span class="side-menu__label">الأحداث والتواصل</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('events.index') }}">الأحداث</a></li>
                    <li><a class="slide-item" href="{{ route('life-events.index') }}">الأحداث الوظيفية</a></li>
                    <li><a class="slide-item" href="{{ route('contacts.index') }}">التواصل</a></li>
                    <li><a class="slide-item" href="{{ route('contact-types.index') }}">نوع التواصل</a></li>
                </ul>
            </li>

            <!-- إدارة النظام -->
<!-- System Management Section -->
@if(auth()->user()->isAdmin() || auth()->user()->isDepartmentHead())
<li class="side-item side-item-category">إدارة النظام</li>
<li class="slide">
    <a class="side-menu__item" data-toggle="slide" href="#system">
        <i class="side-menu__icon fe fe-settings"></i>
        <span class="side-menu__label">إعدادات النظام</span>
        <i class="angle fe fe-chevron-down"></i>
    </a>
    <ul class="slide-menu">
        <!-- Users Menu Item - Show for Admin and Department Head -->
        @if(auth()->user()->isAdmin() || auth()->user()->isDepartmentHead())
        <li><a class="slide-item" href="{{ route('users.index') }}">المستخدمين</a></li>
        @endif
        
        <!-- Roles Menu Item - Show only for Admin -->
        @if(auth()->user()->isAdmin())
        <li><a class="slide-item" href="{{ route('roles.index') }}">صلاحيات المستخدمين</a></li>
        @endif
        @endif
</aside>