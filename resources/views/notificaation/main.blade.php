@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'الاشعارات')
@section('content')

    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
            @php
                Session::forget('error');
            @endphp
        </div>
    @endif
<div class="container">
    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            اشعارات
            <small>الاباء</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <form action="{{ route('send.notification_father') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>العنوان</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>الرسالة</label>
                    <textarea class="form-control  @error('body') is-invalid @enderror" name="body" {{ old('body') }} required></textarea>
                    @if ($errors->has('body'))
                        <span class="text-danger">{{ $errors->first('body') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">ارسال حسب الدوله</label>
                                <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                    <option value="empty" selected>فارغ </option>
                                    @foreach ($country as $item)
                                        <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                    @endforeach
                                </select>
                        </div>
                    
                    </div> 
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">ارسال حسب المدينه</label>
                                <select name="id_city" class="js-example-disabled-results form-control form-control-solid">
                                    <option value="empty" selected>فارغ </option>
                                    @foreach ($city as $item)
                                        <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                    @endforeach
                                </select>

                        </div>

                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">ارسل</button>
            </form>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            اشعارات
            <small>اصحاب المؤسسات</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <form action="{{ route('send.notification_facility') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>عنوان</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label>الرسالة</label>
                    <textarea class="form-control" name="body"></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">ارسال حسب الدوله</label>
                                <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                    <option value="empty" selected>فارغ </option>
                                    @foreach ($country as $item)
                                        <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                    @endforeach
                                </select>
                        </div>
                    
                    </div> 
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">ارسال حسب المدينه</label>
                                <select name="id_city" class="js-example-disabled-results form-control form-control-solid">
                                    <option value="empty" selected>فارغ </option>
                                    @foreach ($city as $item)
                                        <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                    @endforeach
                                </select>

                        </div>

                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">ارسل </button>
            </form>
        </div>
    </div>

    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    <form action="{{ route('send.notification_father') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
  
                </div>
            </div>
        </div>
    </div> --}}
</div>  
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>
  
    var firebaseConfig = {
        apiKey: "AIzaSyDze4MC5wsPv-SsmiKXkkj0Rq9AvlvaZMs",
        authDomain: "asasapp2fa.firebaseapp.com",
        databaseURL: "https://XXXX.firebaseio.com",
        projectId: "asasapp2fa",
        storageBucket: "asasapp2fa.appspot.com",
        messagingSenderId: "311081741113",
        appId: "1:311081741113:web:a6bc7f6c56fc1cdb1196e8",
        measurementId: "G-J408QBZ1Y1"
    };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token-father") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
    </script>
@endsection
@endsection