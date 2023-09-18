<div class="row message-row">
    <div class="col-12">
        <div class="messages mt-0 ml-2 mr-2">

            @if (session()->has('user-log-success'))
                <div class="alert alert-success text-center">
                    {{ session('user-log-success') }}
                </div>
            @endif

            @if (session()->has('user-log-alert'))
                <div class="alert alert-danger text-center">
                    {{ session('user-log-alert') }}
                </div>
            @endif

        </div>
    </div>
</div>



