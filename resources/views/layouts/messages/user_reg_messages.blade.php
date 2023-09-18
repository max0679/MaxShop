<div class="row message-row">
    <div class="col-12">
        <div class="messages mt-0 ml-2 mr-2">

            @if (session()->has('user-reg-success'))
                <div class="alert alert-success text-center">
                    {{ session('user-reg-success') }}
                </div>
            @endif

            @if (session()->has('user-reg-alert'))
                <div class="alert alert-danger text-center">
                    {{ session('user-reg-alert') }}
                </div>
            @endif

        </div>
    </div>
</div>



