<div class="container user-container @if(session()->has('logNotConfirmed')) d-block @else d-none @endif" id="log-container">

    <div class="row">

        <div class="col-md-4 offset-md-4">

            <div class="user-block position-relative">
                <div class="user-header mt-2 mb-2">
                    <h2 class="text-center">Авторизация</h2>
                </div>

                <span class="close-user-form"><i class="fas fa-close"></i></span>

                <div class="user-body">

                    @include('layouts.messages.user_log_messages')

                    <form action="{{ route('login') }}" method="post">

                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="agree">
                            <label for="remember">
                                <a href="#" class="text-decoration-none">Запомнить меня</a>
                            </label>
                        </div>

                        <div class="mt-3 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Авторизоваться</button>
                        </div>

                        <div class="mb-3 registration">
                            <a class="text-decoration-none open-reg-form">Регистрация</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
