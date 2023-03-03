@extends('main')
@section('body')
<div style="padding-left:10em;padding-right:10em;">
    <div class="d-flex flex-row" style="padding-top:100px;">

        <div class="mt-3 rounded shadow-sm flex-shrink-2 p-4 align-self-start" style="background-color:white;">
            <div class="text-center">
                <img src="/images/a.svg" alt="" class="border rounded-circle" style="width:10em;height:10em">
            </div>
            <div class="fs-3 fw-bold mt-3 mb-2 text-center">username</div>
            <hr>
            <div class="d-flex align-items-center mb-1">
                <p>E-Mail</p>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('change_pass') }}" style="width: 100%;" class="btn btn-light btn-sm fw-semibold">Change Password</a>
            </div>
        </div>


        <div class="mt-3 rounded shadow-sm w-100 p-4 pt-0 pb-2 " style="margin-left:2%;background-color:white">
            <!-- key -->
            <form action="#" method="post">
                <div class="form-group first">
                    <label for="username">Key</label>
                    <input type="text" class="form-control" id="username" disabled>
                </div>
                <!-- button -->
                <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Get Key" class="btn text-white btn-block btn-primary">

            </form>


        </div>
    </div>
</div>


@endsection