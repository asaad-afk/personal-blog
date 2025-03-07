@extends("template.layout")

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    i{
        cursor: pointer;
    }
</style>
@endsection

@section("content")

<div class="container register-form">
    <form action="{{ route("registerPost") }}" method="POST">
        @csrf
    <div class="form">
        <div class="note">
            <p>This is a simpleRegister Form made using Boostrap.</p>
        </div>

        <div class="form-content">
            <div class="row">
                <div class="col-md m-1">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control m-1" required placeholder="Your Name *" value=""/>
                        @error("name")
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control m-1" required placeholder="Email *" value=""/>
                        @error("email")
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md m-1">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control m-1" required placeholder="Your Password *" value=""/>
                        @error("password")
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary m-1">Submit</button>
        </div>
    </div>
    </div>


    </form>
    	<script type="text/javascript">
</script>

@endsection
@section("script")
<script type="text/javascript">
    window.alert = function(){};
    var defaultCSS = document.getElementById('bootstrap-css');
    function changeCSS(css){
        if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
        else $('head > link').filter(':first').replaceWith(defaultCSS);
    }
    $( document ).ready(function() {
      var iframe_height = parseInt($('html').height());
      window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
    });
</script>

@endsection
