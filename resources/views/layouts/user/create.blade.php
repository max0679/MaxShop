<div class="container user-container @if(session()->has('regNotConfirmed')) d-block @else d-none @endif" id="reg-container">

    <div class="row">

        <div class="col-md-4 offset-md-4">

            <div class="user-block position-relative">
                <div class="user-header mt-2 mb-2">
                    <h2 class="text-center">Регистрация</h2>
                </div>

                <span class="close-user-form"><i class="fas fa-close"></i></span>

                <div class="user-body">

                    @include('layouts.messages.user_reg_messages')

                    <form action="{{ route('registration.store') }}" method="post">

                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Имя" value="{{ old('name') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Подтвердите пароль" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
                                <label for="agreeTerms">
                                    Я согласен с <a href="#" class="text-decoration-none">условиями</a>
                                </label>
                            </div>
                        </div>

                        <div class="mt-3 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                        </div>

                        <div class="have-account mb-3">
                            <a class="text-center text-decoration-none open-log-form">У меня уже есть аккаунт</a>
                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>











