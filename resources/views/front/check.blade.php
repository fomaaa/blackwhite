@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Check client</div>

                <div class="panel-body check-form">
                    <div class="row">
                        <form action="/checkbyphone" id="checkbyphone" method="post">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Enter Phone</label>

                                <div class="col-md-4">
                                    <input id="phone" type="text" class="form-control" min="10" name="phone" placeholder="+797100000000">
                                    <span class="error">10 numbers required</span>
                                </div>
                                <div class="col-md-2">
                                     <button type="submit"  class="btn  btn-primary ">Check</button>
                                </div>
                            </div>  
                        </form>
                    </div>
                    <div class="row">
                        <form action="/checkbyemail" id="checkbyemail" method="post">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Enter Email</label>

                                <div class="col-md-4">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="client@mail.com">
                                    <span class="error">Please enter valid email</span>
                                </div>
                                <div class="col-md-2">
                                     <button type="submit" class="btn  btn-primary ">Check</button>
                                </div>
                            </div>  
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="row review-block">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Reviews</div>
                <div class="res-container">
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
