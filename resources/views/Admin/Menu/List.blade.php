
@extends('Admin.Layouts.master')

@section('title', 'مدیریت منوها')

{{-- استایل‌های Nestable در این بخش پوش می‌شوند --}}
@push('styles')
    <style> 
        /* ... کدهای CSS مربوط به Nestable در اینجا قرار می‌گیرند ... */
        .dd { position: relative; display: block; list-style: none; margin: 0; padding: 0; }
        .dd-list { display: block; position: relative; list-style: none; margin: 0; padding: 0; }
        .dd-item, .dd-empty, .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
        .dd-handle { display: block; height: 40px; margin: 5px 0; padding: 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc; background: #fafafa; border-radius: 3px; box-sizing: border-box; }
        .dd-handle:hover { color: #2ea8e5; background: #fff; }
        .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
        .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
        .dd-item > button[data-action="collapse"]:before { content: '-'; }
        .dd-actions { float: left; }
    </style>
@endpush

@section('content')
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="menu-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="list-tab-link" data-toggle="pill" href="#list-tab" role="tab" aria-controls="list-tab" aria-selected="true">لیست منوها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="create-tab-link" data-toggle="pill" href="#create-tab" role="tab" aria-controls="create-tab" aria-selected="false">افزودن منوی جدید</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="tab-content" id="menu-tabs-content">
                {{-- تب لیست منوها --}}
                <div class="tab-pane fade show active" id="list-tab" role="tabpanel" aria-labelledby="list-tab-link">
                    <div class="dd" id="menu-nestable">
                        <ol class="dd-list">
                            @foreach($menus as $menu)
                                @include('Admin.Menu._menu_item', ['item' => $menu])
                            @endforeach
                        </ol>
                    </div>
                     <hr>
                     <button type="button" class="btn btn-success mt-3" id="save-order-btn">ذخیره ترتیب</button>
                </div>

                {{-- تب افزودن منوی جدید --}}
                <div class="tab-pane fade" id="create-tab" role="tabpanel" aria-labelledby="create-tab-link">
                    @include('Admin.Menu.Create')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- اسکریپت‌های Nestable در این بخش پوش می‌شوند --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#menu-nestable').nestable({ maxDepth: 5 });

            $('#save-order-btn').on('click', function(e) { /* ... کد ایجکس ... */ });
            
            // اگر خطای اعتبارسنجی وجود داشته باشد، تب ایجاد را فعال کن
            @if($errors->any())
                $('#create-tab-link').tab('show');
            @endif
        });
    </script>
@endpush