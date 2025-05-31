@extends('layouts.login')
@section('content')
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="auth-header">
                <h3 class="mb-0 text-primary">
                    OMS DISCOVERY
                </h3>
            </div>
            <div class="card my-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <h3 class="mb-0"><b>Login</b></h3>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" 
                               onkeydown="if(event.key === 'Enter'){ login(); }">
                    </div>
                    <div id="helpBlock" class="text-danger d-none">
                        username or password is incorrect
                    </div>
                    <div class="d-flex mt-1 justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                            <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="button" class="btn btn-primary" onclick="login()">Login</button>
                    </div>
                </div>
            </div>
            <div class="auth-footer row">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script>
        function login() {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            if (!email || !password) {
                document.getElementById('helpBlock').classList.remove('d-none');
                document.getElementById('helpBlock').innerText = 'Email and password are required';
                return;
            }
            document.getElementById('helpBlock').classList.add('d-none');

            $.get('/sanctum/csrf-cookie');
            $.ajax({
                url: '{{ route('api.login.auth') }}',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    // _token: '{{ csrf_token() }}'
                },
                xhrFields: {
                    withCredentials: true
                },
                success: function(response) {
                    if (response.success) {
                        localStorage.setItem('auth_token', response.token);
                        window.location.href = '{{ route('login.authenticate') }}/' + response.token;
                    } else {
                        document.getElementById('helpBlock').classList.remove('d-none');
                        document.getElementById('helpBlock').innerText = response.message || 'Login failed';
                    }
                },
                error: function(xhr) {
                    document.getElementById('helpBlock').classList.remove('d-none');
                    document.getElementById('helpBlock').innerText = xhr.responseJSON.message || 'An error occurred during login';
                }
            });
        }
    </script>    
@endsection