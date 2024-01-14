@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'اتفاقيات المؤسسات')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif
<div class="container">
    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            تعديل اتفاقية للوؤسسات
            {{-- <small>اضف جديد</small> --}}
          </h3>
         </div>
        </div>
        <div class="card-body">

            <form action="{{route('agreements_facility.update', $agreements_facility->id)}}" method="post">
                @csrf
                @method("PUT")

                <div class="form-group row">
                    <label class="col-2 col-form-label">الاتفاقية</label>
                    <div class="col-10">
                        <select name="id_agreement" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($agreements as $item)
                                <option value="{{$item->id}}" @if($item->name_ar == $agreements_facility->name_ar) selected @endif>{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-2 col-form-label">المؤسسة</label>
                    <div class="col-10">
                        <select name="id_facility" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($facility_owner as $item)
                                <option value="{{$item->id}}" @if($item->name_corporation == $agreements_facility->name_corporation) selected @endif>{{$item->name_corporation}} ({{$item->id}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            
                <div class="form-group row">
                    <label class="col-2 col-form-label">الحالة</label>
                    <div class="col-10">
                        <select name="status" class="form-control form-control-solid">
                            <option value="مفعلة" @if($agreements_facility->status == "مفعلة") selected @endif>مفعلة</option>
                            <option value="غير مفعلة" @if($agreements_facility->status == "غير مفعلة") selected @endif>غير مفعلة</option>
                            <option value="مفعلة مؤقتا" @if($agreements_facility->status == "مفعلى مؤقتا") selected @endif>مفعلى مؤقتا</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">تاريخ النهاية</label>
                    <div class="col-10">
                        <input class="form-control" name="end_date" type="date" value="{{$agreements_facility->end_date}}" id="example-date-input">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>

            </form>

        </div>
    </div>
</div>
@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
    </script>
@endsection