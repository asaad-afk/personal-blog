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
    <form action="{{ route("loginPost") }}" method="POST">
        @csrf
    <div class="form">
        <div class="note">
            <p>This is a simpleLoginform Form made using Boostrap.</p>
        </div>

        <div class="form-content m-1">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control m-1" placeholder="Email *" required value=""/>
                        @error("email")
                            <p>{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="col-md">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control m-1" placeholder="Your Password *" required value=""/>
                        @error("password")
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </div>
        <a href="{{ route("register") }}" class="btn btn-info m-1">don't have account</a>
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
