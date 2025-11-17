@extends('Admin.Layouts.Master')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">مدیریت مهارت‌ها</h4>

        <!-- تب‌ها -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="view-tab" data-bs-toggle="tab" data-bs-target="#skills-view" type="button" role="tab" aria-controls="skills-view" aria-selected="true">مشاهده</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="create-edit-tab" data-bs-toggle="tab" data-bs-target="#skills-create-edit" type="button" role="tab" aria-controls="skills-create-edit" aria-selected="false">ایجاد فرم </button>
            </li>
        </ul>

        <!-- محتوای تب‌ها -->
        <div class="tab-content" id="myTabContent">
            <!-- تب مشاهده -->
            <div class="tab-pane fade show active" id="skills-view" role="tabpanel" aria-labelledby="view-tab">
                <div id="skills-display" class="mt-3">

                    {{-- بررسی اینکه آیا اصلا مهارتی وجود دارد یا خیر --}}
                    @if(isset($skillGroups) && $skillGroups->isNotEmpty())
                        <div class="accordion" id="skillsAccordion">
                            {{-- حلقه بر روی هر گروه مهارت --}}
                            @foreach($skillGroups as $title => $skills)
                                <div class="accordion-item mb-3">
                                    <h2 class="accordion-header" id="heading-{{ $loop->iteration }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse-{{ $loop->iteration }}">
                                            <div class="d-flex align-items-center gap-3">
                                                {{-- نمایش عکس گروه (از اولین مهارت گروه استفاده می‌کنیم) --}}
                                                @if($skills->first()->image)
                                                    <img src="{{ asset($skills->first()->image) }}" alt="{{ $title }}" width="50" class="rounded">
                                                @endif
                                                <span class="fw-bold fs-5">{{ $title }}</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $loop->iteration }}" class="accordion-collapse collapse show" aria-labelledby="heading-{{ $loop->iteration }}" data-bs-parent="#skillsAccordion">
                                        <div class="accordion-body">
                                            @if($skills->first()->short_description)
                                                <p>{{ $skills->first()->short_description }}</p>
                                            @endif

                                            <!-- لیست مهارت‌های این گروه -->
                                            <ul class="list-group mb-3">
                                                @foreach($skills as $skill)
                                                    <li class="list-group-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span>{{ $skill->skill_name }}</span>
                                                            <span class="badge bg-primary">{{ $skill->skill_level }}%</span>
                                                        </div>
                                                        <div class="progress mt-2" style="height: 10px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $skill->skill_level }}%;" aria-valuenow="{{ $skill->skill_level }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <!-- دکمه‌های عملیات (ویرایش و حذف) -->
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.skills.edit', $skills->first()) }}" class="btn btn-sm btn-label-warning">ویرایش</a>
                                                <form action="{{ route('admin.skills.destroy', $skills->first()) }}" method="POST" onsubmit="return confirm('آیا از حذف این گروه مهارت مطمئن هستید؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-label-danger">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning text-center">
                            هیچ گروه مهارتی برای نمایش وجود ندارد. لطفاً از تب "ایجاد" یک گروه جدید اضافه کنید.
                        </div>
                    @endif

                </div>
            </div>

            <!-- تب ایجاد / ویرایش -->
            <div class="tab-pane fade" id="skills-create-edit" role="tabpanel" aria-labelledby="create-edit-tab">
                {{-- محتوای این تب از فایل دیگر include می‌شود --}}
                @include('Admin.Skill.Create')
            </div>
        </div>
    </div>
</div>
<!-- / Content wrapper -->
@endsection